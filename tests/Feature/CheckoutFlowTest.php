<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Stripe\PaymentIntent;
use Tests\TestCase;

class CheckoutFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_checkout_flow_with_simple_and_pack_items(): void
    {
        // Config Stripe de test
        config()->set('services.stripe.secret', 'sk_test_dummy');
        config()->set('services.stripe.key', 'pk_test_dummy');

        // Créer un sound-tag simple
        $tag = Product::factory()->create([
            'name' => 'Tag 1',
            'slug' => 'tag-1',
            'price' => 10.00,
            'stock_quantity' => 5,
            'product_type' => 'sound-tag',
            'is_active' => true,
        ]);

        // Créer d'autres sound-tags pour composer un pack
        $tags = Product::factory()->count(3)->create([
            'price' => 8.00,
            'stock_quantity' => 5,
            'product_type' => 'sound-tag',
            'is_active' => true,
        ]);

        // Créer un pack configurable de taille 3
        $pack = Product::factory()->create([
            'name' => 'Pack 3',
            'slug' => 'pack-3',
            'price' => 20.00,
            'stock_quantity' => 5,
            'product_type' => 'pack',
            'is_configurable' => true,
            'pack_size' => 3,
            'is_active' => true,
        ]);

        // Ajouter le produit simple au panier
        $this->post(route('cart.add', ['productId' => $tag->id]), ['quantity' => 2])
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // Ajouter le pack configurable avec 3 tags
        $selectedTagIds = $tags->pluck('id')->take(3)->values()->all();
        $this->post(route('packs.add-to-cart', ['pack' => $pack->slug]), [
            'selected_tags' => $selectedTagIds,
            'quantity' => 1,
        ])
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // Préparer les données client et créer la session de checkout
        $payload = [
            'email' => 'buyer@example.com',
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'phone' => '0600000000',
            'shipping_address' => '1 rue de Paris',
            'shipping_city' => 'Paris',
            'shipping_postal_code' => '75001',
            'shipping_country' => 'FR',
            'billing_same_as_shipping' => true,
            'terms_accepted' => 'on',
        ];

        $this->post(route('checkout.process'), $payload)
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // Mock Stripe PaymentIntent::create
        $piCreateMock = (object) [
            'id' => 'pi_test_123',
            'client_secret' => 'cs_test_123',
            'amount' => 1000,
            'currency' => 'eur',
        ];
        Mockery::mock('alias:' . PaymentIntent::class)
            ->shouldReceive('create')->andReturn($piCreateMock)
            ->byDefault()
            ->shouldReceive('retrieve')->andReturn((object) ['status' => 'succeeded', 'id' => 'pi_test_123']);

        // Créer le PaymentIntent
        $this->post(route('checkout.create-payment-intent'))
            ->assertStatus(200)
            ->assertJsonStructure(['clientSecret']);

        // Confirmer le paiement
        $this->post(route('checkout.confirm-payment'))
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        // Vérifier que le stock a diminué
        $tag->refresh();
        $pack->refresh();
        $this->assertEquals(3, $tag->stock_quantity); // 5 - 2
        $this->assertEquals(4, $pack->stock_quantity); // 5 - 1
    }
}

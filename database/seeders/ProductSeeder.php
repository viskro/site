<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset les compteurs de la factory pour éviter les doublons
      /*  ProductFactory::resetCounters();

        // Produits vedettes (populaires) - avec des slugs et SKUs fixes
        $featuredProducts = [
            [
                'name' => 'Sound Tag Rire Démoniaque',
                'slug' => 'sound-tag-rire-demoniaque',
                'description' => "Le classique absolu qui fait mouche à tous les coups ! Ce rire démoniaque légendaire va transformer n'importe quelle situation en moment épique.\n\nPourquoi c'est LE tag à avoir ?\n• Son viral connu de tous\n• Effet de surprise garanti\n• Parfait pour les soirées horror\n• Qualité audio exceptionnelle\n\nHistoire du son : Popularisé dans les années 90, ce rire est devenu THE référence des sons démoniaques. Utilisé dans des milliers de vidéos virales !\n\nUtilisations favorites :\n→ Caché sous l'oreiller de votre colocataire\n→ Dans le tiroir du bureau de votre collègue\n→ Collé discrètement sous une table\n→ Dans votre poche pour les moments opportuns\n\nCompatible avec tous les smartphones NFC. Activation instantanée, pas d'app à télécharger !",
                'short_description' => 'LE classique ! Un rire démoniaque légendaire pour des fous rires garantis. Le must-have de tout farceur qui se respecte.',
                'price' => 12.99,
                'original_price' => null,
                'sku' => 'ST-DEMON-001',
                'audio_file' => 'demonic-laugh.mp3',
                'audio_duration' => 8,
                'stock_quantity' => 156,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sound Tag Air Horn',
                'slug' => 'sound-tag-air-horn',
                'description' => "BOOOOOOOOM ! Le son qui réveille les morts et fait vibrer les murs. Attention, ce tag n'est pas pour les âmes sensibles !\n\n⚠️ ATTENTION : Niveau sonore élevé !\n\nPerfect pour :\n• Réveiller vos potes en douceur 😈\n• Annoncer votre arrivée avec style\n• Célébrer une victoire épique\n• Faire taire une conversation\n• Marquer un moment légendaire\n\nL'histoire : L'Air Horn est devenu LE son des moments épiques sur internet. De YouTube aux TikToks viraux, c'est THE sound effect qui fait mouche.\n\nSpécifications techniques :\n→ Durée : 3 secondes de pur bonheur\n→ Fréquence : Optimisée pour maximum d'impact\n→ Volume : Très élevé (respectez vos voisins !)\n→ Effet : Sursautement garanti\n\nLivré avec un petit guide 'Comment ne pas se faire détester' (humour inside) !",
                'short_description' => 'BOOOM ! Le fameux Air Horn pour marquer tous vos moments épiques. Attention, ça réveille !',
                'price' => 11.99,
                'original_price' => 15.99,
                'sku' => 'ST-HORN-002',
                'audio_file' => 'air-horn.mp3',
                'audio_duration' => 3,
                'stock_quantity' => 142,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sound Tag John Cena',
                'slug' => 'sound-tag-john-cena',
                'description' => "🎺🎺🎺🎺 AND HIS NAME IS JOHN CENA! 🎺🎺🎺🎺\n\nLe meme absolu qui a marqué une génération d'internautes ! Ce tag contient l'introduction légendaire de John Cena qui a rendu fou le monde entier.\n\nPourquoi ce son est culte ?\n• Meme viral avec des millions de vues\n• Reconnu instantanément par tous\n• Effet nostalgie + surprise combo\n• Parfait timing pour les punchlines\n\nUtilisations créatives :\n🏆 Caché dans un cadeau surprise\n🏆 Pour annoncer votre arrivée en réunion\n🏆 Quand quelqu'un dit quelque chose d'inattendu\n🏆 Pour couronner une blague réussie\n🏆 Activation surprise pendant un call Zoom\n\nAnecdote : Ce son a généré plus de 50 millions de vues sur YouTube et est devenu LE running gag de toute une époque internet.\n\nContenu : Son officiel haute qualité (6 secondes d'anthologie)\nFormat : Audio compressé optimisé mobile\nActivation : NFC instantané, compatible tous smartphones",
                'short_description' => '🎺 AND HIS NAME IS JOHN CENA ! Le meme culte qui fait mouche à chaque fois. Nostalgie et fous rires garantis.',
                'price' => 13.99,
                'original_price' => null,
                'sku' => 'ST-CENA-003',
                'audio_file' => 'john-cena.mp3',
                'audio_duration' => 6,
                'stock_quantity' => 98,
                'sort_order' => 3,
            ],
        ];

        // Créer les produits vedettes
        foreach ($featuredProducts as $productData) {
            Product::create(array_merge($productData, [
                'meta_title' => $productData['name'] . ' - Sound Tags NFC',
                'meta_description' => $productData['short_description'],
                'category' => 'sound-tag',
                'tags' => ['populaire', 'viral', 'meme', 'drôle', 'cadeau'],
                'is_active' => true,
            ]));
        }

        // Produits variés avec la factory
        Product::factory()->count(15)->create();

        // Quelques produits en promo
        Product::factory()->onSale()->count(5)->create();

        // Quelques produits en rupture
        Product::factory()->outOfStock()->count(2)->create();

        // Un produit inactif (test)
        Product::factory()->inactive()->count(1)->create();

        // Produits populaires
        Product::factory()->popular()->count(3)->create();

        $this->command->info('✅ ' . Product::count() . ' produits créés avec succès !');



   */
        $nouveauxProduits = [
            [
                'name' => 'Sound Tag Orgasme 1',
                'slug' => 'sound-tag-orgasme-1',
                'price' => 3.00,
                'sku' => 'ST-ORGA-001',
                'audio_file' => 'ORGASME-1.mp3',
                'audio_duration' => 5,
                'image' => 'ORGASME-1.png',
                'short_description' => 'Sound tag pour vos moments de surprise et de divertissement.',
                'tags' => ['adulte', 'humour', 'surprise'],
            ],
            [
                'name' => 'Sound Tag Orgasme 2',
                'slug' => 'sound-tag-orgasme-2',
                'price' => 3.00,
                'sku' => 'ST-ORGA-002',
                'audio_file' => 'ORGASME-2.mp3',
                'audio_duration' => 8,
                'image' => 'ORGASME-2.png',
                'short_description' => 'Variante du sound tag pour diversifier vos farces.',
                'tags' => ['adulte', 'humour', 'surprise'],
            ],
            [
                'name' => 'Sound Tag Alarme',
                'slug' => 'sound-tag-alarme',
                'price' => 3.00,
                'sku' => 'ST-ALAR-003',
                'audio_file' => 'ALARME.mp3',
                'audio_duration' => 10,
                'image' => 'ALARME.png',
                'short_description' => 'Le son d\'alarme parfait pour réveiller ou alerter avec style.',
                'tags' => ['alarme', 'reveil', 'attention'],
            ],
            [
                'name' => 'Sound Tag Brainrot 1',
                'slug' => 'sound-tag-brainrot-1',
                'price' => 3.00,
                'sku' => 'ST-BRAIN-004',
                'audio_file' => 'BRAINROT-1.mp3',
                'audio_duration' => 35,
                'image' => 'BRAINROT-1.png',
                'short_description' => 'Le son viral Brainrot qui fait fureur sur les réseaux sociaux.',
                'tags' => ['viral', 'tiktok', 'brainrot', 'tendance'],
            ],
            [
                'name' => 'Sound Tag Brainrot 2',
                'slug' => 'sound-tag-brainrot-2',
                'price' => 3.00,
                'sku' => 'ST-BRAIN-005',
                'audio_file' => 'BRAINROT-2.mp3',
                'audio_duration' => 31,
                'image' => 'BRAINROT-2.png',
                'short_description' => 'Seconde version du Brainrot viral pour varier les plaisirs.',
                'tags' => ['viral', 'tiktok', 'brainrot', 'tendance'],
            ],
            [
                'name' => 'Sound Tag Erika',
                'slug' => 'sound-tag-erika',
                'price' => 3.00,
                'sku' => 'ST-ERIK-006',
                'audio_file' => 'ERIKA.mp3',
                'audio_duration' => 191,
                'image' => 'ERIKA.png',
                'short_description' => 'Le fameux chant Erika devenu meme sur internet.',
                'tags' => ['meme', 'chant', 'vintage', 'culture'],
            ],
            [
                'name' => 'Sound Tag Explosion',
                'slug' => 'sound-tag-explosion',
                'price' => 3.00,
                'sku' => 'ST-EXPLO-007',
                'audio_file' => 'EXPLOSION.mp3',
                'audio_duration' => 5,
                'image' => 'EXPLOSION.png',
                'short_description' => 'Le son d\'explosion parfait pour dramatiser vos moments épiques.',
                'tags' => ['explosion', 'dramatique', 'effet', 'cinema'],
            ],
            [
                'name' => 'Sound Tag Goofy',
                'slug' => 'sound-tag-goofy',
                'price' => 3.00,
                'sku' => 'ST-GOOFY-008',
                'audio_file' => 'GOOFY.mp3',
                'audio_duration' => 32,
                'image' => 'GOOFY.png',
                'short_description' => 'Le rire iconique de Dingo pour des moments de pure nostalgie Disney.',
                'tags' => ['disney', 'nostalgie', 'rire', 'cartoon'],
            ],
            [
                'name' => 'Sound Tag Just Sleep',
                'slug' => 'sound-tag-just-sleep',
                'price' => 3.00,
                'sku' => 'ST-SLEEP-009',
                'audio_file' => 'JUST-SLEEP.mp3',
                'audio_duration' => 14,
                'image' => 'JUST-SLEEP.png',
                'short_description' => 'Le son parfait pour dire à quelqu\'un d\'aller dormir avec humour.',
                'tags' => ['sommeil', 'humour', 'conseil', 'detente'],
            ],
            [
                'name' => 'Sound Tag China',
                'slug' => 'sound-tag-china',
                'price' => 3.00,
                'sku' => 'ST-CHINA-010',
                'audio_file' => 'CHINA.mp3',
                'audio_duration' => 8,
                'image' => 'CHINA.png',
                'short_description' => 'Le meme China devenu viral sur les réseaux sociaux.',
                'tags' => ['meme', 'viral', 'china', 'internet'],
            ],
        ];

        foreach ($nouveauxProduits as $produitData) {
            Product::create(array_merge([
                'description' => 'Sound Tag NFC de qualité premium. Approchez simplement votre téléphone du tag pour déclencher le son instantanément !',
                'stock_quantity' => 100,
                'is_active' => true,
                'category' => 'sound-tag',
                'product_type' => 'sound-tag',
                'sort_order' => 999,
                'meta_title' => $produitData['name'] . ' - Sound Tags NFC',
                'meta_description' => $produitData['short_description'],
            ], $produitData));
        }

        echo "✅ " . count($nouveauxProduits) . " produits créés avec succès !";

    }
}

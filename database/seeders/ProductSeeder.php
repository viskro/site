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

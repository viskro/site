<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class PackSeeder extends Seeder
{
    public function run(): void
    {
        $packs = [
            [
                'name' => 'Pack Découverte - 3 Sound Tags',
                'slug' => 'pack-decouverte-3-sound-tags',
                'description' => "Découvrez l'univers des Sound Tags avec ce pack de 3 tags à personnaliser !\n\n🎯 **Ce pack contient :**\n• 3 Sound Tags NFC de votre choix\n• Livraison gratuite\n• Guide d'utilisation inclus\n• Support technique\n\n✨ **Avantages du pack :**\n• Économisez 15% par rapport à l'achat individuel\n• Choisissez parmi tous nos sound tags disponibles\n• Parfait pour débuter ou offrir\n• Variété garantie pour tous les goûts\n\n🚀 **Comment ça marche :**\n1. Ajoutez ce pack à votre panier\n2. Sélectionnez vos 3 sound tags préférés\n3. Recevez votre pack personnalisé sous 48h\n\nUn excellent moyen de découvrir nos sound tags les plus populaires à prix réduit !",
                'short_description' => 'Choisissez 3 sound tags parmi toute notre collection et économisez 15% ! Parfait pour découvrir ou offrir.',
                'price' => 5.99,
                'original_price' => 8.97,
                'sku' => 'PACK-DECO-3',
                'product_type' => 'pack',
                'pack_size' => 3,
                'is_configurable' => true,
                'category' => 'pack',
                'meta_title' => 'Pack Découverte 3 Sound Tags - Économisez 15%',
                'meta_description' => 'Pack de 3 sound tags NFC à choisir parmi toute notre collection. Livraison gratuite et économies garanties !',
                'tags' => ['pack', 'économie', 'découverte', 'personnalisable', 'cadeau'],
                'sort_order' => 1,
            ],
            [
                'name' => 'Pack Famille - 6 Sound Tags',
                'slug' => 'pack-famille-6-sound-tags',
                'description' => "Le pack parfait pour toute la famille ! 6 Sound Tags à choisir selon vos envies.\n\n🎯 **Ce pack contient :**\n• 6 Sound Tags NFC de votre choix\n• Livraison gratuite offerte\n• Guide d'utilisation famille\n• Support technique prioritaire\n• Étui de rangement inclus\n\n✨ **Avantages du pack :**\n• Économisez 25% par rapport à l'achat individuel\n• Sélection libre parmi tous nos sound tags\n• Idéal pour partager en famille ou entre amis\n• Assortiment varié pour tous les âges\n\n🎁 **Bonus inclus :**\n• Étui de transport premium\n• Stickers décoratifs gratuits\n• Accès au groupe Facebook VIP\n• Nouveautés en avant-première\n\n🚀 **Processus simple :**\n1. Commandez votre pack famille\n2. Choisissez vos 6 sound tags favoris\n3. Profitez de votre collection personnalisée\n\nLe choix intelligent pour équiper toute la famille !",
                'short_description' => 'Le pack familial ultime ! Choisissez 6 sound tags et économisez 25%.',
                'price' => 12.99,
                'original_price' => 17.94,
                'sku' => 'PACK-FAM-6',
                'product_type' => 'pack',
                'pack_size' => 6,
                'is_configurable' => true,
                'category' => 'pack',
                'meta_title' => 'Pack Famille 6 Sound Tags - Économisez 25%',
                'meta_description' => 'Pack familial de 6 sound tags NFC au choix. Étui inclus, livraison gratuite, économies maximales !',
                'tags' => ['pack', 'famille', 'économie', 'personnalisable', 'populaire'],
                'sort_order' => 2,
            ],
            [
                'name' => 'Pack Collectionneur - 10 Sound Tags',
                'slug' => 'pack-collectionneur-10-sound-tags',
                'description' => "La collection ultime pour les vrais passionnés ! 10 Sound Tags premium à personnaliser.\n\n🎯 **Ce pack contient :**\n• 10 Sound Tags NFC premium de votre choix\n• Livraison express gratuite\n• Coffret collector luxe\n• Support technique VIP\n• Certificat de collection numéroté\n\n✨ **Avantages du pack :**\n• Économisez 35% par rapport à l'achat individuel\n• Accès à TOUS nos sound tags, même les exclusifs\n• Coffret collector en édition limitée\n• Service client prioritaire\n• Garantie satisfaction 30 jours\n\n🏆 **Exclusivités collectionneur :**\n• Coffret premium en bois véritable\n• Accès aux sound tags en avant-première\n• Membership VIP à vie\n• Badge collectionneur numéroté\n• Newsletter exclusive mensuelle\n\n🚀 **Expérience premium :**\n1. Commande traitée en priorité\n2. Sélection assistée par nos experts\n3. Emballage collector soigné\n4. Suivi premium jusqu'à réception\n\nPour les connaisseurs qui ne transigent pas sur la qualité !",
                'short_description' => 'La collection ultime ! 10 sound tags premium au choix. Économisez 35% !',
                'price' => 19.99,
                'original_price' => 29.90,
                'sku' => 'PACK-COLL-10',
                'product_type' => 'pack',
                'pack_size' => 10,
                'is_configurable' => true,
                'category' => 'pack',
                'meta_title' => 'Pack Collectionneur 10 Sound Tags Premium - Économisez 35%',
                'meta_description' => 'Collection premium de 10 sound tags NFC au choix. Coffret collector, livraison express, exclusivités VIP !',
                'tags' => ['pack', 'premium', 'collector', 'exclusif', 'vip'],
                'sort_order' => 3,
            ],
        ];

        foreach ($packs as $packData) {
            Product::create($packData);
        }
    }
}

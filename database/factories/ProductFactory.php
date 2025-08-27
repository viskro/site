<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private static $usedSlugs = [];
    private static $usedSkus = [];
    private static $counter = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Sound Tag Cri de Wilhelm',
            'Sound Tag Bruit de Pet',
            'Sound Tag Miaulement Chat',
            'Sound Tag Coin de Canard',
            'Sound Tag Applaudissements',
            'Sound Tag Sonnerie Nokia',
            'Sound Tag Bruits de Jungle',
            'Sound Tag Explosion Michael Bay',
            'Sound Tag Meme "Bruh"',
            'Sound Tag Sirène Police',
            'Sound Tag Cri de Goat',
            'Sound Tag Dial-up Internet',
            'Sound Tag Bass Drop',
            'Sound Tag "What are you doing?"',
            'Sound Tag Rire Kawhi Leonard',
            'Sound Tag Drama Gopher',
            'Sound Tag Windows XP Startup',
            'Sound Tag Sonnette de Vélo',
            'Sound Tag Cri de Oui-Oui',
            'Sound Tag Bruit de Mâchoire',
            'Sound Tag Claquement de Doigts',
            'Sound Tag "Oh No" TikTok',
            'Sound Tag Bruit de Bisou',
            'Sound Tag Corne de Brume',
            'Sound Tag Tire-Bouchon',
            'Sound Tag "Bonjour" Kaamelott',
            'Sound Tag Cri de Pingouin',
            'Sound Tag Notification iPhone',
            'Sound Tag Bruit de Vuvuzela',
            'Sound Tag "Surprise Maman"'
        ];

        // Générer un nom unique avec suffixe si nécessaire
        $baseName = $this->faker->randomElement($names);
        $name = $baseName;
        $attemptCount = 1;

        // Ajouter un suffixe numérique si le nom existe déjà
        while (in_array(Str::slug($name), self::$usedSlugs)) {
            $attemptCount++;
            $name = $baseName . ' V' . $attemptCount;
        }

        // Générer un slug unique
        $slug = Str::slug($name);
        self::$usedSlugs[] = $slug;

        // Générer un SKU unique
        do {
            $sku = 'ST-' . strtoupper($this->faker->bothify('####??')) . '-' . str_pad(self::$counter, 3, '0', STR_PAD_LEFT);
            self::$counter++;
        } while (in_array($sku, self::$usedSkus));

        self::$usedSkus[] = $sku;

        $basePrice = $this->faker->randomFloat(2, 8.99, 24.99);
        $isOnSale = $this->faker->boolean(30); // 30% chance d'être en promo

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->generateDescription($name),
            'short_description' => $this->generateShortDescription($name),
            'price' => $isOnSale ? round($basePrice * 0.8, 2) : $basePrice,
            'original_price' => $isOnSale ? $basePrice : null,
            'sku' => $sku,
            'audio_file' => $this->faker->randomElement([
                'wilhelm-scream.mp3',
                'fart-sound.mp3',
                'cat-meow.mp3',
                'duck-quack.mp3',
                'applause.mp3',
                'nokia-ringtone.mp3',
                'jungle-sounds.mp3',
                'explosion.mp3',
                'bruh-meme.mp3',
                'police-siren.mp3',
                'goat-scream.mp3',
                'dialup-internet.mp3',
                'bass-drop.mp3',
                'what-are-you-doing.mp3',
                'kawhi-laugh.mp3',
                'dramatic-gopher.mp3',
                'windows-xp.mp3',
                'bike-bell.mp3',
                'jaw-snap.mp3',
                'finger-snap.mp3'
            ]),
            'audio_duration' => $this->faker->numberBetween(2, 15), // 2-15 secondes
            'image' => null, // On va utiliser des placeholders
            'gallery' => null,
            'is_active' => $this->faker->boolean(95), // 95% actifs
            'meta_title' => $name . ' - Sound Tag NFC',
            'meta_description' => 'Découvrez notre ' . $name . '. Tag NFC avec son personnalisé pour surprendre vos amis. Livraison rapide.',
            'category' => 'sound-tag',
            'tags' => $this->generateTags(),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }

    private function generateDescription(string $name): string
    {
        $descriptions = [
            "Ce Sound Tag va littéralement faire exploser l'ambiance ! Approchez simplement votre smartphone du tag NFC et préparez-vous à une surprise sonore inoubliable.\n\nParfait pour :\n• Surprendre vos amis lors de soirées\n• Créer des moments de complicité\n• Animer vos réunions de famille\n• Faire des blagues mémorables\n\nLe son est diffusé directement depuis le smartphone, garantissant une qualité audio optimale. Compatible avec tous les smartphones récents (Android et iOS).\n\nDimensions : 3cm de diamètre\nMatériau : PVC résistant\nTechnologie : NFC 13.56MHz\nPortée : 2-4cm\n\nLivraison en 24-48h partout en France !",

            "Transformez n'importe quel moment en instant hilarant avec ce Sound Tag unique ! Une simple approche avec votre téléphone et c'est parti pour le show.\n\nCaractéristiques :\n• Son haute définition stocké dans le cloud\n• Activation instantanée par NFC\n• Compatible tous smartphones\n• Résistant à l'eau et aux chocs\n• Design élégant et discret\n\nIdéal pour :\n→ Cadeaux d'anniversaire originaux\n→ Animation d'événements\n→ Blagues entre amis\n→ Création de souvenirs uniques\n\nChaque tag est testé individuellement avant expédition. Satisfaction garantie ou remboursé !",

            "Préparez-vous à révolutionner vos interactions sociales ! Ce Sound Tag contient un son soigneusement sélectionné pour maximiser l'effet de surprise.\n\nPourquoi choisir ce tag ?\n✓ Qualité sonore professionnelle\n✓ Technologie NFC fiable\n✓ Installation zero : ça marche tout de suite\n✓ Batterie ? Pas besoin !\n✓ Durée de vie illimitée\n\nMode d'emploi ultra simple :\n1. Sortez votre smartphone\n2. Approchez-le du tag (2-3cm)\n3. Profitez de la réaction !\n\nLe cadeau parfait pour tous les âges. Commandez maintenant et recevez-le dès demain !"
        ];

        return $this->faker->randomElement($descriptions);
    }

    private function generateShortDescription(string $name): string
    {
        $descriptions = [
            "Un tag NFC qui déclenche un son hilarant dès qu'on l'approche avec un smartphone. Parfait pour surprendre !",
            "Tag sonore NFC pour des moments de complicité garantis. Compatible tous smartphones, activation instantanée.",
            "Le cadeau parfait pour faire rire ! Approchez votre téléphone et laissez la magie opérer.",
            "Tag NFC avec son personnalisé. Qualité premium, effet garanti, souvenirs inoubliables.",
            "Révolutionnez vos blagues avec ce tag sonore intelligent. Simple, efficace, mémorable.",
        ];

        return $this->faker->randomElement($descriptions);
    }

    private function generateTags(): array
    {
        $allTags = [
            'drôle',
            'hilarant',
            'surprise',
            'cadeau',
            'original',
            'nfc',
            'technologie',
            'blague',
            'fun',
            'soirée',
            'animation',
            'viral',
            'meme',
            'populaire',
            'famille',
            'amis',
            'bureau',
            'anniversaire',
            'fête',
            'événement'
        ];

        return $this->faker->randomElements($allTags, $this->faker->numberBetween(3, 8));
    }

    /**
     * Product en rupture de stock
     */
    public function outOfStock(): static
    {
        return $this; // plus de notion de rupture
    }

    /**
     * Product en promotion
     */
    public function onSale(): static
    {
        return $this->state(function (array $attributes) {
            $originalPrice = $this->faker->randomFloat(2, 15, 30);
            return [
                'price' => round($originalPrice * 0.7, 2), // 30% de réduction
                'original_price' => $originalPrice,
            ];
        });
    }

    /**
     * Product populaire
     */
    public function popular(): static
    {
        return $this->state(fn(array $attributes) => [
            'sort_order' => $this->faker->numberBetween(1, 10),
        ]);
    }

    /**
     * Product inactif
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Reset static arrays (utile pour les tests)
     */
    public static function resetCounters(): void
    {
        self::$usedSlugs = [];
        self::$usedSkus = [];
        self::$counter = 1;
    }
}

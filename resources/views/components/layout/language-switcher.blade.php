
<div class="relative" x-data="languageSwitcher()">
    <button
        type="button"
        @click="open = !open"
        @click.away="open = false"
        class="flex items-center space-x-1 px-3 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-md"
    >
        <span x-text="currentLocale.toUpperCase()">{{ strtoupper(app()->getLocale()) }}</span>
        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 w-24 bg-gray-800 rounded-md shadow-lg border border-gray-700 focus:outline-none z-50"
    >
        <div class="py-1">
            <button 
                type="button"
                @click.stop="changeLocale('fr')" 
                class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors"
                :class="currentLocale === 'fr' ? 'font-semibold text-white' : ''"
            >
                🇫🇷 FR
            </button>
            <button 
                type="button"
                @click.stop="changeLocale('en')" 
                class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors"
                :class="currentLocale === 'en' ? 'font-semibold text-white' : ''"
            >
                🇬🇧 EN
            </button>
        </div>
    </div>
</div>

<script>
// S'assurer que la fonction est disponible globalement
window.languageSwitcher = function() {
    return {
        open: false,
        currentLocale: '{{ app()->getLocale() }}',
        async changeLocale(locale) {
            console.log('Changement de langue vers:', locale);
            try {
                // Marquer qu'on est en train de changer de langue
                sessionStorage.setItem('locale-changing', 'true');
                
                // Stocker dans localStorage
                localStorage.setItem('locale', locale);
                
                // Envoyer au serveur pour définir le cookie
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    console.error('CSRF token non trouvé');
                    sessionStorage.removeItem('locale-changing');
                    return;
                }
                
                console.log('Envoi de la requête...');
                const response = await fetch('{{ route('locale.set') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ locale: locale })
                });
                
                console.log('Réponse reçue:', response.status);
                const data = await response.json();
                console.log('Données reçues:', data);
                
                if (response.ok && data.success) {
                    this.currentLocale = locale;
                    this.open = false;
                    // Recharger la page pour appliquer la nouvelle langue
                    window.location.reload();
                } else {
                    console.error('Erreur lors du changement de langue:', data.error || 'Erreur inconnue');
                    sessionStorage.removeItem('locale-changing');
                }
            } catch (error) {
                console.error('Erreur lors du changement de langue:', error);
                sessionStorage.removeItem('locale-changing');
            }
        }
    };
};
</script>

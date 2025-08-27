
<div class="relative" x-data="{ open: false }">
    <button
        @click="open = !open"
        @click.away="open = false"
        class="flex items-center space-x-1 px-3 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-md"
    >
        <span>{{ strtoupper(app()->getLocale()) }}</span>
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
            <a href="?lang=fr" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white {{ app()->getLocale() === 'fr' ? 'font-semibold text-white' : '' }}">
                🇫🇷 FR
            </a>
            <a href="?lang=en" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white {{ app()->getLocale() === 'en' ? 'font-semibold text-white' : '' }}">
                🇬🇧 EN
            </a>
        </div>
    </div>
</div>

<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        {{-- Contenu spécifique du calculateur --}}
        @yield('calculator-form')

        <!-- Boutons -->
        <div class="flex space-x-4 pt-2">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Calculer
            </button>
            <button
                type="button"
                wire:click="reset_form"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
            >
                Réinitialiser
            </button>
        </div>
    </form>

    <!-- Résultats -->
    @if($resultatPrincipal !== null)
        <div class="mt-8 p-4 bg-blue-50 rounded-md border border-blue-100">
            <h3 class="text-lg font-semibold mb-3">Résultats du calcul</h3>

            {{-- Contenu spécifique des résultats --}}
            @yield('calculator-results')

            <div class="mt-4 flex justify-between items-center">
                <button
                    wire:click="toggleHistory"
                    class="text-sm text-blue-600 hover:text-blue-800 flex items-center"
                >
                    <span>{{ $showHistory ? 'Masquer' : 'Afficher' }} l'historique</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                @if(count($historiqueCalculs) > 0)
                    <button
                        wire:click="clearHistory"
                        class="text-sm text-red-600 hover:text-red-800"
                    >
                        Effacer l'historique
                    </button>
                @endif
            </div>
        </div>
    @endif

    <!-- Historique -->
    @if($showHistory && count($historiqueCalculs) > 0)
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        {{-- En-têtes spécifiques pour l'historique --}}
                        @yield('history-headers')
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            {{-- Colonnes spécifiques pour l'historique --}}
                            @yield('history-data')
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Métadonnées structurées pour SEO -->
    @php
    $schemaData = [
        "@context" => "https://schema.org",
        "@type" => "FinancialCalculator",
        "name" => $title,
        "description" => $description,
        "url" => url()->current(),
        "dateModified" => date('Y-m-d'),
        "calculatorType" => $type,
        "creator" => [
            "@type" => "Organization",
            "name" => "En-Ligne.ma",
            "url" => config('app.url')
        ]
    ];
    @endphp
    <script type="application/ld+json">
        @json($schemaData)
    </script>

    <!-- Script pour la gestion de l'historique avec localStorage -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            const calculatorType = @json($type);
            const storageKey = `calculator_${calculatorType}_history`;

            // Fonction pour sauvegarder l'historique dans localStorage
            function saveHistoryToLocalStorage(type, history) {
                const key = `calculator_${type}_history`;
                localStorage.setItem(key, JSON.stringify(history));
            }

            // Fonction pour charger l'historique depuis localStorage
            function loadHistoryFromLocalStorage(type) {
                const key = `calculator_${type}_history`;
                const savedHistory = localStorage.getItem(key);
                return savedHistory ? JSON.parse(savedHistory) : [];
            }

            // Écouter les événements de sauvegarde d'historique
            @this.on('calculator:save-history', ({ type, history }) => {
                saveHistoryToLocalStorage(type, history);
            });

            // Écouter les événements de nettoyage d'historique
            @this.on('calculator:clear-history', ({ type }) => {
                const key = `calculator_${type}_history`;
                localStorage.removeItem(key);
            });

            // Écouter les événements de chargement d'historique
            @this.on('calculator:load-history', ({ type }) => {
                const localHistory = loadHistoryFromLocalStorage(type);

                // Si on a des données dans le localStorage, les envoyer au serveur
                if (localHistory && localHistory.length > 0) {
                    @this.call('importFromLocalStorage', localHistory);
                }
            });
        });
    </script>
</div>

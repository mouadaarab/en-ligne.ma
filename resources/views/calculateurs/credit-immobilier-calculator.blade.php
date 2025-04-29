<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        <!-- Montant du bien -->
        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">
                Prix du bien immobilier (MAD)
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="montant"
                    wire:model="montant"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="10000"
                    required
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('montant') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Apport personnel -->
        <div>
            <label for="apport" class="block text-sm font-medium text-gray-700 mb-1">
                Apport personnel (%)
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="apport"
                    wire:model.live="apport"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="100"
                    step="1"
                >
                <span class="block text-center mt-1">{{ $apport }}% ({{ number_format($montant * $apport / 100) }} MAD)</span>
            </div>
            @error('apport') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Durée et taux -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="duree" class="block text-sm font-medium text-gray-700 mb-1">
                    Durée du prêt (années)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="duree"
                        wire:model="duree"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="1"
                        max="30"
                        required
                    >
                    <span class="absolute right-3 top-2 text-gray-400">ans</span>
                </div>
                @error('duree') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="tauxInteret" class="block text-sm font-medium text-gray-700 mb-1">
                    Taux d'intérêt annuel (%)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="tauxInteret"
                        wire:model="tauxInteret"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="0.1"
                        max="20"
                        step="0.01"
                        required
                    >
                    <span class="absolute right-3 top-2 text-gray-400">%</span>
                </div>
                @error('tauxInteret') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Mensualité</span>
                    <div class="text-xl font-bold text-blue-600">{{ number_format($mensualite, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Montant du prêt</span>
                    <div class="text-lg font-semibold text-green-600">{{ number_format($montantPret, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Coût total du crédit</span>
                    <div class="text-lg font-semibold text-purple-600">{{ number_format($coutTotal, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Intérêts payés</span>
                    <div class="text-lg font-semibold text-red-600">{{ number_format($montantInterets, 2) }} MAD</div>
                </div>
            </div>

            <!-- Estimation du salaire recommandé -->
            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-100 rounded-md">
                <p class="text-sm text-gray-700">
                    <strong>Taux d'endettement recommandé:</strong> Pour un endettement sain (max. 33% des revenus), un revenu mensuel minimum de {{ number_format($mensualite * 3, 2) }} MAD est conseillé.
                </p>
            </div>

            <!-- Contrôles pour l'historique -->
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
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Durée</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Mensualité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['montantBien'], 2) }}</td>
                            <td class="py-2 px-3 text-sm">{{ $calcul['duree'] }} ans</td>
                            <td class="py-2 px-3 text-sm">{{ $calcul['tauxInteret'] }}%</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['mensualite'], 2) }}</td>
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
        "@type" => "MortgageCalculator",
        "name" => $title,
        "description" => $description,
        "url" => url()->current(),
        "dateModified" => "2025-04-23",
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
</div>
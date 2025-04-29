<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        <!-- Salaire brut -->
        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">
                @if($periode === 'mensuel')
                    Salaire brut mensuel (MAD)
                @else
                    Salaire brut annuel (MAD)
                @endif
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="montant"
                    wire:model="montant"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="100"
                    required
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('montant') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Taux d'impôt -->
        <div>
            <label for="tauxIR" class="block text-sm font-medium text-gray-700 mb-1">
                Taux d'impôt (%)
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="tauxIR"
                    wire:model.live="tauxIR"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="100"
                    step="0.5"
                >
                <span class="block text-center mt-1">{{ $tauxIR }}%</span>
            </div>
            @error('tauxIR') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Période -->
        <div class="flex space-x-4">
            <label class="flex items-center">
                <input type="radio" wire:model="periode" value="mensuel" class="h-4 w-4 text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Mensuel</span>
            </label>
            <label class="flex items-center">
                <input type="radio" wire:model="periode" value="annuel" class="h-4 w-4 text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Annuel</span>
            </label>
            @error('periode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                    <span class="text-sm text-gray-500">Salaire net</span>
                    <div class="text-xl font-bold text-blue-600">{{ number_format($salaireNet, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Montant IR</span>
                    <div class="text-lg font-semibold text-red-600">{{ number_format($montantIR, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Cotisation CNSS</span>
                    <div class="text-lg font-semibold text-orange-600">{{ number_format($montantCNSS, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Cotisation AMO</span>
                    <div class="text-lg font-semibold text-green-600">{{ number_format($montantAMO, 2) }} MAD</div>
                </div>
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
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Brut</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Net</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux IR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireBrut'], 2) }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireNet'], 2) }}</td>
                            <td class="py-2 px-3 text-sm">{{ $calcul['tauxIR'] }}%</td>
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
<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        <!-- Salaire brut annuel -->
        <div>
            <label for="salaireBrut" class="block text-sm font-medium text-gray-700 mb-1">
                Salaire brut annuel (MAD)
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="salaireBrut"
                    wire:model="salaireBrut"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    required
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('salaireBrut') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Situation familiale -->
        <div>
            <label for="situationFamiliale" class="block text-sm font-medium text-gray-700 mb-1">
                Situation familiale
            </label>
            <select
                id="situationFamiliale"
                wire:model="situationFamiliale"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                required
            >
                <option value="celibataire">Célibataire</option>
                <option value="marie">Marié(e)</option>
            </select>
            @error('situationFamiliale') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Nombre d'enfants -->
        <div>
            <label for="nombreEnfants" class="block text-sm font-medium text-gray-700 mb-1">
                Nombre d'enfants à charge
            </label>
            <input
                type="number"
                id="nombreEnfants"
                wire:model="nombreEnfants"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                min="0"
                max="10"
                required
            >
            @error('nombreEnfants') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Options supplémentaires -->
        <div class="space-y-2">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="hasLogementPrincipal"
                    wire:model="hasLogementPrincipal"
                    class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                >
                <label for="hasLogementPrincipal" class="ml-2 block text-sm text-gray-700">
                    Je rembourse un prêt pour ma résidence principale
                </label>
            </div>
            @if($hasLogementPrincipal)
                <div class="pl-6">
                    <label for="montantInterets" class="block text-sm font-medium text-gray-700 mb-1">
                        Montant des intérêts annuels payés (MAD)
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="montantInterets"
                            wire:model="montantInterets"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            min="0"
                        >
                        <span class="absolute right-3 top-2 text-gray-400">MAD</span>
                    </div>
                </div>
            @endif
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
                    <span class="text-sm text-gray-500">Impôt sur le revenu annuel</span>
                    <div class="text-xl font-bold text-blue-600">{{ number_format($resultatPrincipal, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Impôt mensuel moyen</span>
                    <div class="text-lg font-semibold text-green-600">{{ number_format($resultatPrincipal / 12, 2) }} MAD</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Taux effectif d'imposition</span>
                    <div class="text-lg font-semibold text-purple-600">{{ number_format(($resultatPrincipal / $salaireBrut) * 100, 2) }}%</div>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Salaire net annuel (après IR)</span>
                    <div class="text-lg font-semibold text-red-600">{{ number_format($salaireBrut - $resultatPrincipal, 2) }} MAD</div>
                </div>
            </div>

            <!-- Détails des tranches -->
            <div class="mt-4">
                <h4 class="text-md font-medium mb-2">Détail par tranches</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Tranche</th>
                                <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux</th>
                                <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant imposable</th>
                                <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Impôt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tranches as $tranche)
                                <tr class="border-t border-gray-200">
                                    <td class="py-2 px-3 text-sm">{{ number_format($tranche['min']) }} - {{ $tranche['max'] === null ? '∞' : number_format($tranche['max']) }}</td>
                                    <td class="py-2 px-3 text-sm">{{ $tranche['taux'] }}%</td>
                                    <td class="py-2 px-3 text-sm">{{ number_format($tranche['montantImposable'], 2) }}</td>
                                    <td class="py-2 px-3 text-sm">{{ number_format($tranche['impot'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Salaire brut</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Situation</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Enfants</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Impôt annuel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireBrut'], 2) }}</td>
                            <td class="py-2 px-3 text-sm">{{ $calcul['situationFamiliale'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ $calcul['nombreEnfants'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['resultat'], 2) }}</td>
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
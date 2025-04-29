<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-100 rounded-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">À propos des paramètres</h3>
        <p class="text-sm text-gray-600 mb-2">Ce calculateur vous aide à estimer la rentabilité de votre investissement locatif en prenant en compte différents facteurs clés. Voici une explication des différents paramètres :</p>
        <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
            <li><strong>Prix d'achat</strong> : Le montant total pour acquérir le bien immobilier.</li>
            <li><strong>Apport personnel</strong> : Le pourcentage du prix que vous financez personnellement (sans emprunt bancaire).</li>
            <li><strong>Frais d'acquisition</strong> : Inclut les frais de notaire, taxes et droits d'enregistrement (généralement 6-8% au Maroc).</li>
            <li><strong>Montant des travaux</strong> : Budget prévu pour la rénovation ou l'amélioration du bien.</li>
            <li><strong>Loyer mensuel</strong> : Le montant que vous comptez percevoir chaque mois.</li>
            <li><strong>Charges annuelles</strong> : Frais récurrents comme les taxes foncières, charges de copropriété, assurances, etc.</li>
            <li><strong>Taux d'imposition</strong> : Le taux d'impôt applicable à vos revenus locatifs.</li>
            <li><strong>Taux de vacance</strong> : Estimation du pourcentage de temps où le bien pourrait rester inoccupé.</li>
        </ul>
    </div>

    <form wire:submit="calculer" class="space-y-4">
        <!-- Prix d'achat -->
        <div>
            <label for="prixAchat" class="block text-sm font-medium text-gray-700 mb-1">
                Prix d'achat du bien (MAD)
                <span class="text-xs text-gray-500 font-normal ml-1">(Coût d'acquisition du bien immobilier)</span>
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="prixAchat"
                    wire:model="prixAchat"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="10000"
                    required
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('prixAchat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Apport personnel -->
        <div>
            <label for="apportPersonnel" class="block text-sm font-medium text-gray-700 mb-1">
                Apport personnel (%)
                <span class="text-xs text-gray-500 font-normal ml-1">(Pourcentage du prix que vous financez sans crédit)</span>
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="apportPersonnel"
                    wire:model.live="apportPersonnel"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="100"
                    step="5"
                >
                <span class="block text-center mt-1">{{ $apportPersonnel }}% ({{ number_format($prixAchat * $apportPersonnel / 100) }} MAD)</span>
            </div>
            @error('apportPersonnel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Frais d'acquisition -->
        <div>
            <label for="fraisAcquisition" class="block text-sm font-medium text-gray-700 mb-1">
                Frais d'acquisition (%)
                <span class="text-xs text-gray-500 font-normal ml-1">(Frais de notaire, taxes et droits d'enregistrement)</span>
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="fraisAcquisition"
                    wire:model.live="fraisAcquisition"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="15"
                    step="0.5"
                >
                <span class="block text-center mt-1">{{ $fraisAcquisition }}% ({{ number_format($prixAchat * $fraisAcquisition / 100) }} MAD)</span>
            </div>
            @error('fraisAcquisition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Montant des travaux -->
        <div>
            <label for="montantTravaux" class="block text-sm font-medium text-gray-700 mb-1">
                Montant des travaux (MAD)
                <span class="text-xs text-gray-500 font-normal ml-1">(Budget pour la rénovation ou l'amélioration du bien)</span>
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="montantTravaux"
                    wire:model="montantTravaux"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="5000"
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('montantTravaux') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Loyer mensuel -->
        <div>
            <label for="loyerMensuel" class="block text-sm font-medium text-gray-700 mb-1">
                Loyer mensuel (MAD)
                <span class="text-xs text-gray-500 font-normal ml-1">(Montant du loyer que vous comptez percevoir chaque mois)</span>
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="loyerMensuel"
                    wire:model="loyerMensuel"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="500"
                    required
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('loyerMensuel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Charges annuelles -->
        <div>
            <label for="chargesAnnuelles" class="block text-sm font-medium text-gray-700 mb-1">
                Charges annuelles (MAD)
                <span class="text-xs text-gray-500 font-normal ml-1">(Taxes foncières, charges de copropriété, assurances, etc.)</span>
            </label>
            <div class="relative">
                <input
                    type="number"
                    id="chargesAnnuelles"
                    wire:model="chargesAnnuelles"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    min="0"
                    step="500"
                >
                <span class="absolute right-3 top-2 text-gray-400">MAD</span>
            </div>
            @error('chargesAnnuelles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Taux d'imposition -->
        <div>
            <label for="tauxImposition" class="block text-sm font-medium text-gray-700 mb-1">
                Taux d'imposition (%)
                <span class="text-xs text-gray-500 font-normal ml-1">(Taux d'impôt applicable à vos revenus locatifs)</span>
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="tauxImposition"
                    wire:model.live="tauxImposition"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="40"
                    step="1"
                >
                <span class="block text-center mt-1">{{ $tauxImposition }}%</span>
            </div>
            @error('tauxImposition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Taux de vacance locative -->
        <div>
            <label for="tauxVacance" class="block text-sm font-medium text-gray-700 mb-1">
                Taux de vacance locative (%)
                <span class="text-xs text-gray-500 font-normal ml-1">(Estimation du temps où le bien pourrait rester inoccupé)</span>
            </label>
            <div class="relative">
                <input
                    type="range"
                    id="tauxVacance"
                    wire:model.live="tauxVacance"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                    min="0"
                    max="30"
                    step="1"
                >
                <span class="block text-center mt-1">{{ $tauxVacance }}%</span>
            </div>
            @error('tauxVacance') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                    <span class="text-sm text-gray-500">Rentabilité brute</span>
                    <div class="text-xl font-bold text-blue-600">{{ number_format($rentabiliteBrute, 2) }}%</div>
                    <p class="text-xs text-gray-500 mt-1">Revenus locatifs annuels divisés par l'investissement total</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Rentabilité nette</span>
                    <div class="text-xl font-bold text-green-600">{{ number_format($rentabiliteNette, 2) }}%</div>
                    <p class="text-xs text-gray-500 mt-1">Revenus nets annuels divisés par votre apport personnel</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Revenu net annuel</span>
                    <div class="text-lg font-semibold text-purple-600">{{ number_format($revenuNetAnnuel, 2) }} MAD</div>
                    <p class="text-xs text-gray-500 mt-1">Loyers moins charges, vacance et impôts</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Durée d'amortissement</span>
                    <div class="text-lg font-semibold text-orange-600">
                        @if($dureeAmortissement !== null)
                            {{ number_format($dureeAmortissement, 1) }} années
                        @else
                            N/A
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Temps nécessaire pour récupérer votre investissement personnel</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Cash flow annuel</span>
                    <div class="text-lg font-semibold text-indigo-600">{{ number_format($cashFlowAnnuel, 2) }} MAD</div>
                    <p class="text-xs text-gray-500 mt-1">Flux de trésorerie annuel généré par l'investissement</p>
                </div>
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <span class="text-sm text-gray-500">Investissement personnel</span>
                    <div class="text-lg font-semibold text-gray-800">
                        {{ number_format(($prixAchat * $apportPersonnel / 100) + ($prixAchat * $fraisAcquisition / 100) + $montantTravaux, 2) }} MAD
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Apport + frais d'acquisition + travaux</p>
                </div>
            </div>

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
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Prix d'achat</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Loyer mensuel</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Rent. brute</th>
                        <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Rent. nette</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['prixAchat'], 0) }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['loyerMensuel'], 0) }}</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['rentabiliteBrute'], 2) }}%</td>
                            <td class="py-2 px-3 text-sm">{{ number_format($calcul['rentabiliteNette'], 2) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Section d'information pédagogique -->
    <div class="mt-8 p-4 bg-gray-50 rounded-md border border-gray-200">
        <h3 class="text-lg font-semibold mb-2">Comprendre la rentabilité locative</h3>

        <div class="space-y-3 text-sm text-gray-600">
            <p><strong>Rentabilité brute vs nette</strong> : La rentabilité brute ne prend en compte que les revenus locatifs par rapport à l'investissement total. La rentabilité nette est plus précise car elle intègre toutes les charges, la vacance locative et l'imposition.</p>

            <p><strong>Impact de l'apport personnel</strong> : Plus votre apport personnel est élevé, moins vous aurez recours au crédit bancaire, ce qui augmentera votre rentabilité nette en diminuant vos charges financières.</p>

            <p><strong>Durée d'amortissement</strong> : Elle indique le nombre d'années nécessaires pour récupérer votre investissement initial grâce aux revenus nets générés par le bien.</p>

            <p><strong>Vacance locative</strong> : Prévoir un taux de vacance réaliste (généralement entre 5% et 10% au Maroc) permet d'anticiper les périodes sans locataire entre deux locations.</p>

            <p>Pour un investissement immobilier rentable au Maroc, visez une rentabilité nette d'au moins 4% à 5%.</p>
        </div>
    </div>

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

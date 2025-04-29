<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        @if($type === 'salaire-net')
            <!-- Champs pour le calculateur de salaire net -->
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

        @elseif($type === 'credit-immobilier')
            <!-- Champs pour le simulateur de crédit immobilier -->
            <div>
                <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">
                    Montant du bien (MAD)
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

            <!-- Durée du prêt -->
            <div>
                <label for="duree" class="block text-sm font-medium text-gray-700 mb-1">
                    Durée du prêt (années)
                </label>
                <div class="relative">
                    <input
                        type="range"
                        id="duree"
                        wire:model.live="duree"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                        min="5"
                        max="30"
                        step="1"
                    >
                    <span class="block text-center mt-1">{{ $duree }} ans</span>
                </div>
                @error('duree') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Taux d'intérêt -->
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
                        min="0"
                        max="20"
                        step="0.01"
                        required
                    >
                    <span class="absolute right-3 top-2 text-gray-400">%</span>
                </div>
                @error('tauxInteret') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                        max="90"
                        step="1"
                    >
                    <span class="block text-center mt-1">{{ $apport }}%</span>
                </div>
                @error('apport') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

        @elseif($type === 'impots-revenu')
            <!-- Champs pour le calculateur d'impôts sur le revenu -->
            <div>
                <label for="revenusBruts" class="block text-sm font-medium text-gray-700 mb-1">
                    Revenus annuels bruts (MAD)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="revenusBruts"
                        wire:model="revenusBruts"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="0"
                        step="1000"
                        required
                    >
                    <span class="absolute right-3 top-2 text-gray-400">MAD</span>
                </div>
                @error('revenusBruts') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Charges déductibles -->
            <div>
                <label for="chargesDeductibles" class="block text-sm font-medium text-gray-700 mb-1">
                    Charges déductibles (MAD)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="chargesDeductibles"
                        wire:model="chargesDeductibles"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="0"
                        step="100"
                    >
                    <span class="absolute right-3 top-2 text-gray-400">MAD</span>
                </div>
                @error('chargesDeductibles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

        @elseif($type === 'taux-change')
            <!-- Champs pour le convertisseur de devises -->
            <div>
                <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">
                    Montant à convertir
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="montant"
                        wire:model="montant"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        min="0"
                        step="10"
                        required
                    >
                </div>
                @error('montant') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Devise source -->
            <div>
                <label for="deviseSource" class="block text-sm font-medium text-gray-700 mb-1">
                    Devise de départ
                </label>
                <select
                    id="deviseSource"
                    wire:model.live="deviseSource"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                >
                    <option value="MAD">Dirham marocain (MAD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="USD">Dollar américain (USD)</option>
                    <option value="GBP">Livre sterling (GBP)</option>
                </select>
            </div>

            <!-- Devise destination -->
            <div>
                <label for="deviseDestination" class="block text-sm font-medium text-gray-700 mb-1">
                    Devise d'arrivée
                </label>
                <select
                    id="deviseDestination"
                    wire:model.live="deviseDestination"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                >
                    <option value="EUR">Euro (EUR)</option>
                    <option value="USD">Dollar américain (USD)</option>
                    <option value="GBP">Livre sterling (GBP)</option>
                    <option value="MAD">Dirham marocain (MAD)</option>
                </select>
            </div>

        @elseif($type === 'rentabilite-locative')
            <!-- Prix d'achat -->
            <div>
                <label for="prixAchat" class="block text-sm font-medium text-gray-700 mb-1">
                    Prix d'achat du bien (MAD)
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

            <!-- Frais d'acquisition -->
            <div>
                <label for="fraisAcquisition" class="block text-sm font-medium text-gray-700 mb-1">
                    Frais d'acquisition (%)
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
                    <span class="block text-center mt-1">{{ $fraisAcquisition }}%</span>
                </div>
                @error('fraisAcquisition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Montant des travaux -->
            <div>
                <label for="montantTravaux" class="block text-sm font-medium text-gray-700 mb-1">
                    Montant des travaux (MAD)
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
        @endif

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

            @if($type === 'salaire-net')
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

            @elseif($type === 'credit-immobilier')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Mensualité</span>
                        <div class="text-xl font-bold text-blue-600">{{ number_format($mensualite, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Coût total du crédit</span>
                        <div class="text-lg font-semibold text-purple-600">{{ number_format($coutTotal, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Montant des intérêts</span>
                        <div class="text-lg font-semibold text-red-600">{{ number_format($montantInterets, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Revenu mensuel recommandé</span>
                        <div class="text-lg font-semibold text-green-600">{{ number_format($mensualite * 3, 2) }} MAD</div>
                    </div>
                </div>

            @elseif($type === 'impots-revenu')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Impôt sur le revenu</span>
                        <div class="text-xl font-bold text-blue-600">{{ number_format($montantIR, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Taux d'imposition moyen</span>
                        <div class="text-lg font-semibold text-purple-600">{{ number_format($tauxIR, 2) }}%</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Revenu net imposable</span>
                        <div class="text-lg font-semibold text-green-600">{{ number_format($revenusBruts - $chargesDeductibles, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Montant mensuel</span>
                        <div class="text-lg font-semibold text-orange-600">{{ number_format($montantIR / 12, 2) }} MAD</div>
                    </div>
                </div>

            @elseif($type === 'taux-change')
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-white p-4 rounded-md shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-sm text-gray-500">{{ $montant }} {{ $deviseSource }}</span>
                                <div class="text-2xl font-bold text-blue-600">{{ number_format($resultatPrincipal, 2) }} {{ $deviseDestination }}</div>
                            </div>
                            <div class="text-lg text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500">
                            Taux : 1 {{ $deviseSource }} =
                            {{ $deviseSource === $deviseDestination ? '1' : number_format($resultatPrincipal / $montant, 4) }} {{ $deviseDestination }}
                        </div>
                    </div>
                </div>

            @elseif($type === 'rentabilite-locative')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Rentabilité brute</span>
                        <div class="text-xl font-bold text-blue-600">{{ number_format($rentabiliteBrute, 2) }}%</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Rentabilité nette</span>
                        <div class="text-xl font-bold text-green-600">{{ number_format($rentabiliteNette, 2) }}%</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Revenu net annuel</span>
                        <div class="text-lg font-semibold text-purple-600">{{ number_format($revenuNetAnnuel, 2) }} MAD</div>
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
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Cash flow annuel</span>
                        <div class="text-lg font-semibold text-indigo-600">{{ number_format($cashFlowAnnuel, 2) }} MAD</div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow-sm">
                        <span class="text-sm text-gray-500">Investissement total</span>
                        <div class="text-lg font-semibold text-gray-800">
                            {{ number_format($prixAchat + ($prixAchat * $fraisAcquisition / 100) + $montantTravaux, 2) }} MAD
                        </div>
                    </div>
                </div>
            @endif

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
                        @if($type === 'salaire-net')
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Brut</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Net</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux IR</th>
                        @elseif($type === 'credit-immobilier')
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Durée</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Mensualité</th>
                        @elseif($type === 'impots-revenu')
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Revenus</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Impôt</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux moyen</th>
                        @elseif($type === 'taux-change')
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">De</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Vers</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Résultat</th>
                        @elseif($type === 'rentabilite-locative')
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Prix d'achat</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Loyer mensuel</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Rent. brute</th>
                            <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Rent. nette</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($historiqueCalculs) as $calcul)
                        <tr class="border-t border-gray-200">
                            <td class="py-2 px-3 text-sm">{{ $calcul['date'] }}</td>
                            @if($type === 'salaire-net')
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireBrut'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireNet'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ $calcul['tauxIR'] }}%</td>
                            @elseif($type === 'credit-immobilier')
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['montantPret'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ $calcul['duree'] }} ans</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['mensualite'], 2) }}</td>
                            @elseif($type === 'impots-revenu')
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['revenusBruts'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['montantIR'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['resultat'] / ($calcul['revenusBruts'] - $calcul['chargesDeductibles']) * 100, 2) }}%</td>
                            @elseif($type === 'taux-change')
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['montant'], 2) }}</td>
                                <td class="py-2 px-3 text-sm">{{ $calcul['deviseSource'] }}</td>
                                <td class="py-2 px-3 text-sm">{{ $calcul['deviseDestination'] }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['resultat'], 2) }}</td>
                            @elseif($type === 'rentabilite-locative')
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['prixAchat'], 0) }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['loyerMensuel'], 0) }}</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['rentabiliteBrute'], 2) }}%</td>
                                <td class="py-2 px-3 text-sm">{{ number_format($calcul['rentabiliteNette'], 2) }}%</td>
                            @endif
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

<div class="bg-white p-6 rounded-lg shadow-md">
    <!-- En-tête -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
        <p class="text-gray-600">{{ $description }}</p>
    </div>

    <!-- Formulaire -->
    <form wire:submit.prevent="calculer" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Prix d'achat -->
            <div>
                <label for="prixAchat" class="block text-sm font-medium text-gray-700 mb-1">Prix d'achat (MAD)</label>
                <input type="number" id="prixAchat" wire:model="prixAchat" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('prixAchat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Frais d'acquisition -->
            <div>
                <label for="fraisAcquisition" class="block text-sm font-medium text-gray-700 mb-1">Frais d'acquisition (%)</label>
                <input type="number" id="fraisAcquisition" wire:model="fraisAcquisition" step="0.01" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('fraisAcquisition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Montant des travaux -->
            <div>
                <label for="montantTravaux" class="block text-sm font-medium text-gray-700 mb-1">Montant des travaux (MAD)</label>
                <input type="number" id="montantTravaux" wire:model="montantTravaux" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('montantTravaux') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Loyer mensuel -->
            <div>
                <label for="loyerMensuel" class="block text-sm font-medium text-gray-700 mb-1">Loyer mensuel (MAD)</label>
                <input type="number" id="loyerMensuel" wire:model="loyerMensuel" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('loyerMensuel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Charges annuelles -->
            <div>
                <label for="chargesAnnuelles" class="block text-sm font-medium text-gray-700 mb-1">Charges annuelles (MAD)</label>
                <input type="number" id="chargesAnnuelles" wire:model="chargesAnnuelles" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('chargesAnnuelles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Taux d'imposition -->
            <div>
                <label for="tauxImposition" class="block text-sm font-medium text-gray-700 mb-1">Taux d'imposition (%)</label>
                <input type="number" id="tauxImposition" wire:model="tauxImposition" step="0.01" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('tauxImposition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Taux de vacance locative -->
            <div>
                <label for="tauxVacance" class="block text-sm font-medium text-gray-700 mb-1">Taux de vacance locative (%)</label>
                <input type="number" id="tauxVacance" wire:model="tauxVacance" step="0.01" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('tauxVacance') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-between mt-8">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                Calculer la rentabilité
            </button>
            <button type="button" wire:click="reset_form" class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">
                Réinitialiser
            </button>
        </div>
    </form>

    <!-- Résultats -->
    @if($rentabiliteNette !== null)
    <div class="mt-8 p-4 border border-blue-200 rounded-lg bg-blue-50">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Résultats de l'analyse de rentabilité</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Rentabilité brute -->
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-600">Rentabilité brute</p>
                <p class="text-2xl font-bold text-blue-600">{{ number_format($rentabiliteBrute, 2) }} %</p>
            </div>

            <!-- Rentabilité nette -->
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-600">Rentabilité nette</p>
                <p class="text-2xl font-bold text-green-600">{{ number_format($rentabiliteNette, 2) }} %</p>
            </div>

            <!-- Revenu net annuel -->
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-600">Revenu net annuel</p>
                <p class="text-xl font-bold">{{ number_format($revenuNetAnnuel) }} MAD</p>
            </div>

            <!-- Cash flow annuel -->
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-600">Cash flow annuel</p>
                <p class="text-xl font-bold">{{ number_format($cashFlowAnnuel) }} MAD</p>
            </div>

            <!-- Durée d'amortissement -->
            <div class="col-span-1 md:col-span-2 bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-600">Durée d'amortissement</p>
                <p class="text-xl font-bold">{{ $dureeAmortissement ? number_format($dureeAmortissement, 1) . ' années' : 'Non calculable' }}</p>
            </div>
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <p>Cette analyse est basée sur les informations que vous avez fournies. Les résultats peuvent varier en fonction de facteurs externes comme l'évolution du marché immobilier, les changements fiscaux ou réglementaires.</p>
        </div>
    </div>
    @endif

    <!-- Historique des calculs -->
    @if(count($historiqueCalculs) > 0)
    <div class="mt-8">
        <h3 class="text-lg font-medium text-gray-800 mb-2">Historique de vos calculs</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Prix d'achat</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Loyer mensuel</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Rentabilité brute</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Rentabilité nette</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historiqueCalculs as $calcul)
                    <tr>
                        <td class="py-2 px-4 border-b text-sm">{{ $calcul['date'] }}</td>
                        <td class="py-2 px-4 border-b text-sm">{{ number_format($calcul['prixAchat']) }} MAD</td>
                        <td class="py-2 px-4 border-b text-sm">{{ number_format($calcul['loyerMensuel']) }} MAD</td>
                        <td class="py-2 px-4 border-b text-sm">{{ number_format($calcul['rentabiliteBrute'], 2) }} %</td>
                        <td class="py-2 px-4 border-b text-sm">{{ number_format($calcul['rentabiliteNette'], 2) }} %</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Informations complémentaires -->
    <div class="mt-8 p-4 border border-gray-200 rounded-lg bg-gray-50">
        <h3 class="text-lg font-medium text-gray-800 mb-2">À propos de la rentabilité locative</h3>
        <p class="text-sm text-gray-600 mb-2">La rentabilité brute est le rapport entre les loyers annuels et l'investissement total (prix d'achat + frais d'acquisition + travaux).</p>
        <p class="text-sm text-gray-600 mb-2">La rentabilité nette prend en compte les charges, la vacance locative et l'imposition pour donner une image plus précise du rendement réel.</p>
        <p class="text-sm text-gray-600">Pour un investissement immobilier rentable au Maroc, visez une rentabilité nette d'au moins 4% à 5%.</p>
    </div>
</div>

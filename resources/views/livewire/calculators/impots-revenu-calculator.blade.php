@extends('livewire.calculators.calculator-layout')

@section('calculator-form')
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
@endsection

@section('calculator-results')
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
@endsection

@section('history-headers')
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Revenus</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Impôt</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux moyen</th>
@endsection

@section('history-data')
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['revenusBruts'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['montantIR'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['resultat'] / ($calcul['revenusBruts'] - $calcul['chargesDeductibles']) * 100, 2) }}%</td>
@endsection

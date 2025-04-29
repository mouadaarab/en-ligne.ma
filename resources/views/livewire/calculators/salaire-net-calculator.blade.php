@extends('livewire.calculators.calculator-layout')

@section('calculator-form')
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
@endsection

@section('calculator-results')
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
@endsection

@section('history-headers')
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Brut</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Net</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Taux IR</th>
@endsection

@section('history-data')
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireBrut'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['salaireNet'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ $calcul['tauxIR'] }}%</td>
@endsection

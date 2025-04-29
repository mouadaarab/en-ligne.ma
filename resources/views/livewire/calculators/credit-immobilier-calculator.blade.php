@extends('livewire.calculators.calculator-layout')

@section('calculator-form')
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
@endsection

@section('calculator-results')
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
@endsection

@section('history-headers')
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Durée</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Mensualité</th>
@endsection

@section('history-data')
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['montantPret'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ $calcul['duree'] }} ans</td>
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['mensualite'], 2) }}</td>
@endsection

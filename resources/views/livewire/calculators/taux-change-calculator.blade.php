@extends('livewire.calculators.calculator-layout')

@section('calculator-form')
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
@endsection

@section('calculator-results')
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
@endsection

@section('history-headers')
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">De</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Vers</th>
    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Résultat</th>
@endsection

@section('history-data')
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['montant'], 2) }}</td>
    <td class="py-2 px-3 text-sm">{{ $calcul['deviseSource'] }}</td>
    <td class="py-2 px-3 text-sm">{{ $calcul['deviseDestination'] }}</td>
    <td class="py-2 px-3 text-sm">{{ number_format($calcul['resultat'], 2) }}</td>
@endsection

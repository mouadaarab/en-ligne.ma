<div class="calculator-card bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
    <p class="text-gray-600 mb-6">{{ $description }}</p>

    <form wire:submit="calculer" class="space-y-4">
        <!-- Montant -->
        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">
                Montant
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="text" id="montant" name="montant" wire:model.live="montant"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md"
                    placeholder="0.00">
            </div>
            @error('montant')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Devise source -->
        <div>
            <label for="deviseSource" class="block text-sm font-medium text-gray-700 mb-1">
                De
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select id="deviseSource" name="deviseSource" wire:model.live="deviseSource"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md">
                    <option value="MAD">Dirham Marocain (MAD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="USD">Dollar Américain (USD)</option>
                    <option value="GBP">Livre Sterling (GBP)</option>
                </select>
            </div>
            @error('deviseSource')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Devise cible -->
        <div>
            <label for="deviseCible" class="block text-sm font-medium text-gray-700 mb-1">
                Vers
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select id="deviseCible" name="deviseCible" wire:model.live="deviseCible"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md">
                    <option value="MAD">Dirham Marocain (MAD)</option>
                    <option value="EUR">Euro (EUR)</option>
                    <option value="USD">Dollar Américain (USD)</option>
                    <option value="GBP">Livre Sterling (GBP)</option>
                </select>
            </div>
            @error('deviseCible')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex space-x-4 pt-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Convertir
            </button>
            <button type="button" wire:click="resetForm"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Réinitialiser
            </button>
        </div>
    </form>

    @if($resultat)
    <div class="mt-8 p-4 bg-gray-50 rounded-md">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Résultat</h3>
        <div class="flex items-center justify-between">
            <span class="text-gray-700">{{ number_format($montant, 2) }} {{ $deviseSource }}</span>
            <span class="text-gray-500 mx-4">→</span>
            <span class="text-xl font-bold text-indigo-700">{{ number_format($resultat, 2) }} {{ $deviseCible }}</span>
        </div>
        <p class="mt-2 text-sm text-gray-500">Taux de change: 1 {{ $deviseSource }} = {{ number_format($tauxDeChange, 4) }} {{ $deviseCible }}</p>
    </div>
    @endif

    @if(count($historiqueCalculs) > 0)
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Historique des calculs</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Conversion</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Résultat</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($historiqueCalculs as $index => $historique)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $historique['date'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($historique['montant'], 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $historique['deviseSource'] }} → {{ $historique['deviseCible'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                            {{ number_format($historique['resultat'], 2) }} {{ $historique['deviseCible'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
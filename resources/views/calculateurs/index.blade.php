@extends('layouts.app')

@section('content')
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Nos Calculateurs et Simulateurs</h1>
        <p class="text-xl text-gray-600">Tous les outils dont vous avez besoin pour vos calculs financiers au Maroc</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <!-- Calculateur de salaire net -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-blue-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Calculateur de Salaire Net</h2>
                <p class="text-gray-600 mb-4 h-24">Estimez votre salaire net à partir du brut en prenant en compte tous les prélèvements sociaux et fiscaux marocains.</p>
                <div class="flex items-center mb-4 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Calcul instantané
                </div>
                <a href="{{ route('calculateurs.show', 'salaire-net') }}" class="inline-block w-full px-4 py-2 bg-blue-600 text-white rounded text-center hover:bg-blue-700 transition-colors">
                    Utiliser le calculateur
                </a>
            </div>
        </div>

        <!-- Simulateur de crédit immobilier -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-green-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Simulateur de Crédit Immobilier</h2>
                <p class="text-gray-600 mb-4 h-24">Simulez vos mensualités de crédit immobilier et découvrez votre capacité d'emprunt auprès des banques marocaines.</p>
                <div class="flex items-center mb-4 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Taux mis à jour
                </div>
                <a href="{{ route('calculateurs.show', 'credit-immobilier') }}" class="inline-block w-full px-4 py-2 bg-green-600 text-white rounded text-center hover:bg-green-700 transition-colors">
                    Utiliser le simulateur
                </a>
            </div>
        </div>

        <!-- Calculateur d'impôts sur le revenu -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-orange-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Calculateur d'Impôts</h2>
                <p class="text-gray-600 mb-4 h-24">Estimez vos impôts sur le revenu selon les barèmes fiscaux marocains actuels et optimisez votre situation fiscale.</p>
                <div class="flex items-center mb-4 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Barèmes 2025
                </div>
                <a href="{{ route('calculateurs.show', 'impots-revenu') }}" class="inline-block w-full px-4 py-2 bg-orange-600 text-white rounded text-center hover:bg-orange-700 transition-colors">
                    Utiliser le calculateur
                </a>
            </div>
        </div>

        <!-- Convertisseur de devises -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-purple-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Convertisseur de Devises</h2>
                <p class="text-gray-600 mb-4 h-24">Convertissez rapidement le dirham marocain (MAD) vers d'autres devises internationales avec des taux de change actualisés.</p>
                <div class="flex items-center mb-4 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Taux en temps réel
                </div>
                <a href="{{ route('calculateurs.show', 'taux-change') }}" class="inline-block w-full px-4 py-2 bg-purple-600 text-white rounded text-center hover:bg-purple-700 transition-colors">
                    Utiliser le convertisseur
                </a>
            </div>
        </div>

        <!-- Calculateur de rentabilité locative -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-red-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Calculateur de Rentabilité Locative</h2>
                <p class="text-gray-600 mb-4 h-24">Évaluez la rentabilité de votre investissement immobilier locatif au Maroc en calculant les rendements bruts et nets.</p>
                <div class="flex items-center mb-4 text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Analyse complète
                </div>
                <a href="{{ route('calculateurs.show', 'rentabilite-locative') }}" class="inline-block w-full px-4 py-2 bg-red-600 text-white rounded text-center hover:bg-red-700 transition-colors">
                    Utiliser le calculateur
                </a>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 p-8 rounded-lg mt-8 mb-12">
        <h2 class="text-2xl font-bold mb-4">Vous ne trouvez pas ce que vous cherchez ?</h2>
        <p class="mb-6">Nous ajoutons régulièrement de nouveaux calculateurs à notre site. Si vous avez des suggestions ou des besoins spécifiques, n'hésitez pas à nous contacter.</p>
        <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition-colors">Suggérer un calculateur</a>
    </div>
@endsection

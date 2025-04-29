@extends('layouts.app')

@section('content')
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Simulateurs et Calculateurs Marocains</h1>
        <p class="text-xl text-gray-600">Outils en ligne gratuits pour vos calculs et simulations au Maroc</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <!-- Calculateur de salaire net -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-blue-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Calculateur de Salaire Net</h2>
                <p class="text-gray-600 mb-4">Estimez votre salaire net à partir du brut en prenant en compte tous les prélèvements sociaux et fiscaux marocains.</p>
                <a href="/calculateurs/salaire-net" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    Accéder au calculateur
                </a>
            </div>
        </div>

        <!-- Simulateur de crédit immobilier -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-green-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Simulateur de Crédit Immobilier</h2>
                <p class="text-gray-600 mb-4">Simulez vos mensualités de crédit immobilier et découvrez votre capacité d'emprunt auprès des banques marocaines.</p>
                <a href="/calculateurs/credit-immobilier" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                    Accéder au simulateur
                </a>
            </div>
        </div>

        <!-- Calculateur d'impôts sur le revenu -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-3 bg-orange-600"></div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">Calculateur d'Impôts</h2>
                <p class="text-gray-600 mb-4">Estimez vos impôts sur le revenu selon les barèmes fiscaux marocains actuels et optimisez votre situation fiscale.</p>
                <a href="/calculateurs/impots-revenu" class="inline-block px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 transition-colors">
                    Accéder au calculateur
                </a>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 rounded-lg p-8 mb-12">
        <h2 class="text-3xl font-bold mb-6">Pourquoi utiliser nos calculateurs ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Rapide et efficace</h3>
                <p class="text-gray-600">Obtenez vos résultats instantanément sans procédure complexe</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">100% fiable</h3>
                <p class="text-gray-600">Calculs basés sur les lois et réglementations marocaines en vigueur</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Totalement gratuit</h3>
                <p class="text-gray-600">Accès illimité à tous nos outils sans frais ni inscription</p>
            </div>
        </div>
    </div>

    {{-- FAQ pour améliorer le SEO --}}
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-6">Questions fréquentes</h2>
        <div class="space-y-4">
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">Comment calculer son salaire net au Maroc ?</h3>
                <p class="text-gray-600">Pour calculer votre salaire net au Maroc, il faut déduire du salaire brut les cotisations sociales (CNSS, AMO) et l'impôt sur le revenu (IR). Notre calculateur de salaire net prend en compte tous ces éléments automatiquement.</p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">Comment fonctionne un crédit immobilier au Maroc ?</h3>
                <p class="text-gray-600">Au Maroc, les banques proposent généralement des crédits immobiliers sur une durée de 5 à 25 ans. Le taux d'intérêt moyen se situe entre 4% et 5.5%. Notre simulateur vous permet d'estimer vos mensualités et votre capacité d'emprunt selon votre profil.</p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">Comment optimiser ses impôts sur le revenu ?</h3>
                <p class="text-gray-600">Pour optimiser votre fiscalité au Maroc, vous pouvez profiter des déductions légales comme l'épargne retraite, l'assurance-vie, ou les intérêts d'emprunt immobilier pour votre résidence principale. Notre calculateur vous aide à visualiser l'impact de ces déductions.</p>
            </div>
        </div>
    </div>
@endsection

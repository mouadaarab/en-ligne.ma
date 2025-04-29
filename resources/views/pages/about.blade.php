@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">À propos d'En-Ligne.ma</h1>

        <div class="bg-white rounded-lg shadow-md p-8 mb-12">
            <div class="prose lg:prose-xl max-w-none">
                <p class="text-lg">
                    <strong class="text-blue-600">En-Ligne.ma</strong> est la référence marocaine des calculateurs et simulateurs en ligne.
                    Notre mission est de simplifier la vie des Marocains en leur offrant des outils de calcul fiables, gratuits et faciles à utiliser.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Notre mission</h2>
                <p>
                    Nous croyons que l'accès à des outils de calcul précis et fiables ne devrait pas être un privilège.
                    C'est pourquoi nous avons créé En-Ligne.ma, une plateforme qui propose des calculateurs adaptés spécifiquement au contexte marocain.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Nos valeurs</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Fiabilité</h3>
                        <p>Nos calculateurs sont basés sur les lois et réglementations marocaines en vigueur, et sont régulièrement mis à jour.</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Accessibilité</h3>
                        <p>Nous concevons nos outils pour qu'ils soient simples d'utilisation et accessibles à tous, quel que soit le niveau technique.</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Innovation</h3>
                        <p>Nous travaillons constamment à améliorer nos outils existants et à en développer de nouveaux pour répondre aux besoins des Marocains.</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mt-8 mb-4">Notre histoire</h2>
                <p>
                    En-Ligne.ma a été créé en 2023 par une équipe de passionnés de technologies et d'experts en finance, fiscalité et immobilier.
                    Face à la difficulté de trouver des calculateurs adaptés au contexte marocain, nous avons décidé de créer notre propre plateforme.
                </p>
                <p>
                    Aujourd'hui, En-Ligne.ma est utilisé par des milliers de Marocains chaque jour pour réaliser leurs calculs financiers,
                    estimer leurs impôts ou encore préparer leur projet immobilier.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Notre équipe</h2>
                <p>
                    Derrière En-Ligne.ma, il y a une équipe passionnée et dédiée à offrir les meilleurs outils de calcul aux Marocains.
                    Nos experts en finance, fiscalité, programmation et expérience utilisateur travaillent ensemble pour créer des calculateurs
                    à la fois précis et intuitifs.
                </p>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 my-8">
                    <h3 class="text-xl font-semibold mb-3">Vous avez des suggestions ?</h3>
                    <p class="mb-4">
                        Nous sommes toujours à l'écoute de nos utilisateurs. Si vous avez des suggestions d'amélioration ou des idées
                        de nouveaux calculateurs, n'hésitez pas à nous contacter.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

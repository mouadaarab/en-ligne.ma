@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Contactez-nous</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div>
                <p class="text-lg text-gray-600 mb-6">
                    Vous avez des questions sur nos calculateurs? Une suggestion d'amélioration?
                    Ou peut-être souhaitez-vous nous proposer un nouveau calculateur?
                    N'hésitez pas à nous contacter via le formulaire ci-contre.
                </p>

                <div class="space-y-4 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-700">contact@en-ligne.ma</span>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-700">Casablanca, Maroc</span>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                    <h3 class="text-xl font-semibold mb-3">Horaires de réponse</h3>
                    <p class="text-gray-600 mb-4">Nous nous efforçons de répondre à toutes les demandes dans un délai de 48 heures ouvrables.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Sujet</label>
                        <select id="subject" name="subject" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <option value="question">Question générale</option>
                            <option value="suggestion">Suggestion d'amélioration</option>
                            <option value="new-calculator">Proposition de nouveau calculateur</option>
                            <option value="bug">Signaler un problème</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Votre message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-12 mb-8">
            <h2 class="text-2xl font-bold mb-6">Questions fréquemment posées</h2>
            <div class="space-y-4">
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Les calculateurs sont-ils vraiment gratuits ?</h3>
                    <p class="text-gray-600">Oui, tous nos calculateurs sont entièrement gratuits et le resteront. Notre mission est de fournir des outils utiles et accessibles à tous les Marocains.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Les résultats des calculateurs sont-ils fiables ?</h3>
                    <p class="text-gray-600">Nos calculateurs utilisent les formules et barèmes officiels en vigueur au Maroc. Cependant, ils sont fournis à titre indicatif et ne remplacent pas l'avis d'un expert pour des situations particulières.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Comment proposer un nouveau calculateur ?</h3>
                    <p class="text-gray-600">Vous pouvez nous suggérer un nouveau calculateur via le formulaire de contact ci-dessus. Nous étudions toutes les propositions et développons régulièrement de nouveaux outils.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

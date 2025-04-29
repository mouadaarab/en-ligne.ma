@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Politique de confidentialité</h1>

        <div class="bg-white rounded-lg shadow-md p-8 mb-12">
            <div class="prose max-w-none">
                <p class="text-lg">
                    En-Ligne.ma accorde une grande importance à la protection de votre vie privée. Cette politique de confidentialité
                    vous explique comment nous collectons, utilisons et protégeons vos données personnelles.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Collecte des données</h2>
                <p>
                    Lorsque vous utilisez nos calculateurs et simulateurs, nous pouvons collecter les informations suivantes :
                </p>
                <ul class="list-disc pl-6 mb-4">
                    <li>Les données que vous saisissez dans nos calculateurs (salaire, montant d'emprunt, etc.).</li>
                    <li>Des informations sur votre appareil et votre navigateur (type d'appareil, type de navigateur, etc.).</li>
                    <li>Votre adresse IP.</li>
                    <li>Des informations sur la manière dont vous utilisez notre site (pages visitées, durée de visite, etc.).</li>
                </ul>
                <p>
                    Si vous nous contactez via notre formulaire de contact, nous collectons également votre nom, votre adresse email
                    et toute autre information que vous nous communiquez.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Utilisation des données</h2>
                <p>
                    Nous utilisons les données collectées pour :
                </p>
                <ul class="list-disc pl-6 mb-4">
                    <li>Vous fournir les résultats de calcul demandés.</li>
                    <li>Améliorer nos calculateurs et notre site web.</li>
                    <li>Répondre à vos questions et demandes.</li>
                    <li>Analyser l'utilisation de notre site et établir des statistiques anonymes.</li>
                    <li>Prévenir les abus et les activités frauduleuses.</li>
                </ul>

                <h2 class="text-2xl font-bold mt-8 mb-4">Conservation des données</h2>
                <p>
                    Les données saisies dans nos calculateurs ne sont pas stockées de manière permanente sur nos serveurs,
                    sauf si vous utilisez explicitement la fonction "Enregistrer l'historique" disponible sur certains calculateurs.
                    Dans ce cas, les données sont stockées dans le stockage local de votre navigateur et ne sont pas transmises à nos serveurs.
                </p>
                <p>
                    Les informations que vous nous communiquez via notre formulaire de contact sont conservées pendant une durée de 2 ans
                    à compter de notre dernier échange.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Cookies et technologies similaires</h2>
                <p>
                    Nous utilisons des cookies et des technologies similaires pour améliorer votre expérience sur notre site,
                    analyser son utilisation et vous proposer des contenus pertinents. Vous pouvez désactiver les cookies dans
                    les paramètres de votre navigateur, mais certaines fonctionnalités du site pourraient ne plus être disponibles.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Partage des données</h2>
                <p>
                    Nous ne vendons ni ne louons vos données personnelles à des tiers. Nous ne partageons vos données qu'avec :
                </p>
                <ul class="list-disc pl-6 mb-4">
                    <li>Nos prestataires de services qui nous aident à exploiter notre site (hébergement, analyse, etc.).</li>
                    <li>Les autorités compétentes, si la loi nous y oblige.</li>
                </ul>

                <h2 class="text-2xl font-bold mt-8 mb-4">Sécurité des données</h2>
                <p>
                    Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger vos données personnelles
                    contre tout accès non autorisé, modification, divulgation ou destruction.
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Vos droits</h2>
                <p>
                    Conformément à la loi 09-08 relative à la protection des personnes physiques à l'égard du traitement des données
                    à caractère personnel, vous disposez des droits suivants :
                </p>
                <ul class="list-disc pl-6 mb-4">
                    <li>Droit d'accès à vos données personnelles.</li>
                    <li>Droit de rectification de vos données personnelles.</li>
                    <li>Droit d'opposition au traitement de vos données personnelles.</li>
                    <li>Droit à l'effacement de vos données personnelles.</li>
                    <li>Droit à la limitation du traitement de vos données personnelles.</li>
                </ul>
                <p>
                    Pour exercer ces droits, vous pouvez nous contacter à l'adresse : privacy@en-ligne.ma
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Modifications de la politique de confidentialité</h2>
                <p>
                    Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment.
                    Toute modification sera publiée sur cette page avec la date de sa dernière mise à jour.
                </p>
                <p>
                    Dernière mise à jour : 23 avril 2025
                </p>

                <h2 class="text-2xl font-bold mt-8 mb-4">Contact</h2>
                <p>
                    Si vous avez des questions concernant notre politique de confidentialité, vous pouvez nous contacter à l'adresse :
                    privacy@en-ligne.ma ou via notre <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800">formulaire de contact</a>.
                </p>
            </div>
        </div>
    </div>
@endsection

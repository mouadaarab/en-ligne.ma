@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $title }}</h1>
        <p class="text-gray-600">{{ $description }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            {{-- Intégration du composant Livewire du calculateur --}}
            @livewire('calculators.'.$type.'-calculator')

            {{-- Section d'informations complémentaires --}}

            {{-- Section d'informations complémentaires SEO-friendly --}}
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Comment ça fonctionne ?</h2>

                @if($type === 'salaire-net')
                    <p class="mb-4">Notre calculateur de salaire net au Maroc prend en compte :</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2 text-gray-700">
                        <li>Les cotisations CNSS (4,48% du salaire brut)</li>
                        <li>Les cotisations AMO (2,26% du salaire brut)</li>
                        <li>L'impôt sur le revenu (IR) selon les tranches d'imposition en vigueur</li>
                    </ul>
                    <p class="mb-4">Le salaire net est calculé en déduisant ces charges du salaire brut.</p>

                @elseif($type === 'credit-immobilier')
                    <p class="mb-4">Notre simulateur de crédit immobilier au Maroc vous permet de :</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2 text-gray-700">
                        <li>Calculer vos mensualités en fonction du montant emprunté</li>
                        <li>Estimer le coût total de votre crédit immobilier</li>
                        <li>Comparer différentes durées et taux d'intérêt</li>
                        <li>Évaluer votre capacité d'emprunt selon vos revenus</li>
                    </ul>

                @elseif($type === 'impots-revenu')
                    <p class="mb-4">Notre calculateur d'impôt sur le revenu au Maroc vous permet de :</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2 text-gray-700">
                        <li>Estimer votre IR selon les tranches d'imposition actuelles</li>
                        <li>Prendre en compte les déductions fiscales auxquelles vous avez droit</li>
                        <li>Calculer votre taux d'imposition marginal et moyen</li>
                    </ul>

                @elseif($type === 'taux-change')
                    <p class="mb-4">Notre convertisseur de devises marocain vous permet de :</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2 text-gray-700">
                        <li>Convertir le dirham marocain (MAD) en d'autres devises</li>
                        <li>Consulter les taux de change actualisés</li>
                        <li>Calculer rapidement vos conversions pour vos voyages ou transactions</li>
                    </ul>

                @elseif($type === 'rentabilite-locative')
                    <p class="mb-4">Notre calculateur de rentabilité locative au Maroc vous permet de :</p>
                    <ul class="list-disc pl-6 mb-4 space-y-2 text-gray-700">
                        <li>Calculer la rentabilité brute de votre investissement immobilier</li>
                        <li>Estimer la rentabilité nette en prenant compte des charges</li>
                        <li>Déterminer la durée d'amortissement de votre bien</li>
                        <li>Analyser le cash flow annuel généré par votre investissement</li>
                        <li>Prendre en compte le taux de vacance locative et l'imposition</li>
                    </ul>
                @endif

                <p class="text-gray-600 italic">Les résultats sont fournis à titre indicatif et ne peuvent pas se substituer à l'avis d'un expert comptable ou financier.</p>
            </div>
        </div>

        <div class="lg:col-span-1">
            {{-- Sidebar avec articles associés --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Articles associés</h2>
                @if($relatedArticles->count() > 0)
                    <ul class="space-y-3">
                        @foreach($relatedArticles as $article)
                            <li>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $article->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 pt-3 border-t border-gray-200">
                        <a href="{{ route('articles.category', $type) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Voir tous les articles →
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Aucun article disponible pour le moment.</p>
                @endif
            </div>

            <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                <h2 class="text-xl font-semibold mb-3">Vous avez une question ?</h2>
                <p class="text-gray-600 mb-4">Notre équipe est disponible pour vous aider et répondre à toutes vos questions.</p>
                <a href="{{ route('contact') }}" class="inline-block w-full px-4 py-2 bg-blue-600 text-white rounded text-center hover:bg-blue-700 transition-colors">Nous contacter</a>
            </div>
        </div>
    </div>

    {{-- Section FAQ pour le SEO --}}
    <div class="mt-12 mb-8">
        <h2 class="text-3xl font-bold mb-6">Questions fréquentes</h2>
        <div class="space-y-4">
            @if($type === 'salaire-net')
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Comment calculer son salaire net au Maroc en 2025 ?</h3>
                    <p class="text-gray-600">Pour calculer votre salaire net au Maroc, déduisez du salaire brut les cotisations CNSS (4,48%), l'AMO (2,26%), puis l'impôt sur le revenu selon les tranches en vigueur. Notre calculateur automatise tous ces calculs pour vous.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quel est le taux de cotisation CNSS en 2025 ?</h3>
                    <p class="text-gray-600">En 2025, le taux de cotisation salariale à la CNSS est de 4,48% du salaire brut, plafonné à 6.000 DH par mois. La part patronale est de 8,89% pour les allocations familiales, 7,93% pour les prestations sociales et 1,05% pour l'AMO.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Comment sont calculées les tranches d'impôt sur le revenu ?</h3>
                    <p class="text-gray-600">Les tranches d'IR au Maroc en 2025 sont progressives : de 0 à 30.000 DH annuels (0%), de 30.001 à 50.000 DH (10%), de 50.001 à 60.000 DH (20%), de 60.001 à 80.000 DH (30%), de 80.001 à 180.000 DH (34%), et au-delà de 180.000 DH (38%).</p>
                </div>
            @elseif($type === 'credit-immobilier')
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quel est le meilleur taux pour un crédit immobilier au Maroc en 2025 ?</h3>
                    <p class="text-gray-600">En 2025, les taux de crédit immobilier au Maroc varient entre 4% et 5.5% selon les banques et votre profil. Les meilleurs taux sont généralement obtenus pour des durées courtes à moyennes (5-15 ans) et avec un apport personnel conséquent (minimum 30%).</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quelle est la durée maximale d'un prêt immobilier au Maroc ?</h3>
                    <p class="text-gray-600">La durée maximale d'un crédit immobilier au Maroc est généralement de 25 ans. Certaines banques peuvent proposer des durées jusqu'à 30 ans pour des projets spécifiques, mais les conditions sont plus restrictives.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quel revenu faut-il pour emprunter 1 million de dirhams ?</h3>
                    <p class="text-gray-600">Pour emprunter 1 million de dirhams sur 20 ans avec un taux d'intérêt de 4,5%, vous devrez rembourser environ 6.300 DH par mois. Selon la règle du taux d'endettement maximal de 33%, vous devrez justifier d'un revenu mensuel net d'au moins 19.000 DH.</p>
                </div>
            @elseif($type === 'impots-revenu')
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quelles sont les déductions fiscales possibles au Maroc en 2025 ?</h3>
                    <p class="text-gray-600">En 2025 au Maroc, vous pouvez déduire de votre revenu imposable : les intérêts de prêts immobiliers pour votre résidence principale (plafonnés à 10% du revenu global imposable), les primes d'assurance-retraite (plafonnées à 50% du salaire net imposable), et certaines cotisations à des organismes de prévoyance sociale.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Comment déclarer ses revenus au Maroc ?</h3>
                    <p class="text-gray-600">La déclaration annuelle des revenus au Maroc (modèle IR) doit être déposée avant le 1er mars pour les revenus professionnels selon le régime du résultat net réel ou simplifié, et avant le 1er avril pour les revenus fonciers. Les salariés dont l'employeur prélève l'IR à la source n'ont généralement pas besoin de faire une déclaration.</p>
                </div>
            @elseif($type === 'taux-change')
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Où obtenir le meilleur taux de change pour le dirham marocain ?</h3>
                    <p class="text-gray-600">Pour obtenir le meilleur taux de change pour le dirham marocain, privilégiez les bureaux de change officiels dans les grandes villes comme Casablanca, Rabat ou Marrakech. Évitez les bureaux de change des hôtels ou aéroports qui pratiquent des marges plus importantes.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Peut-on sortir des dirhams du Maroc ?</h3>
                    <p class="text-gray-600">Non, la législation marocaine interdit l'exportation de dirhams. Les résidents marocains peuvent emporter jusqu'à 45.000 DH en devises étrangères pour leurs voyages à l'étranger, et les touristes doivent convertir leurs dirhams en devises avant de quitter le pays, en présentant des justificatifs de change initial.</p>
                </div>
            @elseif($type === 'rentabilite-locative')
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Comment calculer la rentabilité brute d'un investissement locatif ?</h3>
                    <p class="text-gray-600">La rentabilité brute d'un investissement locatif se calcule en divisant le loyer annuel par le prix d'achat du bien, puis en multipliant par 100 pour obtenir un pourcentage. Par exemple, un bien acheté 1.000.000 DH qui génère 60.000 DH de loyer annuel a une rentabilité brute de 6%.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quelle est la différence entre rentabilité brute et nette ?</h3>
                    <p class="text-gray-600">La rentabilité brute ne prend en compte que le loyer et le prix d'achat, tandis que la rentabilité nette intègre toutes les charges (taxe d'habitation, frais de gestion, charges de copropriété, impôts fonciers, etc.) et la fiscalité. La rentabilité nette est un indicateur plus précis de la performance réelle de votre investissement.</p>
                </div>
                <div class="bg-white p-5 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Quelle est la rentabilité locative moyenne au Maroc en 2025 ?</h3>
                    <p class="text-gray-600">En 2025, la rentabilité locative moyenne au Maroc varie entre 4% et 7% brut selon les villes et les quartiers. Les grandes villes comme Casablanca et Rabat offrent des rendements plus faibles (4-5%) mais avec une meilleure sécurité locative, tandis que les villes moyennes peuvent atteindre 6-7% avec un risque légèrement plus élevé de vacance locative.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

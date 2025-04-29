<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Articles pour le calculateur de salaire net
        Article::create([
            'title' => 'Comment est calculé l\'IR au Maroc ?',
            'excerpt' => 'Guide complet sur le calcul de l\'impôt sur le revenu au Maroc avec les derniers barèmes fiscaux.',
            'content' => '<p>L\'impôt sur le revenu (IR) au Maroc est un prélèvement fiscal progressif qui s\'applique aux revenus des personnes physiques. Il est calculé selon un barème progressif à tranches.</p><h2>Les tranches d\'imposition</h2><p>Voici les tranches d\'imposition en vigueur :</p><ul><li>De 0 à 30 000 DH : 0%</li><li>De 30 001 à 50 000 DH : 10%</li><li>De 50 001 à 60 000 DH : 20%</li><li>De 60 001 à 80 000 DH : 30%</li><li>De 80 001 à 180 000 DH : 34%</li><li>Plus de 180 000 DH : 38%</li></ul><p>Pour calculer votre IR, vous devez appliquer le taux correspondant à chaque tranche de votre revenu imposable.</p>',
            'category' => 'salaire-net',
            'published' => true,
            'published_at' => Carbon::now()->subDays(5),
            'meta_title' => 'Comment est calculé l\'IR au Maroc ? Guide complet 2025',
            'meta_description' => 'Découvrez comment calculer votre impôt sur le revenu au Maroc : barèmes fiscaux, tranches d\'imposition et exemples de calcul.'
        ]);

        Article::create([
            'title' => 'Les changements de la CNSS en 2025',
            'excerpt' => 'Tout ce qu\'il faut savoir sur les nouvelles dispositions de la CNSS et leurs impacts sur votre salaire.',
            'content' => '<p>En 2025, plusieurs changements importants ont été apportés au système de la Caisse Nationale de Sécurité Sociale (CNSS) au Maroc.</p><h2>Nouveaux taux de cotisation</h2><p>Les taux de cotisation ont été revus pour mieux financer les prestations sociales :</p><ul><li>Part salariale : 4,48% du salaire brut</li><li>Part patronale : 8,89% pour les allocations familiales + 7,93% pour les prestations sociales + 1,05% pour l\'AMO</li></ul><h2>Plafond des cotisations</h2><p>Le plafond mensuel des cotisations CNSS a été maintenu à 6 000 DH. Cela signifie que les cotisations sont calculées sur la base d\'un salaire plafonné à ce montant, même si votre salaire réel est supérieur.</p>',
            'category' => 'salaire-net',
            'published' => true,
            'published_at' => Carbon::now()->subDays(10),
            'meta_title' => 'Les changements de la CNSS en 2025 - Nouvelles dispositions',
            'meta_description' => 'Découvrez les nouveaux taux de cotisation CNSS en 2025 et leur impact sur votre salaire au Maroc.'
        ]);

        Article::create([
            'title' => 'Optimiser sa fiche de paie au Maroc',
            'excerpt' => 'Conseils pratiques pour comprendre et optimiser votre fiche de paie et maximiser votre salaire net.',
            'content' => '<p>La fiche de paie est un document important qui détaille la composition de votre rémunération et les prélèvements effectués. Comprendre sa structure vous permet d\'optimiser votre salaire net.</p><h2>Comprendre sa fiche de paie</h2><p>Une fiche de paie au Maroc comporte généralement :</p><ul><li>Le salaire de base</li><li>Les primes et indemnités</li><li>Les heures supplémentaires</li><li>Les cotisations sociales (CNSS, AMO)</li><li>L\'impôt sur le revenu</li></ul><h2>Optimiser son salaire net</h2><p>Voici quelques astuces légales pour optimiser votre salaire net :</p><ol><li>Structurer votre rémunération avec des indemnités exonérées (transport, représentation)</li><li>Souscrire à une assurance retraite complémentaire</li><li>Optimiser vos avantages en nature</li></ol>',
            'category' => 'salaire-net',
            'published' => true,
            'published_at' => Carbon::now()->subDays(15),
            'meta_title' => 'Comment optimiser sa fiche de paie au Maroc - Guide 2025',
            'meta_description' => 'Découvrez comment optimiser légalement votre fiche de paie au Maroc pour augmenter votre salaire net.'
        ]);

        // Articles pour le crédit immobilier
        Article::create([
            'title' => 'Guide du crédit immobilier au Maroc',
            'excerpt' => 'Tout ce que vous devez savoir pour réussir votre demande de prêt immobilier au Maroc.',
            'content' => '<p>Le crédit immobilier est souvent indispensable pour concrétiser un projet d\'achat immobilier. Au Maroc, plusieurs options s\'offrent aux emprunteurs.</p><h2>Les types de crédits immobiliers</h2><p>Il existe plusieurs types de crédits immobiliers au Maroc :</p><ul><li>Le crédit classique à taux fixe</li><li>Le crédit à taux variable</li><li>Le crédit in fine</li><li>Le crédit relais</li></ul><h2>Constitution du dossier</h2><p>Pour maximiser vos chances d\'obtenir un prêt immobilier, votre dossier doit comporter :</p><ul><li>Justificatifs d\'identité</li><li>Justificatifs de revenus (3 derniers bulletins de salaire, attestation de travail)</li><li>Relevés bancaires des 3 derniers mois</li><li>Compromis de vente ou devis des travaux</li><li>Plan de financement</li></ul>',
            'category' => 'credit-immobilier',
            'published' => true,
            'published_at' => Carbon::now()->subDays(7),
            'meta_title' => 'Guide complet du crédit immobilier au Maroc - Édition 2025',
            'meta_description' => 'Découvrez notre guide complet pour réussir votre demande de crédit immobilier au Maroc : taux, conditions, documents nécessaires.'
        ]);

        Article::create([
            'title' => 'Taux immobiliers : comparatif des banques marocaines',
            'excerpt' => 'Analyse détaillée des taux d\'intérêt proposés par les principales banques marocaines pour votre crédit immobilier.',
            'content' => '<p>Le taux d\'intérêt est un élément crucial dans le choix de votre crédit immobilier. Voici un comparatif des offres des principales banques marocaines en 2025.</p><h2>Comparatif des taux fixes</h2><table><thead><tr><th>Banque</th><th>Taux sur 10 ans</th><th>Taux sur 20 ans</th><th>Taux sur 25 ans</th></tr></thead><tbody><tr><td>Attijariwafa Bank</td><td>4,15%</td><td>4,35%</td><td>4,50%</td></tr><tr><td>BMCE Bank</td><td>4,10%</td><td>4,30%</td><td>4,45%</td></tr><tr><td>Banque Populaire</td><td>4,20%</td><td>4,40%</td><td>4,55%</td></tr><tr><td>CIH Bank</td><td>4,05%</td><td>4,25%</td><td>4,40%</td></tr></tbody></table><h2>Frais annexes</h2><p>N\'oubliez pas de prendre en compte les frais annexes qui peuvent varier d\'une banque à l\'autre :</p><ul><li>Frais de dossier</li><li>Frais d\'expertise</li><li>Assurance emprunteur</li><li>Garanties exigées</li></ul>',
            'category' => 'credit-immobilier',
            'published' => true,
            'published_at' => Carbon::now()->subDays(12),
            'meta_title' => 'Comparatif des taux de crédit immobilier au Maroc - 2025',
            'meta_description' => 'Découvrez et comparez les taux de crédit immobilier proposés par les banques marocaines en 2025 pour faire le meilleur choix.'
        ]);

        Article::create([
            'title' => 'Comment négocier son crédit immobilier ?',
            'excerpt' => 'Conseils et astuces pour obtenir les meilleures conditions pour votre prêt immobilier au Maroc.',
            'content' => '<p>Négocier son crédit immobilier peut vous faire économiser plusieurs milliers de dirhams sur la durée du prêt. Voici comment procéder efficacement.</p><h2>Préparer sa négociation</h2><p>Pour négocier efficacement, vous devez :</p><ul><li>Connaître votre profil emprunteur (revenus, capacité d\'endettement)</li><li>Comparer les offres du marché</li><li>Préparer un apport personnel conséquent (au moins 20%)</li><li>Avoir un historique bancaire sain</li></ul><h2>Les points négociables</h2><p>Plusieurs éléments peuvent être négociés :</p><ol><li>Le taux d\'intérêt</li><li>Les frais de dossier</li><li>L\'assurance emprunteur</li><li>Les pénalités de remboursement anticipé</li><li>Les garanties demandées</li></ol><h2>La technique de la mise en concurrence</h2><p>N\'hésitez pas à mettre les banques en concurrence en leur présentant les offres de leurs concurrents. Cette technique peut vous permettre d\'obtenir une réduction de 0,2 à 0,4 point sur votre taux d\'intérêt.</p>',
            'category' => 'credit-immobilier',
            'published' => true,
            'published_at' => Carbon::now()->subDays(20),
            'meta_title' => 'Comment négocier son crédit immobilier au Maroc - Guide 2025',
            'meta_description' => 'Découvrez nos conseils pour négocier efficacement votre crédit immobilier au Maroc et obtenir les meilleures conditions.'
        ]);

        // Articles pour les impôts sur le revenu
        Article::create([
            'title' => 'Les tranches d\'IR au Maroc pour 2025',
            'excerpt' => 'Le point sur les barèmes fiscaux actuels et les changements apportés à l\'impôt sur le revenu en 2025.',
            'content' => '<p>L\'impôt sur le revenu au Maroc est calculé selon un barème progressif qui évolue régulièrement. Voici le point sur les tranches d\'imposition pour 2025.</p><h2>Barème de l\'IR 2025</h2><table><thead><tr><th>Tranche de revenu annuel</th><th>Taux</th><th>Somme à déduire</th></tr></thead><tbody><tr><td>0 - 30 000 DH</td><td>0%</td><td>0 DH</td></tr><tr><td>30 001 - 50 000 DH</td><td>10%</td><td>3 000 DH</td></tr><tr><td>50 001 - 60 000 DH</td><td>20%</td><td>8 000 DH</td></tr><tr><td>60 001 - 80 000 DH</td><td>30%</td><td>14 000 DH</td></tr><tr><td>80 001 - 180 000 DH</td><td>34%</td><td>17 200 DH</td></tr><tr><td>Plus de 180 000 DH</td><td>38%</td><td>24 400 DH</td></tr></tbody></table><h2>Nouveautés fiscales 2025</h2><p>Plusieurs changements ont été apportés au régime fiscal marocain en 2025 :</p><ul><li>Élargissement de l\'assiette fiscale</li><li>Révision des déductions pour charges de famille</li><li>Nouvelles modalités de déduction des intérêts des prêts immobiliers</li></ul>',
            'category' => 'impots-revenu',
            'published' => true,
            'published_at' => Carbon::now()->subDays(5),
            'meta_title' => 'Les tranches d\'impôt sur le revenu au Maroc en 2025',
            'meta_description' => 'Découvrez les barèmes fiscaux et les tranches d\'imposition pour l\'impôt sur le revenu au Maroc en 2025.'
        ]);

        Article::create([
            'title' => 'Comment optimiser sa déclaration fiscale',
            'excerpt' => 'Les meilleures stratégies pour réduire légalement votre impôt sur le revenu au Maroc.',
            'content' => '<p>Optimiser sa déclaration fiscale permet de réduire légalement le montant de ses impôts. Voici les principales stratégies à connaître.</p><h2>Les déductions fiscales disponibles</h2><p>La législation marocaine prévoit plusieurs déductions fiscales :</p><ul><li>Intérêts des prêts immobiliers (dans la limite de 10% du revenu global imposable)</li><li>Primes d\'assurance retraite (dans la limite de 50% du salaire net imposable)</li><li>Dons aux œuvres de bienfaisance reconnues</li><li>Certains investissements considérés comme prioritaires</li></ul><h2>Optimiser son régime matrimonial</h2><p>Le choix du régime d\'imposition (commun ou séparé) peut avoir un impact significatif sur le montant total d\'impôt à payer par un foyer.</p><h2>Planifier ses revenus</h2><p>Une bonne planification de la perception de certains revenus (primes, bonus, plus-values) peut permettre d\'éviter de franchir des tranches d\'imposition supérieures.</p>',
            'category' => 'impots-revenu',
            'published' => true,
            'published_at' => Carbon::now()->subDays(15),
            'meta_title' => 'Comment optimiser sa déclaration fiscale au Maroc - Guide 2025',
            'meta_description' => 'Découvrez comment optimiser légalement votre déclaration fiscale au Maroc pour réduire vos impôts en 2025.'
        ]);

        Article::create([
            'title' => 'Déductions fiscales : ce qu\'il faut savoir',
            'excerpt' => 'Guide complet sur les déductions fiscales disponibles au Maroc pour réduire votre imposition.',
            'content' => '<p>Les déductions fiscales sont des dispositifs légaux qui permettent de réduire votre base imposable et donc le montant de votre impôt sur le revenu.</p><h2>Déductions liées au logement</h2><p>Les principales déductions liées au logement sont :</p><ul><li>Les intérêts des prêts contractés pour l\'acquisition ou la construction de votre résidence principale (plafonnés à 10% du revenu global imposable)</li><li>Le coût d\'acquisition ou de construction plafonné à 300 000 DH pour les logements sociaux</li></ul><h2>Déductions liées à la prévoyance</h2><p>Vous pouvez déduire :</p><ul><li>Les primes d\'assurance retraite (plafonnées à 50% du salaire net imposable)</li><li>Les cotisations aux organismes de prévoyance sociale</li><li>Certaines assurances vie sous conditions</li></ul><h2>Autres déductions</h2><p>D\'autres déductions sont prévues par la législation fiscale :</p><ul><li>Les dons aux œuvres de bienfaisance reconnues d\'utilité publique</li><li>Les intérêts des prêts accordés aux jeunes entrepreneurs</li><li>Certains investissements dans les secteurs prioritaires</li></ul>',
            'category' => 'impots-revenu',
            'published' => true,
            'published_at' => Carbon::now()->subDays(25),
            'meta_title' => 'Déductions fiscales au Maroc : Guide complet 2025',
            'meta_description' => 'Guide complet sur les déductions fiscales disponibles au Maroc en 2025 pour réduire légalement votre impôt sur le revenu.'
        ]);

        // Articles pour le taux de change
        Article::create([
            'title' => 'Évolution du dirham marocain en 2025',
            'excerpt' => 'Analyse et prévisions de l\'évolution du dirham marocain face aux principales devises internationales.',
            'content' => '<p>Le dirham marocain a connu une évolution contrastée en 2025, influencée par divers facteurs économiques nationaux et internationaux.</p><h2>Face à l\'Euro</h2><p>Le dirham s\'est stabilisé face à l\'euro autour de 10,8 dirhams pour 1 euro, avec une légère appréciation par rapport à l\'année précédente.</p><h2>Face au Dollar</h2><p>Face au dollar américain, le dirham a montré plus de volatilité, oscillant entre 9,5 et 10 dirhams pour 1 dollar, influencé notamment par la politique monétaire de la Réserve Fédérale américaine.</p><h2>Perspectives</h2><p>Les perspectives pour le dirham marocain sont modérément positives, soutenues par :</p><ul><li>La stabilité macroéconomique du Maroc</li><li>Les investissements étrangers croissants</li><li>La politique monétaire prudente de Bank Al-Maghrib</li><li>Les recettes touristiques et les transferts des MRE en hausse</li></ul><p>Toutefois, des risques persistent liés aux tensions géopolitiques et aux fluctuations des prix des matières premières.</p>',
            'category' => 'taux-change',
            'published' => true,
            'published_at' => Carbon::now()->subDays(8),
            'meta_title' => 'Évolution du dirham marocain en 2025 - Analyse et prévisions',
            'meta_description' => 'Découvrez l\'évolution du dirham marocain face aux principales devises en 2025 et les prévisions pour les mois à venir.'
        ]);

        Article::create([
            'title' => 'Conseils pour échanger des devises au Maroc',
            'excerpt' => 'Guide pratique pour obtenir le meilleur taux de change lors de vos opérations de change au Maroc.',
            'content' => '<p>Échanger des devises au Maroc peut sembler simple, mais quelques astuces peuvent vous permettre d\'obtenir les meilleurs taux et d\'éviter les pièges.</p><h2>Où échanger ses devises</h2><p>Plusieurs options s\'offrent à vous pour échanger vos devises au Maroc :</p><ul><li>Les bureaux de change officiels (meilleur rapport qualité/prix)</li><li>Les banques (sécurité mais commissions plus élevées)</li><li>Les hôtels (pratique mais taux défavorables)</li><li>Les aéroports (dépannage mais taux très désavantageux)</li></ul><h2>Conseils pratiques</h2><p>Pour optimiser vos opérations de change :</p><ol><li>Comparez les taux avant de changer (applications mobiles, sites spécialisés)</li><li>Évitez les bureaux de change dans les zones très touristiques</li><li>Privilégiez les grosses coupures pour obtenir un meilleur taux</li><li>Gardez vos reçus de change (obligatoires pour reconvertir des dirhams en devises)</li><li>Méfiez-vous des changeurs de rue (illégaux et risqués)</li></ol>',
            'category' => 'taux-change',
            'published' => true,
            'published_at' => Carbon::now()->subDays(18),
            'meta_title' => 'Comment échanger des devises au Maroc - Guide 2025',
            'meta_description' => 'Découvrez nos conseils pour échanger vos devises au Maroc au meilleur taux et éviter les pièges.'
        ]);

        Article::create([
            'title' => 'Comment suivre les taux de change en temps réel',
            'excerpt' => 'Les meilleurs outils et applications pour suivre l\'évolution des taux de change du dirham marocain.',
            'content' => '<p>Suivre les taux de change en temps réel est essentiel pour réaliser des opérations de change au moment opportun. Voici les meilleurs outils disponibles.</p><h2>Applications mobiles</h2><p>Plusieurs applications permettent de suivre les taux de change du dirham marocain :</p><ul><li>XE Currency (complète et fiable)</li><li>Currency Converter (simple et efficace)</li><li>Bloomberg (pour les analyses approfondies)</li><li>BMCE Forex (application officielle avec les taux bancaires)</li></ul><h2>Sites web spécialisés</h2><p>Pour un suivi sur ordinateur, ces sites sont recommandés :</p><ul><li>xe.com (référence mondiale)</li><li>investing.com (avec graphiques et analyses)</li><li>bkam.ma (site officiel de Bank Al-Maghrib)</li><li>boursenews.ma (actualités financières et taux de change)</li></ul><h2>Alertes personnalisées</h2><p>Certaines applications permettent de configurer des alertes pour être notifié lorsqu\'un taux de change atteint un certain seuil. C\'est particulièrement utile si vous attendez un moment précis pour effectuer une opération de change importante.</p>',
            'category' => 'taux-change',
            'published' => true,
            'published_at' => Carbon::now()->subDays(30),
            'meta_title' => 'Comment suivre les taux de change en temps réel - Guide 2025',
            'meta_description' => 'Découvrez les meilleurs outils et applications pour suivre l\'évolution des taux de change du dirham marocain en temps réel.'
        ]);

        // Articles pour la rentabilité locative
        Article::create([
            'title' => 'Comment optimiser votre investissement locatif au Maroc',
            'excerpt' => 'Stratégies et conseils pour maximiser la rentabilité de votre investissement immobilier locatif.',
            'content' => '<p>L\'investissement locatif au Maroc peut être très rentable si vous appliquez les bonnes stratégies. Voici comment optimiser votre rendement.</p><h2>Choisir la bonne localisation</h2><p>La localisation est le facteur clé d\'un investissement locatif réussi. Privilégiez :</p><ul><li>Les quartiers à fort potentiel de valorisation</li><li>La proximité des transports et services</li><li>Les zones universitaires pour la location aux étudiants</li><li>Les quartiers d\'affaires pour la clientèle professionnelle</li></ul><h2>Optimiser la fiscalité</h2><p>La fiscalité immobilière peut considérablement impacter votre rentabilité. Plusieurs options s\'offrent à vous :</p><ul><li>Le régime du résultat net réel (déduction des charges réelles)</li><li>Le régime forfaitaire (plus simple mais parfois moins avantageux)</li><li>L\'investissement via une SCI (pour les patrimoines importants)</li></ul><h2>Réduire la vacance locative</h2><p>La vacance locative est l\'ennemi de la rentabilité. Pour la minimiser :</p><ol><li>Fixez un loyer cohérent avec le marché</li><li>Entretenez régulièrement le bien</li><li>Soignez vos annonces et photos</li><li>Répondez rapidement aux demandes</li><li>Fidélisez les bons locataires</li></ol>',
            'category' => 'rentabilite-locative',
            'published' => true,
            'published_at' => Carbon::now()->subDays(10),
            'meta_title' => 'Comment optimiser votre investissement locatif au Maroc - Guide 2025',
            'meta_description' => 'Découvrez nos conseils pour maximiser la rentabilité de votre investissement immobilier locatif au Maroc.'
        ]);

        Article::create([
            'title' => 'Fiscalité des revenus locatifs au Maroc en 2025',
            'excerpt' => 'Tout ce qu\'il faut savoir sur l\'imposition des revenus fonciers au Maroc cette année.',
            'content' => '<p>La fiscalité des revenus locatifs au Maroc a connu quelques évolutions en 2025. Voici ce que vous devez savoir pour optimiser votre situation fiscale.</p><h2>Les différents régimes fiscaux</h2><p>Deux régimes fiscaux s\'offrent aux propriétaires bailleurs au Maroc :</p><h3>1. Le régime du résultat net réel</h3><p>Ce régime permet de déduire les charges réelles de vos revenus locatifs :</p><ul><li>Intérêts d\'emprunt</li><li>Charges de copropriété</li><li>Taxes foncières</li><li>Travaux d\'entretien et de réparation</li><li>Frais de gestion</li><li>Assurances</li><li>Amortissement du bien (pour les locations meublées professionnelles)</li></ul><h3>2. Le régime forfaitaire</h3><p>Plus simple, ce régime consiste à appliquer un abattement forfaitaire de 40% sur vos revenus locatifs bruts.</p><h2>Taux d\'imposition</h2><p>Les revenus fonciers sont soumis au barème progressif de l\'IR, avec des taux allant de 0% à 38% selon la tranche de revenus.</p><h2>Obligations déclaratives</h2><p>Les propriétaires bailleurs doivent déposer une déclaration annuelle de revenus avant le 1er mars de chaque année pour les revenus de l\'année précédente.</p>',
            'category' => 'rentabilite-locative',
            'published' => true,
            'published_at' => Carbon::now()->subDays(20),
            'meta_title' => 'Fiscalité des revenus locatifs au Maroc en 2025 - Guide complet',
            'meta_description' => 'Guide complet sur la fiscalité des revenus fonciers au Maroc en 2025 : régimes fiscaux, taux d\'imposition et obligations déclaratives.'
        ]);

        Article::create([
            'title' => 'Les meilleures villes pour investir dans l\'immobilier locatif',
            'excerpt' => 'Analyse des villes marocaines offrant les meilleures opportunités d\'investissement locatif en 2025.',
            'content' => '<p>Le marché immobilier locatif marocain offre des opportunités variées selon les régions. Voici notre analyse des meilleures villes où investir en 2025.</p><h2>Casablanca</h2><p>Premier pôle économique du pays, Casablanca offre :</p><ul><li>Une rentabilité brute moyenne de 5%</li><li>Une forte demande locative, notamment dans les quartiers d\'affaires</li><li>Un potentiel de plus-value intéressant dans les quartiers en développement</li><li>Quartiers recommandés : Maarif, Racine, CIL, Bourgogne</li></ul><h2>Rabat</h2><p>La capitale administrative se distingue par :</p><ul><li>Une stabilité du marché locatif</li><li>Une clientèle de fonctionnaires et de diplomates</li><li>Une rentabilité moyenne de 4,5%</li><li>Quartiers recommandés : Agdal, Hassan, Hay Riad</li></ul><h2>Tanger</h2><p>La ville du détroit connaît un développement fulgurant :</p><ul><li>Une rentabilité attractive atteignant 6%</li><li>Un marché dynamisé par les investissements industriels</li><li>Un fort potentiel touristique</li><li>Quartiers recommandés : Malabata, Centre-ville, Zone franche</li></ul><h2>Marrakech</h2><p>La ville ocre reste attractive pour :</p><ul><li>La location saisonnière (rendements jusqu\'à 8%)</li><li>La location longue durée dans les quartiers résidentiels (5-6%)</li><li>Quartiers recommandés : Guéliz, Hivernage, Route de l\'Ourika</li></ul>',
            'category' => 'rentabilite-locative',
            'published' => true,
            'published_at' => Carbon::now()->subDays(25),
            'meta_title' => 'Meilleures villes pour investir dans l\'immobilier locatif au Maroc - 2025',
            'meta_description' => 'Découvrez notre analyse des villes marocaines offrant les meilleures opportunités d\'investissement locatif en 2025.'
        ]);
    }
}

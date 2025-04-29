<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class CalculatorController extends Controller
{
    /**
     * Affiche la page d'index des calculateurs
     */
    public function index()
    {
        SEOTools::setTitle('Tous nos calculateurs - En-Ligne.ma');
        SEOTools::setDescription('Explorez notre gamme complète de calculateurs et simulateurs pour le Maroc : salaire net, crédit immobilier, impôts et plus encore.');

        return view('calculateurs.index');
    }

    /**
     * Affiche un calculateur spécifique
     */
    public function show($type)
    {
        $validTypes = ['salaire-net', 'credit-immobilier', 'impots-revenu', 'taux-change', 'rentabilite-locative'];

        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        $titles = [
            'salaire-net' => 'Calculateur de salaire net au Maroc',
            'credit-immobilier' => 'Simulateur de crédit immobilier au Maroc',
            'impots-revenu' => 'Calculateur d\'impôts sur le revenu au Maroc',
            'taux-change' => 'Convertisseur de devises marocain',
            'rentabilite-locative' => 'Calculateur de rentabilité locative immobilière'
        ];

        $descriptions = [
            'salaire-net' => 'Estimez facilement votre salaire net à partir du salaire brut au Maroc en prenant en compte les cotisations CNSS, AMO et l\'IR.',
            'credit-immobilier' => 'Simulez votre crédit immobilier au Maroc et calculez vos mensualités selon les taux d\'intérêt des banques marocaines.',
            'impots-revenu' => 'Calculez précisément vos impôts sur le revenu selon les barèmes fiscaux marocains en vigueur.',
            'taux-change' => 'Convertissez instantanément le dirham marocain (MAD) en d\'autres devises avec les taux de change à jour.',
            'rentabilite-locative' => 'Calculez la rentabilité brute et nette de votre investissement immobilier locatif au Maroc.'
        ];

        SEOTools::setTitle($titles[$type] . ' - En-Ligne.ma');
        SEOTools::setDescription($descriptions[$type]);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@enligne_ma');

        // Récupérer les articles associés à ce type de calculateur
        $relatedArticles = Article::where('category', $type)
            ->published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('calculateurs.show', [
            'type' => $type,
            'title' => $titles[$type],
            'description' => $descriptions[$type],
            'relatedArticles' => $relatedArticles
        ]);
    }
}

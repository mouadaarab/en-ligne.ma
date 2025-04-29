<?php

use Illuminate\Support\Facades\Route;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CalculatorController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
|
| Définition des routes du site web en-ligne.ma
| Chaque route est optimisée pour le SEO avec les métadonnées appropriées
|
*/

// Page d'accueil
Route::get('/', function () {
    SEOTools::setTitle('En-Ligne.ma - Simulateurs et calculateurs marocains');
    SEOTools::setDescription('Découvrez nos calculateurs et simulateurs gratuits adaptés au contexte marocain : salaire net, crédit immobilier et plus encore.');
    SEOTools::opengraph()->addProperty('type', 'website');
    SEOTools::twitter()->setSite('@enligne_ma');
    SEOTools::jsonLd()->addImage(asset('images/logo.png'));

    return view('home');
})->name('home');

// Pages des calculateurs
Route::get('/calculateurs', [CalculatorController::class, 'index'])->name('calculateurs.index');
Route::get('/calculateurs/{type}', [CalculatorController::class, 'show'])->name('calculateurs.show');

// Routes pour les articles
Route::group(['prefix' => 'articles'], function () {
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/categorie/{category}', [ArticleController::class, 'category'])->name('articles.category');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('articles.show');
});

// Pages statiques
Route::get('/a-propos', function () {
    SEOTools::setTitle('À propos de En-Ligne.ma');
    SEOTools::setDescription('Découvrez qui nous sommes et notre mission de fournir des outils de calcul en ligne gratuits et fiables pour les Marocains.');

    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    SEOTools::setTitle('Contactez-nous - En-Ligne.ma');
    SEOTools::setDescription('Une question ou suggestion ? Contactez l\'équipe d\'En-Ligne.ma pour toute demande concernant nos calculateurs et simulateurs en ligne.');

    return view('pages.contact');
})->name('contact');

Route::get('/mentions-legales', function () {
    SEOTools::setTitle('Mentions légales - En-Ligne.ma');
    SEOTools::setDescription('Consultez les mentions légales du site En-Ligne.ma, votre plateforme de calculateurs et simulateurs en ligne au Maroc.');

    return view('pages.legal');
})->name('legal');

Route::get('/politique-confidentialite', function () {
    SEOTools::setTitle('Politique de confidentialité - En-Ligne.ma');
    SEOTools::setDescription('Consultez notre politique de confidentialité pour comprendre comment vos données sont traitées sur En-Ligne.ma.');

    return view('pages.privacy');
})->name('privacy');

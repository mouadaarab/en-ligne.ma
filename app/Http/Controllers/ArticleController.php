<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles.
     */
    public function index()
    {
        $articles = Article::published()->paginate(10);

        SEOTools::setTitle('Articles et Guides - En-Ligne.ma');
        SEOTools::setDescription('Découvrez nos articles et guides sur les finances personnelles, l\'immobilier, les investissements et bien plus au Maroc.');

        return view('articles.index', compact('articles'));
    }

    /**
     * Affiche un article spécifique.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Configuration SEO
        SEOTools::setTitle($article->meta_title ?: $article->title . ' - En-Ligne.ma');
        SEOTools::setDescription($article->meta_description ?: $article->excerpt);
        SEOTools::opengraph()->setUrl(url()->current());

        if ($article->image) {
            SEOTools::opengraph()->addImage(asset($article->image));
        }

        // Articles associés dans la même catégorie
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->published()
            ->limit(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Affiche les articles d'une catégorie spécifique.
     */
    public function category($category)
    {
        $articles = Article::category($category)
            ->published()
            ->paginate(10);

        $categoryName = ucfirst(str_replace('-', ' ', $category));

        SEOTools::setTitle("Articles sur {$categoryName} - En-Ligne.ma");
        SEOTools::setDescription("Découvrez nos articles et guides sur {$categoryName} au Maroc.");

        return view('articles.category', compact('articles', 'category', 'categoryName'));
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Artesaos\SEOTools\Facades\SEOTools;
use Symfony\Component\HttpFoundation\Response;

class ServerSideRenderingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupération de la route actuelle
        $route = Route::current();

        // Si la route a des métadonnées SEO spécifiques, les utiliser
        if ($route && $route->hasParameter('meta')) {
            $meta = $route->parameter('meta');

            if (isset($meta['title'])) {
                SEOTools::setTitle($meta['title']);
            }

            if (isset($meta['description'])) {
                SEOTools::setDescription($meta['description']);
            }

            if (isset($meta['keywords'])) {
                SEOTools::metatags()->addKeyword($meta['keywords']);
            }

            if (isset($meta['canonical'])) {
                SEOTools::setCanonical($meta['canonical']);
            }
        } else {
            // Configurer les métadonnées par défaut selon la route actuelle
            $this->configureSeoByRoute($request);
        }

        // Continuer avec la requête
        $response = $next($request);

        // Pour les robots ou crawlers, s'assurer que le contenu est entièrement rendu
        if ($this->isCrawler($request) && $response instanceof \Illuminate\Http\Response) {
            // Assurez-vous que tout JavaScript important est prérendu
            // Code spécifique pour le prérendu pourrait être ajouté ici
        }

        return $response;
    }

    /**
     * Détecte si la demande provient d'un robot d'indexation.
     */
    private function isCrawler(Request $request): bool
    {
        $userAgent = $request->header('User-Agent');
        $crawlers = [
            'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider',
            'yandex', 'sogou', 'exabot', 'facebot', 'ia_archiver'
        ];

        foreach ($crawlers as $crawler) {
            if (stripos($userAgent, $crawler) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Configure les métadonnées SEO en fonction de la route actuelle.
     */
    private function configureSeoByRoute(Request $request): void
    {
        $path = $request->path();
        $baseName = config('seotools.meta.defaults.title');

        switch ($path) {
            case '/':
                SEOTools::setTitle($baseName);
                break;
            case 'contact':
                SEOTools::setTitle('Contactez-nous ' . config('seotools.meta.defaults.separator') . $baseName);
                SEOTools::setDescription('Contactez l\'équipe d\'En-Ligne.ma pour toute question concernant nos calculateurs et simulateurs.');
                break;
            default:
                // Pour les calculateurs (à adapter selon votre structure)
                if (preg_match('/calculateurs\/([^\/]+)/', $path, $matches)) {
                    $calculatorSlug = $matches[1] ?? '';
                    // Vous pourriez récupérer les infos du calculateur depuis la base de données
                    SEOTools::setTitle('Calculateur ' . ucfirst(str_replace('-', ' ', $calculatorSlug)) .
                        config('seotools.meta.defaults.separator') . $baseName);
                }
        }
    }
}

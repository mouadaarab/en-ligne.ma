<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Spatie\SchemaOrg\Schema;

class SchemaOrgServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Partage une variable schema avec toutes les vues
        View::composer('*', function ($view) {
            // Schéma par défaut pour le site web
            $webSite = Schema::webSite()
                ->name('En-Ligne.ma')
                ->url(config('app.url'))
                ->description('Simulateurs et calculateurs marocains en ligne')
                ->inLanguage('fr-MA');

            // Organisation
            $organization = Schema::organization()
                ->name('En-Ligne.ma')
                ->url(config('app.url'))
                ->logo(config('app.url') . '/images/logo.png');

            // Partage les schémas avec la vue
            $view->with('schema', [
                'webSite' => $webSite,
                'organization' => $organization
            ]);
        });
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * La signature de la commande console.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * La description de la commande console.
     *
     * @var string
     */
    protected $description = 'Génère le sitemap du site';

    /**
     * Exécute la commande console.
     */
    public function handle()
    {
        $this->info('Génération du sitemap...');

        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0))
            ->add(Url::create('/a-propos')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8))
            ->add(Url::create('/contact')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7));

        // Ajout des pages de calculateurs
        $calculateurs = [
            'salaire-net' => 'Calculateur de salaire net',
            'credit-immobilier' => 'Simulateur de crédit immobilier',
            'impots-revenu' => 'Calculateur d\'impôts sur le revenu',
            'taux-change' => 'Convertisseur de devises'
        ];

        foreach ($calculateurs as $slug => $title) {
            $sitemap->add(
                Url::create("/calculateurs/{$slug}")
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.9)
            );
        }

        // Stockage du sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap généré avec succès à l\'emplacement public/sitemap.xml');
    }
}

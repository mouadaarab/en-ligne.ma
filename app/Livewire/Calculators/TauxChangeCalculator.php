<?php

namespace App\Livewire\Calculators;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class TauxChangeCalculator extends BaseCalculator
{
    /**
     * Type de calculateur
     */
    public string $type = 'taux-change';

    /**
     * Titre du calculateur
     */
    public string $title = 'Convertisseur de devises';

    /**
     * Description du calculateur pour le SEO
     */
    public string $description = 'Convertissez le dirham marocain en d\'autres devises et vice-versa';

    /**
     * Montant à convertir
     */
    #[Rule('required|numeric|min:0')]
    public float $montant = 1000;

    /**
     * Devise source
     */
    #[Rule('required|string|in:MAD,EUR,USD,GBP')]
    public string $deviseSource = 'MAD';

    /**
     * Devise destination
     */
    #[Rule('required|string|in:MAD,EUR,USD,GBP')]
    public string $deviseDestination = 'EUR';

    /**
     * Taux de change actuels (simplifiés)
     */
    private array $taux = [
        'MAD_EUR' => 0.091,  // 1 MAD = 0.091 EUR
        'MAD_USD' => 0.099,  // 1 MAD = 0.099 USD
        'MAD_GBP' => 0.079,  // 1 MAD = 0.079 GBP
        'EUR_MAD' => 11.0,   // 1 EUR = 11.0 MAD
        'USD_MAD' => 10.1,   // 1 USD = 10.1 MAD
        'GBP_MAD' => 12.7    // 1 GBP = 12.7 MAD
    ];

    /**
     * Méthode pour effectuer le calcul
     */
    public function calculer()
    {
        $this->validate();
        
        $key = "{$this->deviseSource}_{$this->deviseDestination}";
        
        if ($this->deviseSource === $this->deviseDestination) {
            $this->resultatPrincipal = $this->montant;
        } elseif (isset($this->taux[$key])) {
            $this->resultatPrincipal = $this->montant * $this->taux[$key];
        } else {
            // Conversion via MAD si conversion directe non disponible
            $toMAD = $this->deviseSource === 'MAD' ? 
                $this->montant : 
                $this->montant * $this->taux["{$this->deviseSource}_MAD"];
                
            $this->resultatPrincipal = $this->deviseDestination === 'MAD' ? 
                $toMAD : 
                $toMAD * $this->taux["MAD_{$this->deviseDestination}"];
        }
        
        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        $this->reset(['montant', 'deviseSource', 'deviseDestination', 'resultatPrincipal']);
        $this->montant = 1000;
        $this->deviseSource = 'MAD';
        $this->deviseDestination = 'EUR';
    }
    
    /**
     * Enregistrer le calcul dans l'historique
     */
    protected function enregistrerHistorique()
    {
        $this->historiqueCalculs[] = [
            'date' => now()->format('d/m/Y H:i'),
            'montant' => $this->montant,
            'deviseSource' => $this->deviseSource,
            'deviseDestination' => $this->deviseDestination,
            'resultat' => $this->resultatPrincipal
        ];
    }

    /**
     * Rendu du composant
     */
    #[Title('Convertisseur de Devises - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculators.taux-change-calculator');
    }
}
<?php

namespace App\Livewire\Calculators;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class CreditImmobilierCalculator extends BaseCalculator
{
    /**
     * Type de calculateur
     */
    public string $type = 'credit-immobilier';

    /**
     * Titre du calculateur
     */
    public string $title = 'Simulateur de crédit immobilier';

    /**
     * Description du calculateur pour le SEO
     */
    public string $description = 'Simulez votre crédit immobilier au Maroc et calculez vos mensualités';

    /**
     * Montant du bien immobilier
     */
    #[Rule('required|numeric|min:0')]
    public float $montant = 1000000;

    /**
     * Durée du prêt en années
     */
    #[Rule('required|numeric|min:1|max:30')]
    public int $duree = 20;

    /**
     * Taux d'intérêt annuel
     */
    #[Rule('required|numeric|min:0|max:20')]
    public float $tauxInteret = 4.5;

    /**
     * Apport personnel en pourcentage
     */
    #[Rule('required|numeric|min:0|max:90')]
    public float $apport = 20;

    /**
     * Résultats détaillés du calcul
     */
    public ?float $mensualite = null;
    public ?float $coutTotal = null;
    public ?float $montantInterets = null;
    public ?float $tauxEndettement = null;

    /**
     * Méthode pour effectuer le calcul
     */
    public function calculer()
    {
        $this->validate();
        
        // Montant du prêt après déduction de l'apport
        $montantPret = $this->montant * (1 - ($this->apport / 100));
        
        // Calcul de la mensualité
        // Formule: M = P * (t/12) / (1 - (1 + t/12)^(-n))
        $tauxMensuel = $this->tauxInteret / 100 / 12;
        $nombreMensualites = $this->duree * 12;
        
        $this->mensualite = $montantPret * $tauxMensuel / (1 - pow(1 + $tauxMensuel, -$nombreMensualites));
        
        // Coût total et montant des intérêts
        $this->coutTotal = $this->mensualite * $nombreMensualites;
        $this->montantInterets = $this->coutTotal - $montantPret;
        
        // Taux d'endettement recommandé (33% du revenu)
        $this->tauxEndettement = $this->mensualite * 100 / (3 * $this->mensualite);
        
        // Résultat principal
        $this->resultatPrincipal = $this->mensualite;
        
        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        $this->reset([
            'montant', 'duree', 'tauxInteret', 'apport', 
            'mensualite', 'coutTotal', 'montantInterets', 'tauxEndettement', 
            'resultatPrincipal'
        ]);
        
        $this->montant = 1000000;
        $this->duree = 20;
        $this->tauxInteret = 4.5;
        $this->apport = 20;
    }
    
    /**
     * Enregistrer le calcul dans l'historique
     */
    protected function enregistrerHistorique()
    {
        $this->historiqueCalculs[] = [
            'date' => now()->format('d/m/Y H:i'),
            'montantPret' => $this->montant * (1 - ($this->apport / 100)),
            'montantBien' => $this->montant,
            'duree' => $this->duree,
            'tauxInteret' => $this->tauxInteret,
            'apport' => $this->apport,
            'mensualite' => $this->mensualite,
            'resultat' => $this->resultatPrincipal
        ];
    }

    /**
     * Rendu du composant
     */
    #[Title('Simulateur de Crédit Immobilier - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculators.credit-immobilier-calculator');
    }
}
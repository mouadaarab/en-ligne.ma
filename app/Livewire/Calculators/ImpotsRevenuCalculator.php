<?php

namespace App\Livewire\Calculators;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class ImpotsRevenuCalculator extends BaseCalculator
{
    /**
     * Type de calculateur
     */
    public string $type = 'impots-revenu';

    /**
     * Titre du calculateur
     */
    public string $title = 'Calculateur d\'impôt sur le revenu';

    /**
     * Description du calculateur pour le SEO
     */
    public string $description = 'Calculez votre impôt sur le revenu selon le barème fiscal marocain';

    /**
     * Revenus annuels bruts
     */
    #[Rule('required|numeric|min:0')]
    public float $revenusBruts = 120000;

    /**
     * Charges déductibles
     */
    #[Rule('numeric|min:0')]
    public float $chargesDeductibles = 0;

    /**
     * Taux moyen d'imposition
     */
    public ?float $tauxIR = null;
    public ?float $montantIR = null;

    /**
     * Méthode pour effectuer le calcul
     */
    public function calculer()
    {
        $this->validate();
        
        // Revenu net imposable
        $revenuNetImposable = $this->revenusBruts - $this->chargesDeductibles;
        
        // Application du barème progressif marocain (simplifié)
        $ir = 0;
        
        // Tranches d'imposition annuelles (Barème 2025)
        if ($revenuNetImposable <= 30000) {
            $ir = 0;
        } elseif ($revenuNetImposable <= 50000) {
            $ir = ($revenuNetImposable - 30000) * 0.10;
        } elseif ($revenuNetImposable <= 60000) {
            $ir = 2000 + ($revenuNetImposable - 50000) * 0.20;
        } elseif ($revenuNetImposable <= 80000) {
            $ir = 4000 + ($revenuNetImposable - 60000) * 0.30;
        } elseif ($revenuNetImposable <= 180000) {
            $ir = 10000 + ($revenuNetImposable - 80000) * 0.34;
        } else {
            $ir = 44000 + ($revenuNetImposable - 180000) * 0.38;
        }
        
        $this->montantIR = $ir;
        $this->resultatPrincipal = $ir;
        
        // Taux moyen d'imposition
        $this->tauxIR = $revenuNetImposable > 0 ? ($ir / $revenuNetImposable) * 100 : 0;
        
        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        $this->reset(['revenusBruts', 'chargesDeductibles', 'montantIR', 'tauxIR', 'resultatPrincipal']);
        $this->revenusBruts = 120000;
        $this->chargesDeductibles = 0;
    }
    
    /**
     * Enregistrer le calcul dans l'historique
     */
    protected function enregistrerHistorique()
    {
        $this->historiqueCalculs[] = [
            'date' => now()->format('d/m/Y H:i'),
            'revenusBruts' => $this->revenusBruts,
            'chargesDeductibles' => $this->chargesDeductibles,
            'revenuNetImposable' => $this->revenusBruts - $this->chargesDeductibles,
            'montantIR' => $this->montantIR,
            'tauxMoyen' => $this->tauxIR,
            'resultat' => $this->resultatPrincipal
        ];
    }

    /**
     * Rendu du composant
     */
    #[Title('Calculateur d\'Impôt sur le Revenu - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculators.impots-revenu-calculator');
    }
}
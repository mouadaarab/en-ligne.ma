<?php

namespace App\Livewire\Calculators;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class SalaireNetCalculator extends BaseCalculator
{
    /**
     * Type de calculateur
     */
    public string $type = 'salaire-net';

    /**
     * Titre du calculateur
     */
    public string $title = 'Calculateur de salaire net';

    /**
     * Description du calculateur pour le SEO
     */
    public string $description = 'Estimez votre salaire net à partir du brut au Maroc';

    /**
     * Montant du salaire brut
     */
    #[Rule('required|numeric|min:0')]
    public float $montant = 10000;

    /**
     * Taux d'impôt sur le revenu
     */
    #[Rule('required|numeric|min:0|max:100')]
    public float $tauxIR = 38;

    /**
     * Période de calcul (mensuel ou annuel)
     */
    #[Rule('required|in:mensuel,annuel')]
    public string $periode = 'mensuel';

    /**
     * Résultats détaillés du calcul
     */
    public ?float $salaireNet = null;
    public ?float $montantIR = null;
    public ?float $montantCNSS = null;
    public ?float $montantAMO = null;

    /**
     * Méthode pour effectuer le calcul
     */
    public function calculer()
    {
        $this->validate();
        
        $salaireBrut = $this->montant;
        
        // Calcul des cotisations sociales
        $plafondCNSS = 6000; // Plafond CNSS
        $baseCNSS = min($salaireBrut, $plafondCNSS);
        $cnss = $baseCNSS * 0.0448; // 4.48% pour la CNSS
        $amo = $salaireBrut * 0.0226;  // 2.26% pour l'AMO
        
        // Base imposable pour l'IR
        $baseIR = $salaireBrut - $cnss - $amo;
        
        // Calcul de l'IR selon le taux fourni (simplifié)
        $ir = $baseIR * ($this->tauxIR / 100);

        // Résultats
        $this->salaireNet = $salaireBrut - $cnss - $amo - $ir;
        $this->montantIR = $ir;
        $this->montantCNSS = $cnss;
        $this->montantAMO = $amo;
        $this->resultatPrincipal = $this->salaireNet;
        
        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        $this->reset(['montant', 'tauxIR', 'periode', 'salaireNet', 'montantIR', 'montantCNSS', 'montantAMO', 'resultatPrincipal']);
        $this->montant = 10000;
        $this->tauxIR = 38;
        $this->periode = 'mensuel';
    }
    
    /**
     * Enregistrer le calcul dans l'historique
     */
    protected function enregistrerHistorique()
    {
        $this->historiqueCalculs[] = [
            'date' => now()->format('d/m/Y H:i'),
            'salaireBrut' => $this->montant,
            'salaireNet' => $this->salaireNet,
            'tauxIR' => $this->tauxIR,
            'periode' => $this->periode,
            'resultat' => $this->resultatPrincipal
        ];
    }

    /**
     * Rendu du composant
     */
    #[Title('Calculateur de Salaire Net - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculators.salaire-net-calculator');
    }
}
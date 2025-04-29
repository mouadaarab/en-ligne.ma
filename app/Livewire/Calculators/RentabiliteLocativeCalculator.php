<?php

namespace App\Livewire\Calculators;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

class RentabiliteLocativeCalculator extends BaseCalculator
{
    /**
     * Type de calculateur
     */
    public string $type = 'rentabilite-locative';

    /**
     * Titre du calculateur
     */
    public string $title = 'Calculateur de rentabilité locative';

    /**
     * Description du calculateur pour le SEO
     */
    public string $description = 'Calculez la rentabilité brute et nette de votre investissement immobilier locatif';

    /**
     * Prix d'achat du bien immobilier
     */
    #[Rule('required|numeric|min:0')]
    public float $prixAchat = 1000000;

    /**
     * Apport personnel (pourcentage du prix d'achat)
     */
    #[Rule('required|numeric|min:0|max:100')]
    public float $apportPersonnel = 20;

    /**
     * Frais d'acquisition (pourcentage du prix d'achat)
     */
    #[Rule('required|numeric|min:0|max:15')]
    public float $fraisAcquisition = 7;

    /**
     * Montant des travaux
     */
    #[Rule('required|numeric|min:0')]
    public float $montantTravaux = 50000;

    /**
     * Loyer mensuel
     */
    #[Rule('required|numeric|min:0')]
    public float $loyerMensuel = 7000;

    /**
     * Charges annuelles
     */
    #[Rule('required|numeric|min:0')]
    public float $chargesAnnuelles = 12000;

    /**
     * Taux d'imposition (pourcentage)
     */
    #[Rule('required|numeric|min:0|max:40')]
    public float $tauxImposition = 15;

    /**
     * Taux de vacance locative (pourcentage)
     */
    #[Rule('required|numeric|min:0|max:30')]
    public float $tauxVacance = 5;

    /**
     * Rentabilité brute (résultat calculé)
     */
    public ?float $rentabiliteBrute = null;

    /**
     * Rentabilité nette (résultat calculé)
     */
    public ?float $rentabiliteNette = null;

    /**
     * Revenu net annuel (résultat calculé)
     */
    public ?float $revenuNetAnnuel = null;

    /**
     * Cash flow annuel (résultat calculé)
     */
    public ?float $cashFlowAnnuel = null;

    /**
     * Durée d'amortissement en années (résultat calculé)
     */
    public ?float $dureeAmortissement = null;

    /**
     * Méthode pour effectuer le calcul
     */
    public function calculer()
    {
        $this->validate();

        // Calcul du montant de l'apport personnel
        $montantApport = ($this->prixAchat * $this->apportPersonnel / 100);

        // Calcul de l'investissement total (partie financée par l'investisseur uniquement)
        $investissementPersonnel = $montantApport + ($this->prixAchat * $this->fraisAcquisition / 100) + $this->montantTravaux;

        // Investissement total (prix d'achat + frais d'acquisition + travaux)
        $investissementTotal = $this->prixAchat + ($this->prixAchat * $this->fraisAcquisition / 100) + $this->montantTravaux;

        // Calcul du revenu locatif annuel (tenant compte du taux de vacance)
        $revenuLocatifAnnuel = $this->loyerMensuel * 12 * (1 - ($this->tauxVacance / 100));

        // Calcul de la rentabilité brute
        $this->rentabiliteBrute = ($revenuLocatifAnnuel / $investissementTotal) * 100;

        // Calcul des charges annuelles totales
        $chargesAnnuellesTotales = $this->chargesAnnuelles;

        // Calcul du revenu net avant impôts
        $revenuNetAvantImpots = $revenuLocatifAnnuel - $chargesAnnuellesTotales;

        // Calcul des impôts
        $impots = $revenuNetAvantImpots * ($this->tauxImposition / 100);

        // Calcul du revenu net après impôts
        $this->revenuNetAnnuel = $revenuNetAvantImpots - $impots;

        // Calcul de la rentabilité nette (sur l'investissement personnel)
        $this->rentabiliteNette = ($this->revenuNetAnnuel / $investissementPersonnel) * 100;

        // Calcul du cash flow annuel
        $this->cashFlowAnnuel = $this->revenuNetAnnuel;

        // Calcul de la durée d'amortissement (sur l'investissement personnel)
        if ($this->revenuNetAnnuel > 0) {
            $this->dureeAmortissement = $investissementPersonnel / $this->revenuNetAnnuel;
        } else {
            $this->dureeAmortissement = null;
        }

        // Sauvegarder le résultat principal (rentabilité nette)
        $this->resultatPrincipal = $this->rentabiliteNette;

        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        $this->reset([
            'prixAchat', 'fraisAcquisition', 'montantTravaux',
            'loyerMensuel', 'chargesAnnuelles', 'tauxImposition',
            'tauxVacance', 'resultatPrincipal', 'rentabiliteBrute',
            'rentabiliteNette', 'revenuNetAnnuel', 'cashFlowAnnuel',
            'dureeAmortissement', 'apportPersonnel'
        ]);

        // Réinitialiser aux valeurs par défaut
        $this->prixAchat = 1000000;
        $this->fraisAcquisition = 7;
        $this->montantTravaux = 50000;
        $this->loyerMensuel = 7000;
        $this->chargesAnnuelles = 12000;
        $this->tauxImposition = 15;
        $this->tauxVacance = 5;
        $this->apportPersonnel = 20;
    }

    /**
     * Enregistrer le calcul dans l'historique
     */
    protected function enregistrerHistorique()
    {
        $this->historiqueCalculs[] = [
            'date' => now()->format('d/m/Y H:i'),
            'prixAchat' => $this->prixAchat,
            'loyerMensuel' => $this->loyerMensuel,
            'rentabiliteBrute' => $this->rentabiliteBrute,
            'rentabiliteNette' => $this->rentabiliteNette,
        ];

        // Sauvegarder l'historique
        $this->saveHistory();
    }

    /**
     * Rendu du composant
     */
    #[Title('Calculateur de Rentabilité Locative - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculators.rentabilite-locative-calculator');
    }
}

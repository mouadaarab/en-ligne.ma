<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;

class CalculatorCard extends Component
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
     * Champs communs à plusieurs calculateurs
     */
    #[Rule('required|numeric|min:0')]
    public float $montant = 0;

    /**
     * Champs spécifiques au calculateur de salaire
     */
    #[Rule('required|numeric|min:0|max:100')]
    public float $tauxIR = 38;

    #[Rule('required|in:mensuel,annuel')]
    public string $periode = 'mensuel';

    /**
     * Champs spécifiques au simulateur de crédit immobilier
     */
    #[Rule('required|numeric|min:0|max:30')]
    public int $duree = 20; // Durée en années

    #[Rule('required|numeric|min:0|max:20')]
    public float $tauxInteret = 4.5; // Taux d'intérêt annuel en %

    #[Rule('required|numeric|min:0|max:100')]
    public float $apport = 20; // Apport en % du montant

    /**
     * Champs spécifiques au calculateur d'impôts
     */
    #[Rule('numeric|min:0')]
    public float $revenusBruts = 0;

    #[Rule('numeric|min:0')]
    public float $chargesDeductibles = 0;

    /**
     * Champs spécifiques au convertisseur de devises
     */
    public string $deviseSource = 'MAD';
    public string $deviseDestination = 'EUR';

    /**
     * Champs spécifiques au calculateur de rentabilité locative
     */
    #[Rule('required|numeric|min:0')]
    public float $prixAchat = 0;

    #[Rule('required|numeric|min:0|max:20')]
    public float $fraisAcquisition = 7; // Frais d'acquisition en %

    #[Rule('required|numeric|min:0')]
    public float $montantTravaux = 0;

    #[Rule('required|numeric|min:0')]
    public float $loyerMensuel = 0;

    #[Rule('required|numeric|min:0')]
    public float $chargesAnnuelles = 0;

    #[Rule('required|numeric|min:0|max:50')]
    public float $tauxImposition = 20; // Taux d'imposition en %

    #[Rule('required|numeric|min:0|max:50')]
    public float $tauxVacance = 5; // Taux de vacance locative en %

    /**
     * Résultats des calculs
     */
    public ?float $resultatPrincipal = null; // Résultat générique pour affichage principal
    public ?float $salaireNet = null;
    public ?float $montantIR = null;
    public ?float $montantCNSS = null;
    public ?float $montantAMO = null;

    // Résultats crédit immobilier
    public ?float $mensualite = null;
    public ?float $coutTotal = null;
    public ?float $montantInterets = null;
    public ?float $tauxEndettement = null;

    // Résultats rentabilité locative
    public ?float $rentabiliteBrute = null;
    public ?float $rentabiliteNette = null;
    public ?float $revenuNetAnnuel = null;
    public ?float $dureeAmortissement = null;
    public ?float $cashFlowAnnuel = null;

    /**
     * Historique des calculs
     */
    public array $historiqueCalculs = [];

    /**
     * Flag pour afficher l'historique
     */
    public bool $showHistory = false;

    /**
     * Méthode d'initialisation du composant
     */
    public function mount(string $type = 'salaire-net')
    {
        $this->type = $type;

        // Configuration selon le type de calculateur
        switch ($this->type) {
            case 'credit-immobilier':
                $this->title = 'Simulateur de crédit immobilier';
                $this->description = 'Simulez votre crédit immobilier au Maroc et calculez vos mensualités';
                $this->montant = 1000000; // Valeur par défaut: 1 million de dirhams
                break;

            case 'impots-revenu':
                $this->title = 'Calculateur d\'impôts sur le revenu';
                $this->description = 'Calculez votre impôt sur le revenu selon le barème fiscal marocain';
                $this->revenusBruts = 120000; // Valeur par défaut: 120 000 DH par an
                break;

            case 'taux-change':
                $this->title = 'Convertisseur de devises';
                $this->description = 'Convertissez le dirham marocain en d\'autres devises et vice-versa';
                $this->montant = 1000; // Valeur par défaut: 1000 DH
                break;

            case 'rentabilite-locative':
                $this->title = 'Calculateur de rentabilité locative';
                $this->description = 'Calculez la rentabilité brute et nette de votre investissement immobilier locatif';
                $this->prixAchat = 1000000; // Valeur par défaut: 1 million de dirhams
                $this->montantTravaux = 50000; // Valeur par défaut: 50 000 DH
                $this->loyerMensuel = 5000; // Valeur par défaut: 5 000 DH par mois
                $this->chargesAnnuelles = 6000; // Valeur par défaut: 6 000 DH par an
                break;

            default: // 'salaire-net'
                $this->montant = 10000; // Valeur par défaut: 10 000 DH
                break;
        }
    }

    /**
     * Méthode pour effectuer le calcul selon le type de calculateur
     */
    public function calculer()
    {
        $this->validate();

        switch ($this->type) {
            case 'salaire-net':
                $this->calculerSalaireNet();
                break;

            case 'credit-immobilier':
                $this->calculerCreditImmobilier();
                break;

            case 'impots-revenu':
                $this->calculerImpotsRevenu();
                break;

            case 'taux-change':
                $this->calculerTauxChange();
                break;

            case 'rentabilite-locative':
                $this->calculerRentabiliteLocative();
                break;
        }

        // Enregistrer dans l'historique
        $this->enregistrerHistorique();
    }

    /**
     * Calcul du salaire net
     */
    private function calculerSalaireNet()
    {
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
    }

    /**
     * Calcul du crédit immobilier
     */
    private function calculerCreditImmobilier()
    {
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

        $this->resultatPrincipal = $this->mensualite;
    }

    /**
     * Calcul des impôts sur le revenu
     */
    private function calculerImpotsRevenu()
    {
        // Revenu net imposable
        $revenuNetImposable = $this->revenusBruts - $this->chargesDeductibles;

        // Application du barème progressif marocain (simplifiée)
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
    }

    /**
     * Conversion de devises
     */
    private function calculerTauxChange()
    {
        // Taux de change simplifiés (à remplacer par des API réelles en production)
        $taux = [
            'MAD_EUR' => 0.091,  // 1 MAD = 0.091 EUR
            'MAD_USD' => 0.099,  // 1 MAD = 0.099 USD
            'MAD_GBP' => 0.079,  // 1 MAD = 0.079 GBP
            'EUR_MAD' => 11.0,   // 1 EUR = 11.0 MAD
            'USD_MAD' => 10.1,   // 1 USD = 10.1 MAD
            'GBP_MAD' => 12.7    // 1 GBP = 12.7 MAD
        ];

        $key = "{$this->deviseSource}_{$this->deviseDestination}";

        if ($this->deviseSource === $this->deviseDestination) {
            $this->resultatPrincipal = $this->montant;
        } elseif (isset($taux[$key])) {
            $this->resultatPrincipal = $this->montant * $taux[$key];
        } else {
            // Conversion via MAD si conversion directe non disponible
            $toMAD = $this->deviseSource === 'MAD' ? $this->montant : $this->montant * $taux["{$this->deviseSource}_MAD"];
            $this->resultatPrincipal = $this->deviseDestination === 'MAD' ? $toMAD : $toMAD * $taux["MAD_{$this->deviseDestination}"];
        }
    }

    /**
     * Calcul de la rentabilité locative
     */
    private function calculerRentabiliteLocative()
    {
        // Calcul de l'investissement total
        $fraisAcquisitionMontant = $this->prixAchat * ($this->fraisAcquisition / 100);
        $investissementTotal = $this->prixAchat + $fraisAcquisitionMontant + $this->montantTravaux;

        // Calcul des revenus locatifs annuels en tenant compte de la vacance locative
        $revenuBrutAnnuel = $this->loyerMensuel * 12;
        $perteVacance = $revenuBrutAnnuel * ($this->tauxVacance / 100);
        $revenuBrutEffectif = $revenuBrutAnnuel - $perteVacance;

        // Calcul du revenu net avant impôts
        $revenuNetAvantImpots = $revenuBrutEffectif - $this->chargesAnnuelles;

        // Calcul des impôts
        $impots = $revenuNetAvantImpots * ($this->tauxImposition / 100);

        // Calcul du revenu net après impôts
        $this->revenuNetAnnuel = $revenuNetAvantImpots - $impots;

        // Calcul des rentabilités
        $this->rentabiliteBrute = ($revenuBrutAnnuel / $this->prixAchat) * 100;
        $this->rentabiliteNette = ($this->revenuNetAnnuel / $investissementTotal) * 100;

        // Calcul de la durée d'amortissement en années
        if ($this->revenuNetAnnuel > 0) {
            $this->dureeAmortissement = $investissementTotal / $this->revenuNetAnnuel;
        } else {
            $this->dureeAmortissement = null; // Division par zéro ou revenu négatif
        }

        // Calcul du cash flow annuel (simplifié)
        $this->cashFlowAnnuel = $this->revenuNetAnnuel;

        // Résultat principal pour l'affichage
        $this->resultatPrincipal = $this->rentabiliteNette;
    }

    /**
     * Enregistrer le calcul dans l'historique selon le type
     */
    private function enregistrerHistorique()
    {
        $base = [
            'date' => now()->format('d/m/Y H:i'),
            'resultat' => $this->resultatPrincipal
        ];

        switch ($this->type) {
            case 'salaire-net':
                $entry = array_merge($base, [
                    'salaireBrut' => $this->montant,
                    'salaireNet' => $this->salaireNet,
                    'tauxIR' => $this->tauxIR,
                    'periode' => $this->periode
                ]);
                break;

            case 'credit-immobilier':
                $entry = array_merge($base, [
                    'montantPret' => $this->montant,
                    'duree' => $this->duree,
                    'tauxInteret' => $this->tauxInteret,
                    'mensualite' => $this->mensualite
                ]);
                break;

            case 'impots-revenu':
                $entry = array_merge($base, [
                    'revenusBruts' => $this->revenusBruts,
                    'chargesDeductibles' => $this->chargesDeductibles,
                    'montantIR' => $this->montantIR
                ]);
                break;

            case 'taux-change':
                $entry = array_merge($base, [
                    'montant' => $this->montant,
                    'deviseSource' => $this->deviseSource,
                    'deviseDestination' => $this->deviseDestination
                ]);
                break;

            case 'rentabilite-locative':
                $entry = array_merge($base, [
                    'prixAchat' => $this->prixAchat,
                    'loyerMensuel' => $this->loyerMensuel,
                    'rentabiliteBrute' => $this->rentabiliteBrute,
                    'rentabiliteNette' => $this->rentabiliteNette
                ]);
                break;

            default:
                $entry = $base;
                break;
        }

        $this->historiqueCalculs[] = $entry;
    }

    /**
     * Méthode pour réinitialiser le formulaire
     */
    public function reset_form()
    {
        switch ($this->type) {
            case 'salaire-net':
                $this->reset(['montant', 'tauxIR', 'periode', 'salaireNet', 'montantIR', 'montantCNSS', 'montantAMO', 'resultatPrincipal']);
                $this->montant = 10000;
                $this->tauxIR = 38;
                break;

            case 'credit-immobilier':
                $this->reset(['montant', 'duree', 'tauxInteret', 'apport', 'mensualite', 'coutTotal', 'montantInterets', 'tauxEndettement', 'resultatPrincipal']);
                $this->montant = 1000000;
                $this->duree = 20;
                $this->tauxInteret = 4.5;
                $this->apport = 20;
                break;

            case 'impots-revenu':
                $this->reset(['revenusBruts', 'chargesDeductibles', 'montantIR', 'tauxIR', 'resultatPrincipal']);
                $this->revenusBruts = 120000;
                break;

            case 'taux-change':
                $this->reset(['montant', 'resultatPrincipal']);
                $this->montant = 1000;
                $this->deviseSource = 'MAD';
                $this->deviseDestination = 'EUR';
                break;

            case 'rentabilite-locative':
                $this->reset(['prixAchat', 'fraisAcquisition', 'montantTravaux', 'loyerMensuel', 'chargesAnnuelles',
                'tauxImposition', 'tauxVacance', 'rentabiliteBrute', 'rentabiliteNette', 'revenuNetAnnuel',
                'dureeAmortissement', 'cashFlowAnnuel', 'resultatPrincipal']);
                $this->prixAchat = 1000000;
                $this->fraisAcquisition = 7;
                $this->montantTravaux = 50000;
                $this->loyerMensuel = 5000;
                $this->chargesAnnuelles = 6000;
                $this->tauxImposition = 20;
                $this->tauxVacance = 5;
                break;
        }
    }

    /**
     * Méthode pour basculer l'affichage de l'historique
     */
    public function toggleHistory()
    {
        $this->showHistory = !$this->showHistory;
    }

    /**
     * Méthode pour effacer l'historique
     */
    public function clearHistory()
    {
        $this->historiqueCalculs = [];
        $this->showHistory = false;
    }

    /**
     * Rendu du composant
     */
    #[Title('Calculateur - En-Ligne.ma')]
    public function render()
    {
        return view('livewire.calculator-card');
    }
}

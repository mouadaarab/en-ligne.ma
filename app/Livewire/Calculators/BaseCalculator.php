<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

abstract class BaseCalculator extends Component
{
    /**
     * Type de calculateur (à définir dans les classes enfants)
     */
    public string $type;

    /**
     * Titre du calculateur (à définir dans les classes enfants)
     */
    public string $title;

    /**
     * Description du calculateur pour le SEO (à définir dans les classes enfants)
     */
    public string $description;

    /**
     * Résultat principal du calcul
     */
    public ?float $resultatPrincipal = null;

    /**
     * Historique des calculs
     */
    public array $historiqueCalculs = [];

    /**
     * Afficher l'historique
     */
    public bool $showHistory = false;

    /**
     * Constructor du composant
     */
    public function mount()
    {
        // Charger l'historique des calculs depuis la session
        $this->loadHistory();
    }

    /**
     * Méthode abstraite pour effectuer le calcul
     */
    abstract public function calculer();

    /**
     * Méthode abstraite pour réinitialiser le formulaire
     */
    abstract public function reset_form();

    /**
     * Méthode pour enregistrer l'historique des calculs
     * Les enfants peuvent surcharger cette méthode pour des besoins spécifiques
     */
    protected function enregistrerHistorique()
    {
        // À implémenter dans les classes enfants
    }

    /**
     * Charger l'historique depuis la session et le localStorage
     */
    protected function loadHistory()
    {
        $calculType = $this->type;

        // Chargement depuis la session
        if (session()->has("calculator.{$calculType}.history")) {
            $this->historiqueCalculs = session("calculator.{$calculType}.history", []);
        }

        // On informe le navigateur qu'il doit synchroniser avec localStorage après chargement
        $this->dispatch('calculator:load-history', type: $calculType);
    }

    /**
     * Sauvegarder l'historique dans la session et le localStorage
     */
    protected function saveHistory()
    {
        $calculType = $this->type;
        // Limiter l'historique à 10 entrées maximum
        $this->historiqueCalculs = array_slice($this->historiqueCalculs, 0, 10);
        session(["calculator.{$calculType}.history" => $this->historiqueCalculs]);

        // On informe le navigateur qu'il doit sauvegarder dans localStorage
        $this->dispatch('calculator:save-history', type: $calculType, history: $this->historiqueCalculs);
    }

    /**
     * Importer l'historique depuis le localStorage
     */
    public function importFromLocalStorage($history)
    {
        if (!empty($history) && is_array($history)) {
            $this->historiqueCalculs = array_slice(array_merge($this->historiqueCalculs, $history), 0, 10);
            $this->saveHistory();
        }
    }

    /**
     * Effacer l'historique
     */
    public function clearHistory()
    {
        $this->historiqueCalculs = [];
        $calculType = $this->type;
        session()->forget("calculator.{$calculType}.history");

        // On informe le navigateur qu'il doit effacer le localStorage
        $this->dispatch('calculator:clear-history', type: $calculType);
    }

    /**
     * Basculer l'affichage de l'historique
     */
    public function toggleHistory()
    {
        $this->showHistory = !$this->showHistory;
    }

    /**
     * Méthode pour le rendu du composant
     * Chaque calculateur utilise sa propre vue
     */
    public function render()
    {
        // Convertir le type "salaire-net" en "salaire-net-calculator"
        $viewName = 'livewire.calculators.' . $this->type . '-calculator';

        // Vérifier si la vue existe, sinon utiliser une vue par défaut
        if (!view()->exists($viewName)) {
            return view('livewire.calculators.calculator-layout');
        }

        return view($viewName);
    }
}

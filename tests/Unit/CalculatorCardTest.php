<?php

namespace Tests\Unit;

use App\Livewire\CalculatorCard;
use Livewire\Livewire;
use Tests\TestCase;

class CalculatorCardTest extends TestCase
{
    /** @test */
    public function it_can_calculate_net_salary_correctly()
    {
        Livewire::test(CalculatorCard::class, ['type' => 'salaire-net'])
            ->set('salaireBrut', 10000)
            ->set('tauxIR', 30)
            ->set('periode', 'mensuel')
            ->call('calculer')
            ->assertSet('salaireNet', function ($salaireNet) {
                // Vérification que le salaire net calculé est cohérent
                // salaireBrut - CNSS - AMO - IR = salaireNet
                $salaireBrut = 10000;
                $cnss = $salaireBrut * 0.0448;
                $amo = $salaireBrut * 0.0226;
                $baseIR = $salaireBrut - $cnss - $amo;
                $ir = $baseIR * 0.30;
                $expectedNet = $salaireBrut - $cnss - $amo - $ir;

                // Tolérance de 0.01 pour les erreurs d'arrondi
                return abs($salaireNet - $expectedNet) < 0.01;
            });
    }

    /** @test */
    public function it_can_reset_form_fields()
    {
        Livewire::test(CalculatorCard::class)
            ->set('salaireBrut', 15000)
            ->set('tauxIR', 25)
            ->call('calculer')
            ->assertNotSet('salaireNet', null)
            ->call('reset_form')
            ->assertSet('salaireBrut', 0)
            ->assertSet('tauxIR', 38)
            ->assertSet('salaireNet', null);
    }

    /** @test */
    public function it_validates_input_correctly()
    {
        Livewire::test(CalculatorCard::class)
            ->set('salaireBrut', -100) // Valeur négative invalide
            ->call('calculer')
            ->assertHasErrors(['salaireBrut']);

        Livewire::test(CalculatorCard::class)
            ->set('tauxIR', 105) // Taux IR supérieur à 100%
            ->call('calculer')
            ->assertHasErrors(['tauxIR']);

        Livewire::test(CalculatorCard::class)
            ->set('periode', 'trimestriel') // Période non valide
            ->call('calculer')
            ->assertHasErrors(['periode']);
    }

    /** @test */
    public function it_stores_calculation_in_history()
    {
        Livewire::test(CalculatorCard::class)
            ->set('salaireBrut', 10000)
            ->set('tauxIR', 30)
            ->set('periode', 'mensuel')
            ->call('calculer')
            ->assertCount('historiqueCalculs', 1)
            ->call('calculer')
            ->assertCount('historiqueCalculs', 2);
    }

    /** @test */
    public function it_can_clear_history()
    {
        Livewire::test(CalculatorCard::class)
            ->set('salaireBrut', 10000)
            ->call('calculer')
            ->assertCount('historiqueCalculs', 1)
            ->call('clearHistory')
            ->assertCount('historiqueCalculs', 0);
    }

    /** @test */
    public function it_toggles_history_visibility()
    {
        Livewire::test(CalculatorCard::class)
            ->assertSet('showHistory', false)
            ->call('toggleHistory')
            ->assertSet('showHistory', true)
            ->call('toggleHistory')
            ->assertSet('showHistory', false);
    }

    /** @test */
    public function it_can_handle_different_calculator_types()
    {
        Livewire::test(CalculatorCard::class, ['type' => 'credit-immobilier'])
            ->assertSet('type', 'credit-immobilier')
            ->assertSet('title', 'Simulateur de crédit immobilier');

        Livewire::test(CalculatorCard::class, ['type' => 'salaire-net'])
            ->assertSet('type', 'salaire-net')
            ->assertSet('title', 'Calculateur de salaire net');
    }
}

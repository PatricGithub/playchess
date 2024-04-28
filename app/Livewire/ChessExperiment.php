<?php

namespace App\Livewire;

use Livewire\Component;

class ChessExperiment extends Component
{
    public $trialOrders;
    public $condition;
    public $showFormButton = false;
    public $seconds = 3;

    public function mount($trialOrders, $condition)
    {
        $this->trialOrders = $trialOrders;
        $this->condition = $condition;
    }

    public function showForm()
    {
        $this->showFormButton = true;
    }

    public function render()
    {
        return view('livewire.chess-experiment');
    }

    public function updatedSeconds()
    {
        if ($this->seconds < 0) {
            $this->seconds = 0;
            $this->emit('countdownEnded');
        }
    }

    public function startCountdown()
    {
        $this->emit('startCountdown');
    }

    public function submitForm()
    {
        // Handle form submission logic here
    }
}
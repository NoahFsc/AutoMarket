<?php

namespace App\Livewire;

use Livewire\Component;

class SellingCard extends Component
{
    public $car;

    public function render()
    {
        return view('components.selling-card');
    }
}

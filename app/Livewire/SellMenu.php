<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\CarModel;
use Livewire\Component;
use Carbon\Carbon;

class SellMenu extends Component
{


    public function render()
    {
        return view('components.sell-menu');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Countdown extends Component
{
    public $car;
    public $timeRemaining;

    public function mount($car)
    {
        $this->car = $car;
        $this->updateAuction();
    }

    public function updateAuction()
    {
        $deadline = Carbon::parse($this->car->deadline);
        $now = Carbon::now();
        $diff = $deadline->diff($now);

        $this->timeRemaining = sprintf('%02dj %02dh %02dm %02ds', $diff->d, $diff->h, $diff->i, $diff->s);
        if ($this->car->lastBid && $this->car->lastBid->isNotEmpty()) {
            $this->car->selling_price = $this->car->lastBid->first()->proposed_price;
        } else {
            $this->car->selling_price = $this->car->selling_price;
        }
    }

    public function render()
    {
        return view('components.countdown');
    }
}

<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class AuctionCard extends Component
{
    public $car;

    public $timeRemaining;

    public function mount($car)
    {
        $this->car = $car;
        $this->updateCard();
    }

    public function updateCard()
    {
        $deadline = Carbon::parse($this->car->deadline);
        $now = Carbon::now();
        $diff = $deadline->diff($now);

        $this->timeRemaining = sprintf('%02dj %02dh %02dm %02ds', $diff->d, $diff->h, $diff->i, $diff->s);

        if ($this->car->lastBid && $this->car->lastBid->isNotEmpty()) {
            $this->car->selling_price = $this->car->lastBid->first()->proposed_price;
        }
    }

    public function render()
    {
        return view('components.auction-card');
    }
}

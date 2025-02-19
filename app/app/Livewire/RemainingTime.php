<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class RemainingTime extends Component
{
    public $car;

    public $remainingTime;

    public function mount($car)
    {
        $this->car = $car;
        $this->updateRemainingTime();
    }

    public function updateRemainingTime()
    {
        $deadline = Carbon::parse($this->car->deadline);
        $now = Carbon::now();
        $diff = $deadline->diff($now);

        $this->remainingTime = sprintf('%02dj %02dh %02dm %02ds', $diff->d, $diff->h, $diff->i, $diff->s);
    }

    public function render()
    {
        return view('components.remaining-time');
    }
}

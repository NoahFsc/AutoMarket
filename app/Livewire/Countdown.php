<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Countdown extends Component
{
    public $deadline;
    public $remainingTime;

    public function mount($deadline)
    {
        $this->deadline = Carbon::parse($deadline);
        $this->calculateTime();
    }

    public function calculateTime()
    {
        $now = Carbon::now();
        $diff = $this->deadline->diff($now);

        if ($this->deadline->isPast()) {
            $this->remainingTime = 'Enchère terminée';
            $this->dispatch('auction-ended');
        } else {
            $parts = [];
            if ($diff->d > 0) {
                $parts[] = sprintf('%d jours', $diff->d);
            }
            if ($diff->h > 0) {
                $parts[] = sprintf('%d heures', $diff->h);
            }
            if ($diff->i > 0) {
                $parts[] = sprintf('%d minutes', $diff->i);
            }
            $parts[] = sprintf('%d secondes', $diff->s);

            $this->remainingTime = implode(' ', $parts);
        }
    }

    public function render()
    {
        return view('components.countdown');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class ReviewCard extends Component
{
    public $review;

    public function mount($review)
    {
        $this->review = $review;
    }

    public function render()
    {
        return view('components.review-card-profile');
    }
}

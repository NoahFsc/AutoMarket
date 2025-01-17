<?php

namespace App\Livewire;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SellMenu extends Component
{
    public $sells;

    public $auctions;

    public string $search = '';

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->sells = $user->cars->where('vente_enchere', 0);
            $this->auctions = $user->cars->where('vente_enchere', 1);
        } else {
            $this->sells = collect();
            $this->auctions = collect();
        }
    }

    public function createAd()
    {
        return redirect()->route('vendre.step1');
    }

    public function render()
    {
        $user = Auth::user();
        if ($user && $user->cars) {
            $sellsQuery = Car::where('user_id', Auth::id())->where('vente_enchere', 0);
            $auctionsQuery = Car::where('user_id', Auth::id())->where('vente_enchere', 1);

            if ($this->search) {
                $sellsQuery->whereHas('carModel', function ($q) {
                    $q->where('model_name', 'like', '%'.$this->search.'%')
                        ->orWhereHas('brand', function ($q) {
                            $q->where('brand_name', 'like', '%'.$this->search.'%');
                        });
                });

                $auctionsQuery->whereHas('carModel', function ($q) {
                    $q->where('model_name', 'like', '%'.$this->search.'%')
                        ->orWhereHas('brand', function ($q) {
                            $q->where('brand_name', 'like', '%'.$this->search.'%');
                        });
                });
            }

            $this->sells = $sellsQuery->get();
            $this->auctions = $auctionsQuery->get();
        } else {
            $this->sells = collect();
            $this->auctions = collect();
        }

        return view('components.sell-menu', [
            'sells' => $this->sells,
            'auctions' => $this->auctions,
        ]);
    }
}

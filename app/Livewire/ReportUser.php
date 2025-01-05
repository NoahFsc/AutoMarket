<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ReportUser extends Component
{
    public $userId;
    public $reason;
    public User $user;

    protected $rules = [
        'reason' => 'required|string|max:1000',
    ];

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
    }

    public function submit()
    {
        $this->validate();

        Report::create([
            'reason' => $this->reason,
            'status' => 0,
            'user_id_receiver' => $this->userId,
            'user_id_writer' => Auth::id(),
        ]);

        session()->flash('status', 'Signalement envoyé avec succès.');
        session()->flash('concerned_user_id', $this->userId);

        return redirect()->route('user.index', $this->userId);
    }

    public function render()
    {
        return view('components.report-user');
    }
}

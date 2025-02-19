<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function verifyUser($userId)
    {
        $user = User::find($userId);
        $user->email_verified_at = now();
        $user->save();

        session()->flash('verifiedEvent', 'Utilisateur vérifié avec succès.');
    }

    public function deleteUser($userId)
    {
        User::find($userId)->delete();
    }

    public function render()
    {
        $users = User::where('first_name', 'like', '%'.$this->search.'%')
            ->orWhere('last_name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->paginate(6);

        return view('components.admin.users-catalog', ['users' => $users]);
    }
}

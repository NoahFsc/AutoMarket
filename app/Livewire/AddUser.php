<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUser extends Component
{
    public $first_name;

    public $last_name;

    public $email;

    public $password;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:4',
    ];

    public function addUser()
    {
        $this->validate();

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('status', 'Utilisateur ajouté avec succès.');

        // Réinitialiser les champs du formulaire
        $this->reset(['first_name', 'last_name', 'email', 'password']);

        $this->dispatch('close-add-user-modal');
    }

    public function render()
    {
        return view('components.admin.add-user');
    }
}

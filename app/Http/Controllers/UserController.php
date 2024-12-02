<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $donnees = $request->validate([
            'profile_picture' => 'nullable|file|mimes:webp,png,jpg,jpeg|max:2048',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'email' => 'required|email|max:255',
            'birth_date' => 'nullable|date',
            'identity_card' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('profile_picture')) {
            $donnees['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->hasFile('identity_card')) {
            $donnees['identity_card'] = $request->file('identity_card')->store('identity_cards', 'public');
        }

        $user->update($donnees);

        return redirect()->route('user.index')->with('status', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:4',
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return back()->with('status', 'Mot de passe mis à jour avec succès.');
    }
}
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
        $request->validate([
            'photo_de_profil' => 'nullable|file|mimes:webp,png,jpg,jpeg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('photo_de_profil')) {
            $path = $request->file('photo_de_profil')->store('photos_de_profil', 'public');
            $user->photo_de_profil = $path;
        }

        $user->save();

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

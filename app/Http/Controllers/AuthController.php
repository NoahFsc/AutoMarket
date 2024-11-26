<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home'));
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|min:3|max:255',
            'first_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
        ]);

        // Stocker les informations de la première étape dans la session
        $request->session()->put('register', $validated);

        return redirect()->route('auth.register.step2');
    }

    public function showRegisterStep2()
    {
        return view('auth.register_step2');
    }

    public function doRegisterStep2(Request $request)
    {
        $validated = $request->validate([
            'birth_date' => 'required|date',
            'identity_card' => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        // Récupérer les informations de la première étape depuis la session
        $registerData = $request->session()->get('register');

        // Créer l'utilisateur
        $user = User::create([
            'last_name' => $registerData['last_name'],
            'first_name' => $registerData['first_name'],
            'email' => $registerData['email'],
            'password' => Hash::make($registerData['password']),
            'birth_date' => $validated['birth_date'],
            'identity_card' => $request->file('identity_card')->store('identity_card'),
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
        ]);

        Auth::login($user);

        // Supprimer les données de la session
        $request->session()->forget('register');

        return redirect(route('home'));
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token, Request $request)
    {
        $email = $request->input('email');
        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login() // Affiche le formulaire de connexion
    {
        return view('auth.login'); // Retourne la vue de connexion
    }

    public function doLogin(LoginRequest $request) // Traite la tentative de connexion
    {
        $credentials = $request->validated(); // Récupère les données validées du formulaire

        if(Auth::attempt($credentials)) { // Vérifie les identifiants pour l’admin
            $request->session()->regenerate(); // Régénère la session pour la sécurité
            return redirect()->intended(route('admin.property.index')); // Redirige vers la page admin
        }

        if(Auth::attempt($credentials)) { // Vérifie les identifiants pour l’utilisateur standard
            $request->session()->regenerate(); // Régénère la session pour la sécurité
            return redirect()->intended(route('property.show')); // Redirige vers la page utilisateur
        }

        return back()->withErrors([ // Retourne à la page précédente avec des erreurs si connexion échouée
            'email' =>  'Identifiant Incorrect',
            'password' =>  'Identifiant Incorrect'
        ])->onlyInput('email', 'password'); // Garde les champs saisis
    }


    public function logout() // Déconnecte l’utilisateur
    {
        Auth::logout(); // Déconnecte l’utilisateur courant
        return to_route('login'); // Redirige vers la page de connexion
    }

}

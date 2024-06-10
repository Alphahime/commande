<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if ($request->has('produitId')) {
            session(['produitId' => $request->produit_id]);
        }
        return view('connexion.connect');
    }
    
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('produitId')) {
            session(['produitId' => $request->produit_id]);
        }
        return view('connexion.inscrire');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mdp' => 'required|string',
        ]);
    
        $utilisateur = Utilisateur::where('nom', $request->name)->first();
    
        if ($utilisateur && Hash::check($request->mdp, $utilisateur->mdp)) {
            Auth::login($utilisateur);
    
            // Redirection après connexion réussie vers la page details.blade.php avec l'ID du produit
            if ($request->session()->has('produitId')) {
                $produitId = $request->session()->get('produitId');
                return redirect()->route('details', ['id' => $produitId]);
            } else {
                return redirect()->route('afficher_panier'); // Redirection vers la page du panier par défaut
            }
        } else {
            return back()->withErrors(['name' => 'Identifiants incorrects'])->withInput();
        }
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }


    public function register(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255|unique:utilisateurs',
            'mdp' => 'required|string|min:8|confirmed',
        ]);
    
        // Créer un nouvel utilisateur
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $request->nom; // Assurez-vous que 'nom' correspond au nom de la colonne dans votre base de données
        $utilisateur->mdp = Hash::make($request->mdp);
        $utilisateur->save();
    
        // Rediriger l'utilisateur vers la page de connexion avec un message de succès
        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

}

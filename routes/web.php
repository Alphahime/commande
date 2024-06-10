<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\UtilisateurController;

// Routes pour Produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('produits/create', [ProduitController::class, 'create'])->name('produits.creer');
Route::post('produits', [ProduitController::class, 'enregistrer'])->name('produits.enregistrer');
Route::get('produits/{produit}', [ProduitController::class, 'afficher'])->name('produits.afficher');
Route::get('produits/{produit}/modifier', [ProduitController::class, 'modifier'])->name('produits.modifier');
Route::put('/produits/{produit}', [ProduitController::class, 'mettreAJour'])->name('produits.mettreAJour');
Route::delete('produits/{produit}', [ProduitController::class, 'supprimer'])->name('produits.supprimer');
Route::get('/produits/filter/{etat}', [ProduitController::class, 'filter'])->name('produits.filter');
Route::get('/categorie/{id}', [ProduitController::class, 'produitsParCategorie'])->name('produits.parCategorie');


// Routes pour Commandes
Route::get('/commande', [CommandeController::class, 'afficherPanier'])->name('afficher_panier');
//Route::get('/creer-commande', [CommandeController::class, 'creerCommandeForm'])->name('creer_commande');


// Route pour afficher les détails du produit
Route::get('/details/{id}', [ProduitController::class, 'details'])->name('details');


Route::get('/connexion', [UtilisateurController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [UtilisateurController::class, 'login']);
Route::post('/deconnexion', [UtilisateurController::class, 'logout'])->name('logout');
Route::get('/register', [UtilisateurController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UtilisateurController::class, 'register']);

//Route::get('/confirmation-commande', [CommandeController::class, 'confirmationCommande'])->name('confirmation_commande');

//Route::post('/commander', [CommandeController::class, 'creerCommande'])->name('commander');




Route::post('/commander', [CommandeController::class, 'commander'])->name('commander');
Route::get('/confirmation/{commande}', [CommandeController::class, 'confirmation'])->name('confirmation_commande');
Route::get('/panier', [CommandeController::class, 'afficherPanier'])->name('afficher_panier');

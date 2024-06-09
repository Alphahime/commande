<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

// Routes pour Produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('produits/create', [ProduitController::class, 'create'])->name('produits.creer');
Route::post('produits', [ProduitController::class, 'enregistrer'])->name('produits.enregistrer');
Route::get('produits/{produit}', [ProduitController::class, 'afficher'])->name('produits.afficher');
Route::get('produits/{produit}/modifier', [ProduitController::class, 'modifier'])->name('produits.modifier');
Route::put('/produits/{produit}', [ProduitController::class, 'mettreAJour'])->name('produits.mettreAJour');
Route::delete('produits/{produit}', [ProduitController::class, 'supprimer'])->name('produits.supprimer');


Route::get('/produits/filter/{etat}', [ProduitController::class, 'filter'])->name('produits.filter');

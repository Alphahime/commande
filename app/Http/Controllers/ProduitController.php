<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.creer', compact('categories'));
    }

    public function enregistrer(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorieId' => 'required|exists:categories,id',
            'etat' => 'required|in:disponible,ruptureStock,enStock',
        ]);

        Produit::create($data);

        return redirect()->route('produits.index');
    }
    public function filter($etat)
    {
        if ($etat === 'disponible') {
            $produits = Produit::where('etat', 'disponible')->get();
        } elseif ($etat === 'rupture') {
            $produits = Produit::where('etat', 'ruptureStock')->get();
        } elseif ($etat === 'stock') {
            $produits = Produit::where('etat', 'enStock')->get();
        } else {
            $produits = Produit::all();
        }
    
        return view('produits.index', compact('produits'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorieId' => 'required|exists:categories,id',
            'etat' => 'required|in:disponible,ruptureStock,enStock',
            'image' => 'required|url', // Validation de l'URL de l'image
        ]);
    
        Produit::create($data);
    
        return redirect()->route('produits.index');
    }
    
    public function afficher(Produit $produit)
    {
        return view('produits.afficher', compact('produit'));
    }

    public function modifier(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.modifier', compact('produit', 'categories'));
    }

    public function mettreAJour(Request $request, Produit $produit)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'categorieId' => 'required|exists:categories,id',
        'etat' => 'required|in:disponible,ruptureStock,enStock',
    ]);

    $produit->update($data);

    return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès');
}

    public function supprimer(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index');
    }

    public function details($id)
{
    $produit = Produit::findOrFail($id);
    return view('commande.details', compact('produit'));
}

public function show($id)
{
    $produit = Produit::with('categorie')->findOrFail($id);
    return view('commande.details', compact('produit'));
}
}

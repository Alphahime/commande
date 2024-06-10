<?php



namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Produit;
use App\Models\Categorie;

class CommandeController extends Controller
{
    public function afficherPanier(Request $request)
    {
        // Récupérer toutes les catégories
        $categories = Categorie::all();

        // Récupérer les produits filtrés par catégorie si une catégorie est sélectionnée
        $categorieId = $request->input('categorieId');
        if ($categorieId) {
            $produits = Produit::where('categorieId', $categorieId)->where('etat', 'disponible')->get();
        } else {
            $produits = Produit::where('etat', 'disponible')->get();
        }

        // Passer les produits et les catégories à la vue panier.blade.php
        return view('commande.panier', [
            'produits' => $produits,
            'categories' => $categories,
            'selectedCategorieId' => $categorieId
        ]);
    }

    public function creerCommande(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'produits' => 'required|array',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        // Création de la commande
        $commande = new Commande();
        $commande->montantTotal = 0;
        $commande->utilisateurId = auth()->user()->id;
        $commande->save();

        // Boucle à travers les produits pour les ajouter à la commande
        foreach ($request->produits as $produit) {
            $detailCommande = new Commande();
            $detailCommande->commande_id = $commande->id;
            $detailCommande->produit_id = $produit['id'];
            $detailCommande->quantite = $produit['quantite'];
            $detailCommande->prix_unitaire = Produit::find($produit['id'])->prix;
            $detailCommande->save();

            // Met à jour le montant total de la commande
            $commande->montantTotal += $detailCommande->quantite * $detailCommande->prix_unitaire;
        }

        // Enregistre le montant total final de la commande
        $commande->save();

        // Redirige vers une page de confirmation de commande ou autre
        return redirect()->route('confirmation_commande');
    }

    public function confirmationCommande()
{
    // Récupérer la commande à partir de la base de données (vous devez ajuster ceci en fonction de votre logique)
    $commande = DetailCommande::find($commandeId); // $commandeId doit être l'identifiant de la commande que vous souhaitez afficher

    // Vérifier si la commande existe
    if (!$commande) {
        // Gérer le cas où la commande n'existe pas, peut-être rediriger vers une page d'erreur
        return redirect()->route('error')->with('error', 'Commande non trouvée.');
    }

    // Récupérer les détails de la commande (par exemple, les produits commandés)
    $detailsCommande = Commande::where('commandeId', $commande->id)->get();

    // Vous pouvez effectuer d'autres opérations ici, par exemple, calculer le montant total de la commande

    // Passer les données à la vue de confirmation de commande
    return view('commande.confirmation', [
        'commande' => $commande,
        'detailsCommande' => $detailsCommande,
    ]);
}
public function commander(Request $request)
{
    $request->validate([
        'produitId' => 'required|exists:produits,id',
    ]);

    $produit = Produit::find($request->produit_id);

    // Création de la commande
    $commande = new Commande();
    $commande->utilisateur_id = Auth::id();  // Utilisez l'utilisateur authentifié
    $commande->montant_total = $produit->prix;
    $commande->save();

    // Ajouter le produit à la commande (création de la relation)
    $commande->produits()->attach($produit->id, ['quantite' => 1]);

    return redirect()->route('confirmation_commande', ['commande' => $commande->id]);
}


}

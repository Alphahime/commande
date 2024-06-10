<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'montantTotal',
        'utilisateur_id', // Changer utilisateurId en utilisateur_id pour correspondre à la convention de nommage Laravel
    ];

    // Relation avec l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    // Relation avec les produits (via la table pivot detail_commandes)
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'detail_commandes', 'commande_id', 'produit_id')
                    ->withPivot('quantite', 'prix_unitaire');
    }
}

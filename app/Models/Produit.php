<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'categorieId',
        'etat',
        'image',
    ];

    public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categorieId');
}


    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit');
    }

  
}

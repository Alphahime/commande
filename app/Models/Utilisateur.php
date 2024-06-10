<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'mdp',
        'admin',
    ];

    protected $hidden = [
        'mdp',
        'remember_token',
    ];

    protected $casts = [
        'admin' => 'boolean',
    ];

    // Relation avec les commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}

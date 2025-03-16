<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Le tableau $fillable doit contenir 'client_id' et 'total'
    protected $fillable = ['client_id', 'total'];

    // Relation many-to-many avec la table 'produits'
    public function produits()
{
    return $this->belongsToMany(Produit::class)
        ->withPivot('quantite', 'prix') // Récupération de la quantité et du prix unitaire
        ->withTimestamps(); // Récupération des timestamps si nécessaire
}

    
    // Relation avec le client (la table clients)
    public function client()
    {
        return $this->belongsTo(Client::class);  // Définir la relation avec la table 'clients'
    }
}

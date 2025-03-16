<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prix', 'stock', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class)
            ->using(CommandeProduit::class)  // Utilisation du modèle de la table pivot
            ->withPivot('quantite', 'prix')  // Définir les colonnes supplémentaires de la table pivot
            ->withTimestamps();  // Utiliser les timestamps dans la table pivot
    }
}

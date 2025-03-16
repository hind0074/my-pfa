<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class commandeProduit extends Pivot
{
    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prix'];
}

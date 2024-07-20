<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    use HasFactory;

    protected $fillable = ["designation", "qte_command","qte_recu", "prix_unitaire","montant","date_livraison", "etat_livraison", "categorie_id","fournisseur_id","user_id"];



    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    
}

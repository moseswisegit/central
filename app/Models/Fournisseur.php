<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ["libelle", "adresse","user_id"];

    public function produits()
    {
        return $this->hasMany(Produits::class);
    }
}

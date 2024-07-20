<?php

namespace App\Models;

use App\Models\Ville;
use App\Models\Quartier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory;
    protected $fillable = ["libelle","ville_id"];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class, 'commune_id');
    }
}

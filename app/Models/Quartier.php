<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quartier extends Model
{
    use HasFactory;
    protected $fillable = ["libelle","commune_id"];

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

   
}

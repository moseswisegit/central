<?php

namespace App\Models;

use App\Models\Ville;
use App\Models\Paroisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pays extends Model
{
    use HasFactory;
    protected $fillable = ["libelle","phone_code"];

    public function villes()
    {
        return $this->hasMany(Ville::class, 'pays_id');
    }

    public function paroisses()
    {
        return $this->hasMany(Paroisse::class, 'pays_id');
    }
}

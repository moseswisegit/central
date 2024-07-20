<?php

namespace App\Models;

use App\Models\Paroisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paroisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_paroisse',
        'pays_id',
        'ville_id',
        'commune_id',
        'quartier_id',
        'adresse_paroisse',
        'nom_charge',
        'numero_charge',
        'nom_secretaire',
        'numero_secretaire',
        'nom_maitre_choeur',
        'numero_maitre_choeur',
        'image_eglise',
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }

    public function paroisse_decision()
    {
        return $this->belongsTo(Paroisse_decision::class, 'paroisse_id');
    }

}

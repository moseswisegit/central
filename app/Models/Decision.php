<?php

namespace App\Models;

use App\Models\Paroisse_decision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;

    protected $fillable = ["libelle"];

    public function paroisse_decision()
    {
        return $this->hasMany(Paroisse_decision::class, 'decision_id');
    }

}

<?php

namespace App\Models;

use App\Models\Decision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paroisse_decision extends Model
{
    use HasFactory;

    protected $fillable = [
        'paroisse_id',
        'decision',
    ];

    public function paroisses()
    {
        return $this->hasMany(Paroisse::class, 'paroisse_id');
    }

    public function decision()
    {
        return $this->belongsTo(Decision::class, 'decision_id');
    }
}

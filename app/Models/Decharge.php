<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    use HasFactory;

    protected $fillable = ["nom_donneur", "nom_receveur","date_emission","montant", "motif","url","user_id"];

}

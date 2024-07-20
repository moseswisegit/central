<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function dirigeant_paroisse()
    {
        $pays = Pays::get();
        return view('home/dirigeant',compact('pays'));
    }
}

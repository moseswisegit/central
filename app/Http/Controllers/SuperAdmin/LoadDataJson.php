<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Pays;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ville; // Assurez-vous d'importer le modèle Ville
use App\Models\Commune; // Assurez-vous d'importer le modèle Commune
use App\Models\Quartier; // Assurez-vous d'importer le modèle Quartier


class LoadDataJson extends Controller
{
    // Par exemple, dans votre contrôleur ParoisseController.php


    public function loadCities(Request $request)
    {
        $paysId = $request->input('pays_id');
        $villes = Ville::where('pays_id', $paysId)->get();
        return response()->json($villes);
    }

    public function loadCommunes(Request $request)
    {
        $villeId = $request->input('ville_id');
        $communes = Commune::where('ville_id', $villeId)->get();
        return response()->json($communes);
    }

    public function loadQuartiers(Request $request)
    {
        $communeId = $request->input('commune_id');
        $quartiers = Quartier::where('commune_id', $communeId)->get();
        return response()->json($quartiers);
    }

   

    public function loadPhoneCode(Request $request) {
        $paysId = $request->input('pays_id');
        
        // Supposons que vous avez un modèle Pays avec un champ phone_code
        $pays = Pays::find($paysId);
        
        return response()->json(['phone_code' => $pays->phone_code]);
    }

}

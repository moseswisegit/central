<?php

namespace App\Http\Controllers;

use App\Models\Paroisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\StoreParoissesRequest;


class ParoisseController extends Controller
{
    public function index()
    {
        if (! Gate::allows('paroisse_access')) {
            return abort(401);
        }


        $paroisses = Paroisse::orderBy('created_at', 'desc')->get();


        $enteteContent = "Paroisse";

        return view('user.paroisse.index', compact('paroisses','enteteContent'));
    }

    public function obtenirParoisses()
    {
        $paroisses = Paroisse::orderBy('created_at', 'desc')->get();
        return response()->json($paroisses);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreParoissesRequest $request)
    // {
    //     $errors = [];
    
    //     // Vérifier s'il existe déjà une catégorie avec le même libellé
    //     $existingParoisse = Paroisse::where('libelle', $request->libelle)->first();
    
    //     if ($existingParoisse) {
    //         $errors['libelle'] = ['Doublon de libellé.'];
    //     }
    
    //     if (!empty($errors)) {
    //         return redirect()->back()->withErrors($errors)->withInput();
    //         // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
    //     }
    
    //     Paroisse::create([
    //         'libelle' => $request->libelle,
    //         'user_id'   => Auth::user()->id
    //     ]);

    //     return redirect()->back()->with('success', 'Paroisse enregistrée avec succès.');
    //     // Redirection avec un message de succès.
    // }



    
    public function enregistrerParoisse(StoreParoissesRequest $request){
        // Récupérer les données du formulaire
        $data = $request->validated();
    
        // Vérifier si une paroisse existe avec les mêmes critères de recherche
        $paroisse = Paroisse::where('nom_paroisse', $data['nom_paroisse'])
            ->where('numero_charge', $data['numero_charge'])
            ->where('numero_secretaire', $data['numero_secretaire'])
            ->where('numero_maitre_choeur', $data['numero_maitre_choeur'])
            ->first();
    
        // Si une paroisse correspondante est trouvée, mettre à jour ses données
        if ($paroisse) {
            $paroisse->update($data);
        } else {
            // Sinon, créer une nouvelle paroisse avec les données fournies
            $paroisse = Paroisse::create($data);
        }
    
        // Gérer l'upload de l'image s'il y en a une
        if ($request->hasFile('image_eglise')) {
            $image = $request->file('image_eglise');
            $fileName = 'image_' . $paroisse->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $fileName);
            $paroisse->image_eglise = $fileName;
            $paroisse->save();
        }
    

        // on remplit la table déécision 
        $decision_id = DB::table('decisions')->where('libelle', 'Neutre')->pluck('id')->first();

        DB::table('paroisse_decisions')->updateOrInsert(
            [
                'paroisse_id' => $paroisse->id,
            ],
            [
                'decision_id' => $decision_id,
            ]
        );

        
       

        return redirect()->route('accueil')->with('success', 'Paroisse enregistrée avec succès. Vous serez contacté bientôt');
    }
    

    
}



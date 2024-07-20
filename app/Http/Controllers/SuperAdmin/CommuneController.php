<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Ville;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreCommuneRequest;
use App\Http\Requests\Admin\UpdateCommuneRequest;

class CommuneController extends Controller
{
    public function index()
    {
        if (! Gate::allows('commune_access')) {
            return abort(401);
        }

        $commune = Commune::orderBy('created_at', 'desc')->get();
        $ville = Ville::orderBy('created_at', 'desc')->get();
       
        $enteteContent = "Commune";

        return view('superAdmin.commune.index', compact('commune','ville','enteteContent'));
    }

    public function store(StoreCommuneRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingCommune = Commune::where('libelle', $request->libelle)->first();
    
        if ($existingCommune) {
            $errors["libelle"] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
       Commune::create([
            'libelle' => $request->libelle,
             'ville_id' => $request->ville_id,
        ]);

        return redirect()->back()->with('success', 'Commune enregistrée avec succès.');
        // Redirection avec un message de succès.
    }



    public function show($id)
    {
        if (! Gate::allows('commune_view')) {
            return abort(401);
        }
        $commune = Commune::findOrFail($id);

        return view('superAdmin.commune.show', compact('commune'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('commune_edit')) {
            return abort(401);
        }
        $commune = Commune::findOrFail($id);

        return view('superAdmin.commune_edit.edit', compact('commune'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommuneRequest $request, $id)
    {
        if (!Gate::allows('commune_edit')) {
            return abort(401);
        }
    
        $commune = Commune::findOrFail($id);
    
        // Mettre à jour les champs de la commune
        $commune->libelle = $request->input('libelle');
    
        // Vérifier si l'utilisateur a sélectionné une ville différente
        $nouvelleVilleId = $request->input('ville_id');
        if ($commune->ville_id != $nouvelleVilleId) {
            // Mettre à jour la relation avec la nouvelle ville
            $ville = Ville::find($nouvelleVilleId);
            if ($ville) {
                $commune->ville()->associate($ville);
            }
        }
    
        $commune->save();
    
        return redirect()->back()->with('success', 'Commune mise à jour avec succès.');
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('commune_delete')) {
            return abort(401);
        }
        $commune = Commune::findOrFail($id);
        $commune->delete();

        return redirect()->back()->with('success', 'commune supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('commune_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Commune::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

}

<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreVilleRequest;
use App\Http\Requests\Admin\UpdateVilleRequest;

class VilleController extends Controller
{
    public function index()
    {
        if (! Gate::allows('ville_access')) {
            return abort(401);
        }

        $ville = Ville::orderBy('created_at', 'desc')->get();
        $pays = Pays::orderBy('created_at', 'desc')->get();
       
        $enteteContent = "ville";

        return view('superAdmin.ville.index', compact('ville','pays','enteteContent'));
    }

    public function store(StoreVilleRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingVille = Ville::where('libelle', $request->libelle)->first();
    
        if ($existingVille) {
            $errors["libelle"] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Ville::create([
            'libelle' => $request->libelle,
            'pays_id' => $request->pays_id
        ]);

        return redirect()->back()->with('success', 'ville enregistrée avec succès.');
        // Redirection avec un message de succès.
    }



    public function show($id)
    {
        if (! Gate::allows('Ville_view')) {
            return abort(401);
        }
        $ville = Ville::findOrFail($id);

        return view('superAdmin.ville.show', compact('ville'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('ville_edit')) {
            return abort(401);
        }
        $ville = Ville::findOrFail($id);

        return view('superAdmin.ville_edit.edit', compact('ville'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVilleRequest $request, $id)
    {
        if (!Gate::allows('ville_edit')) {
            return abort(401);
        }
    
        $ville = Ville::findOrFail($id);
    
        // Mettre à jour les champs de la ville
        $ville->libelle = $request->input('libelle');
    
        // Vérifier si l'utilisateur a sélectionné un pays différent
        $nouveauPaysId = $request->input('pays_id');
        if ($ville->pays_id != $nouveauPaysId) {
            // Mettre à jour la relation avec le nouveau pays
            $pays = Pays::find($nouveauPaysId);
            if ($pays) {
                $ville->pays()->associate($pays);
            }
        }
    
        $ville->save();
    
        return redirect()->back()->with('success', 'Ville mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('ville_delete')) {
            return abort(401);
        }
        $ville = Ville::findOrFail($id);
        $ville->delete();

        return redirect()->back()->with('success', 'ville supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('ville_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Ville::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

}

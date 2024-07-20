<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Commune;
use App\Models\Quartier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreQuartierRequest;
use App\Http\Requests\Admin\UpdateQuartierRequest;

class QuartierController extends Controller
{
    public function index()
    {
        if (! Gate::allows('quartier_access')) {
            return abort(401);
        }

        $quartier = Quartier::orderBy('created_at', 'desc')->get();
        $commune = Commune::orderBy('created_at', 'desc')->get();
       
        $enteteContent = "quartier";

        return view('superAdmin.quartier.index', compact('quartier','commune','enteteContent'));
    }

    public function store(StoreQuartierRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingQuartier = Quartier::where('libelle', $request->libelle)->first();
    
        if ($existingQuartier) {
            $errors["libelle"] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Quartier::create([
            'libelle' => $request->libelle,
            'commune_id' => $request->commune_id
        ]);

        return redirect()->back()->with('success', 'quartier enregistrée avec succès.');
        // Redirection avec un message de succès.
    }



    public function show($id)
    {
        if (! Gate::allows('quartier_view')) {
            return abort(401);
        }
        $quartier = Quartier::findOrFail($id);

        return view('superAdmin.quartier.show', compact('quartier'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('quartier_edit')) {
            return abort(401);
        }
        $quartier = Quartier::findOrFail($id);

        return view('superAdmin.quartier_edit.edit', compact('quartier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuartierRequest $request, $id)
    {
        if (!Gate::allows('quartier_edit')) {
            return abort(401);
        }
    
        $quartier = Quartier::findOrFail($id);
    
        // Mettre à jour les champs du quartier
        $quartier->libelle = $request->input('libelle');
    
        // Vérifier si l'utilisateur a sélectionné une commune différente
        $nouvelleCommuneId = $request->input('commune_id');
        if ($quartier->commune_id != $nouvelleCommuneId) {
            // Mettre à jour la relation avec la nouvelle commune
            $commune = Commune::find($nouvelleCommuneId);
            if ($commune) {
                $quartier->commune()->associate($commune);
            }
        }
    
        $quartier->save();
    
        return redirect()->back()->with('success', 'Quartier mis à jour avec succès.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('quartier_delete')) {
            return abort(401);
        }
        $quartier = Quartier::findOrFail($id);
        $quartier->delete();

        return redirect()->back()->with('success', 'quartier supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('quartier_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Quartier::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

}

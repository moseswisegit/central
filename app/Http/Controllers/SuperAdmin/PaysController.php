<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Pays;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StorePaysRequest;
use App\Http\Requests\Admin\UpdatePaysRequest;

class PaysController extends Controller
{

    public function index()
    {
        if (! Gate::allows('pays_access')) {
            return abort(401);
        }

        $pays = Pays::orderBy('created_at', 'desc')->get();
       
        $enteteContent = "Pays";

        return view('superAdmin.pays.index', compact('pays','enteteContent'));
    }

    public function store(StorePaysRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingPays = Pays::where('libelle', $request->libelle)->first();
    
        if ($existingPays) {
            $errors["libelle"] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Pays::create([
            'libelle' => $request->libelle,
        ]);

        return redirect()->back()->with('success', 'Pays enregistrée avec succès.');
        // Redirection avec un message de succès.
    }



    public function show($id)
    {
        if (! Gate::allows('pays_view')) {
            return abort(401);
        }
        $pays = Pays::findOrFail($id);

        return view('superAdmin.pays.show', compact('pays'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('pays_edit')) {
            return abort(401);
        }
        $pays = Pays::findOrFail($id);

        return view('superAdmin.pays_edit.edit', compact('pays'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaysRequest $request, $id)
    {
        if (! Gate::allows('pays_edit')) {
            return abort(401);
        }
        $pays = Pays::findOrFail($id);
        $pays->update($request->all());

        return redirect()->back()->with('success', 'Pays mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('pays_delete')) {
            return abort(401);
        }
        $pays = Pays::findOrFail($id);
        $pays->delete();

        return redirect()->back()->with('success', 'Pays supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('pays_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Pays::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

}

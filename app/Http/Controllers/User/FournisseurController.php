<?php

namespace App\Http\Controllers\User;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StorefournisseursRequest;
use App\Http\Requests\Admin\UpdatefournisseursRequest;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('fournisseur_access')) {
            return abort(401);
        }


        $fournisseurs = Fournisseur::orderBy('created_at', 'desc')->get();

        $enteteContent = "Fournisseur";

        return view('user.fournisseur.index', compact('fournisseurs','enteteContent'));
    }

    public function obtenirfournisseurs()
    {
        $fournisseurs = Fournisseur::orderBy('created_at', 'desc')->get();
        return response()->json($fournisseurs);
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
    public function store(StorefournisseursRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingFounisseur = Fournisseur::where('libelle', $request->libelle)->first();
    
        if ($existingFounisseur) {
            $errors['libelle'] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Fournisseur::create([
            'libelle' => $request->libelle,
            'adresse' => $request->adresse ? $request->adresse : "",
            'user_id'   => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Fournisseur enregistrée avec succès.');
        // Redirection avec un message de succès.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('fournisseur_view')) {
            return abort(401);
        }
        $fournisseur = Fournisseur::findOrFail($id);

        return view('user.fournisseur.show', compact('fournisseur'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('fournisseur_edit')) {
            return abort(401);
        }
        $fournisseur = Fournisseur::findOrFail($id);

        return view('user.fournisseur_edit.edit', compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatefournisseursRequest $request, $id)
    {
        if (! Gate::allows('fournisseur_edit')) {
            return abort(401);
        }
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update($request->all());

        return redirect()->back()->with('success', 'Fournisseur mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('fournisseur_delete')) {
            return abort(401);
        }
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->back()->with('success', 'Fournisseur supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('fournisseur_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = fournisseur::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }
}

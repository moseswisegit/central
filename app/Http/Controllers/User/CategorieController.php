<?php

namespace App\Http\Controllers\User;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('categorie_access')) {
            return abort(401);
        }


        $categories = Categorie::orderBy('created_at', 'desc')->get();


        $enteteContent = "Catégorie";

        return view('user.categorie.index', compact('categories','enteteContent'));
    }

    public function obtenirCategories()
    {
        $categories = Categorie::orderBy('created_at', 'desc')->get();
        return response()->json($categories);
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
    public function store(StoreCategoriesRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingCategory = Categorie::where('libelle', $request->libelle)->first();
    
        if ($existingCategory) {
            $errors['libelle'] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Categorie::create([
            'libelle' => $request->libelle,
            'user_id'   => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Catégorie enregistrée avec succès.');
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
        if (! Gate::allows('categorie_view')) {
            return abort(401);
        }
        $categorie = Categorie::findOrFail($id);

        return view('user.categorie.show', compact('categorie'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('categorie_edit')) {
            return abort(401);
        }
        $categorie = Categorie::findOrFail($id);

        return view('user.categorie_edit.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (! Gate::allows('categorie_edit')) {
            return abort(401);
        }
        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        return redirect()->back()->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('categorie_delete')) {
            return abort(401);
        }
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->back()->with('success', 'Catégorie supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('categorie_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Categorie::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }
}

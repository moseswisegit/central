<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Produits;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreProduitsRequest;
use App\Http\Requests\Admin\UpdateProduitsRequest;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('produits_access')) {
            return abort(401);
        }


        $currentDate = Carbon::now()->toDateString();
        $fournisseurs = Fournisseur::orderBy('created_at', 'desc')->get();
        $categories = Categorie::orderBy('created_at', 'desc')->get();
        $produits = Produits::orderBy('created_at', 'desc')->get();


        $enteteContent = "Produits";

        return view('user.produits.index', compact('categories','fournisseurs', 'produits','currentDate'));
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
   

    public function store(StoreProduitsRequest $request)
    {
        try {
           
            // Ajout du montant total aux données de la requête
            $data = $request->all();
            // Calcul du montant total
            $montant_total = $request->qte_recu * $request->prix_unitaire;
            $data['montant'] = $montant_total;
            $data['user_id'] = Auth::user()->id;
    
    
            // Vérifier s'il existe déjà un produit avec la même désignation
            $existingProduit = Produits::where('designation', $request->designation)
                ->where('categorie_id', $request->categorie_id)
                ->where('fournisseur_id', $request->fournisseur_id)
                ->first();
    
            if ($existingProduit) {
                return redirect()->back()->withErrors(['designation' => 'Une fiche produit avec cette désignation existe déjà.'])->withInput();
            }
    
            Produits::create($data);
            return redirect()->back()->with('success', 'Produits enregistrée avec succès.');
    
        } catch (QueryException $e) {
            // Gérer l'exception liée à la base de données (par exemple, violation de contrainte d'unicité)
            return redirect()->back()->withErrors(['database' => 'Une erreur de base de données s\'est produite.'])->withInput();
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('produits_view')) {
            return abort(401);
        }
        $produits = Produits::findOrFail($id);

        return view('user.produits.show', compact('produits'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('produits_edit')) {
            return abort(401);
        }
        $produits = Produits::findOrFail($id);

        return view('user.produits_edit.edit', compact('produits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduitsRequest $request, $id)
    {
        if (! Gate::allows('produits_edit')) {
            return abort(401);
        }
        $produits = Produits::findOrFail($id);
        $produits->update($request->all());

        return redirect()->back()->with('success', 'Produits mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('produits_delete')) {
            return abort(401);
        }
        $produits = Produits::findOrFail($id);
        $produits->delete();

        return redirect()->back()->with('success', 'Produits supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('produits_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Produits::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }
}

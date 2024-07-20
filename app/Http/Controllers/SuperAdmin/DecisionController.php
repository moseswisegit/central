<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Decision;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreDecisionRequest;
use App\Http\Requests\Admin\UpdateDecisionRequest;

class DecisionController extends Controller
{
    public function index()
    {
        if (! Gate::allows('decision_access')) {
            return abort(401);
        }

        $decisions = Decision::orderBy('created_at', 'desc')->get();
       
        $enteteContent = "Decision";

        return view('superAdmin.decision.index', compact('decisions','enteteContent'));
    }

    public function store(StoreDecisionRequest $request)
    {
        $errors = [];
    
        // Vérifier s'il existe déjà une catégorie avec le même libellé
        $existingDecision = Decision::where('libelle', $request->libelle)->first();
    
        if ($existingDecision) {
            $errors["libelle"] = ['Doublon de libellé.'];
        }
    
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            // Cela redirigera l'utilisateur vers la page précédente avec les erreurs affichées.
        }
    
        Decision::create([
            'libelle' => $request->libelle,
        ]);

        return redirect()->back()->with('success', 'Decision enregistrée avec succès.');
        // Redirection avec un message de succès.
    }


    public function show($id)
    {
        if (! Gate::allows('decision_view')) {
            return abort(401);
        }
        $decision = Decision::findOrFail($id);

        return view('superAdmin.decision.show', compact('decision'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     if (! Gate::allows('decision_edit')) {
    //         return abort(401);
    //     }
    //     $decision = Decision::findOrFail($id);

    //     return view('superAdmin.decion_edit.edit', compact('pays'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDecisionRequest $request, $id)
    {
        if (! Gate::allows('decision_edit')) {
            return abort(401);
        }
        $decision = Decision::findOrFail($id);
        $decision->update($request->all());

        return redirect()->back()->with('success', 'Decision mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('decision_delete')) {
            return abort(401);
        }
        $decision = Decision::findOrFail($id);
        $decision->delete();

        return redirect()->back()->with('success', 'Decision supprimer avec succès.');
    }


    public function massDestroy(Request $request)
    {
        if (! Gate::allows('decision_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Decision::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

}

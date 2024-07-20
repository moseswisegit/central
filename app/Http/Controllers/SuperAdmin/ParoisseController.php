<?php

namespace App\Http\Controllers\SuperAdmin;

use Exception;
use App\Models\Decision;
use App\Models\Paroisse;
use Illuminate\Http\Request;
use App\Models\Paroisse_decision;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class ParoisseController extends Controller
{
    public function generatePassword() {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
    
        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= '@2024';
    
        return str_shuffle($password);
    }

    public function generateUniqueChaine($column) {
        $prefix = '';
        switch ($column) {
            case 'chaine_paroisse':
                $prefix = 'P';
                break;
            case 'chaine_secretaire':
                $prefix = 'S';
                break;
            case 'chaine_mc':
                $prefix = 'M';
                break;
            default:
                $prefix = '';
                break;
        }
    
        do {
            $randomDigits = mt_rand(10000000, 99999999); // Génère un nombre aléatoire sur 8 chiffres
            $chaine = $prefix . $randomDigits;
        } while (DB::table('paroisse_decisions')->where($column, $chaine)->exists());
    
        return  $chaine;
    }
    

    public function index()
    {
        if (! Gate::allows('paroisse_access')) {
            return abort(401);
        }

        $paroisses = Paroisse::join('paroisse_decisions', 'paroisses.id', '=', 'paroisse_decisions.paroisse_id')
        ->join('decisions', 'paroisse_decisions.decision_id', '=', 'decisions.id')
        ->select('paroisses.*', 'paroisse_decisions.decision_id', 'decisions.libelle as decision','paroisse_decisions.chaine_paroisse')
        ->get();

        $decisions = Decision::all();

        $enteteContent = "Paroisses";

        return view('superAdmin.paroisse.index', compact('paroisses','decisions','enteteContent'));
    }

    public function show($id)
    {
        if (! Gate::allows('paroisse_view')) {
            return abort(401);
        }
        $paroisse = Paroisse::findOrFail($id);

        return view('user.paroisse.show', compact('paroisse'));
    }

    public function edit($id)
    {
        if (! Gate::allows('paroisse_edit')) {
            return abort(401);
        }
        $paroisse = Paroisse::findOrFail($id);

        return view('user.paroisse_edit.edit', compact('paroisse'));
    }

    public function update(UpdateParoissesRequest $request, $id)
    {
        if (! Gate::allows('paroisse_edit')) {
            return abort(401);
        }
        $paroisse = Paroisse::findOrFail($id);
        $paroisse->update($request->all());

        return redirect()->back()->with('success', 'Paroisse mise à jour avec succès.');
    }

    public function destroy($id)
    {
        if (! Gate::allows('paroisse_delete')) {
            return abort(401);
        }
        $paroisse = Paroisse::findOrFail($id);
        $paroisse->delete();

        return redirect()->back()->with('success', 'Paroisse supprimer avec succès.');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('paroisse_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Paroisse::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }

        return redirect()->back()->with('success', 'Suppressions effectuées avec succès.');

    }

    public function changeDecision($paroisseId, $decisionId)
    {
        try {
            $paroisse = Paroisse::findOrFail($paroisseId);
            $decision = Decision::findOrFail($decisionId);

            $chaine_paroisse = $this->generateUniqueChaine('chaine_paroisse');
            $chaine_secretaire = $this->generateUniqueChaine('chaine_secretaire');
            $chaine_mc = $this->generateUniqueChaine('chaine_mc');

            if ($decisionId == 2) {
                $mot_de_pass_paroisse = $this->generatePassword();
                $mot_de_pass_secretaire = $this->generatePassword();
                $mot_de_pass_mc = $this->generatePassword();

                $user_id_paroisse = DB::table('users')->insertGetId([
                    'name' => $chaine_paroisse,
                    'identifiant' => $chaine_paroisse,
                    'role_id' => 2,
                    'password' => Hash::make($mot_de_pass_paroisse)
                ]);
                
                $user_id_secretaire = DB::table('users')->insertGetId([
                    'name' => $chaine_secretaire,
                    'identifiant' => $chaine_secretaire,
                    'role_id' => 3,
                    'password' => Hash::make($mot_de_pass_secretaire)
                ]);
                
                $user_id_mc = DB::table('users')->insertGetId([
                    'name' => $chaine_mc,
                    'identifiant' => $chaine_mc,
                    'role_id' => 4,
                    'password' => Hash::make($mot_de_pass_mc)
                ]);

                DB::table('uts')->updateOrInsert([
                    'user_id' => $user_id_paroisse, 
                    'identifiant' => $chaine_paroisse,
                ], [
                    'password' => $mot_de_pass_paroisse, 
                ]);

                DB::table('uts')->updateOrInsert([
                    'user_id' => $user_id_secretaire, 
                    'identifiant' => $chaine_secretaire,
                ], [
                    'password' => $mot_de_pass_secretaire, 
                ]);

                DB::table('uts')->updateOrInsert([
                    'user_id' => $user_id_mc, 
                    'identifiant' => $chaine_mc,
                ], [
                    'password' => $mot_de_pass_mc, 
                ]);

            }

            DB::table('paroisse_decisions')->updateOrInsert(
                ['paroisse_id' => $paroisseId],
                [
                    'decision_id' => $decisionId, 
                    'chaine_paroisse' => $chaine_paroisse,
                    'chaine_secretaire' => $chaine_secretaire,
                    'chaine_mc' => $chaine_mc,

                ]
            );

            Log::info('Décision changée avec succès pour la paroisse ID: ' . $paroisseId);

            return response()->json(['success' => 'Décision changée avec succès']);
        } catch (QueryException $e) {
            Log::error('Erreur de base de données lors du changement de décision pour la paroisse ID: ' . $paroisseId . $e);
            return response()->json(['error' => 'Erreur de base de données'], 500);
        } catch (Exception $e) {
            Log::error('Une erreur est survenue lors du changement de décision pour la paroisse ID: ' . $paroisseId);
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParametreController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function sauvegardeParametre(Request $request)
    {
        try {
            // Récupérez l'ID de l'utilisateur créateur (vous devez définir cela en fonction de votre logique)
            $createdById = auth()->user()->id;
    
            // Récupérez les paramètres depuis la requête
            $selectedSettings = $request->input('settings');
    
            // Vérifiez si la session est vide, et si c'est le cas, stockez les paramètres dans la session
            if (empty(session('settings'))) {
                session(['settings' => $selectedSettings]);
            }
    
            // Comparaison des clés de $selectedSettings avec celles de la session
            foreach ($selectedSettings as $key => $value) {
                // Si la clé de $selectedSettings est vide et la clé correspondante dans la session contient des valeurs
                if (empty($value) && !empty(session('settings.' . $key))) {
                    // Remplacez la clé de $selectedSettings par celle de la session
                    $selectedSettings[$key] = session('settings.' . $key);
                } else {
                    // Mettez à jour la session avec la nouvelle valeur de $selectedSettings
                    session(['settings.' . $key => $value]);
                }
            }
    
            // Si sidebarLightColor contient des valeurs et sidebarDarkColor a des valeurs,
            // vérifiez si ces valeurs existent déjà en base de données
            if (!empty($selectedSettings['sidebarLightColor']) && !empty(session('settings.sidebarDarkColor'))) {
                $existingRecord = Parametre::where('sidebarDarkColor', $selectedSettings['sidebarDarkColor'])
                                            ->where('created_by_id', $createdById)
                                            ->first();
    
                if ($existingRecord) {
                    // Mettez sidebarDarkColor à null si la valeur existe en base de données
                    $existingRecord->update(['sidebarDarkColor' => null]);
                    session(['settings.sidebarDarkColor' => null]);
                }
            }
    
            // Répétez le même scénario pour l'inverse
            if (!empty($selectedSettings['sidebarDarkColor']) && !empty(session('settings.sidebarLightColor'))) {
                $existingRecord = Parametre::where('sidebarLightColor', $selectedSettings['sidebarLightColor'])
                                            ->where('created_by_id', $createdById)
                                            ->first();
    
                if ($existingRecord) {
                    // Mettez sidebarLightColor à null si la valeur existe en base de données
                    $existingRecord->update(['sidebarLightColor' => null]);
                    session(['settings.sidebarLightColor' => null]);
                }
            }
    
            // Ajoutez l'ID de l'utilisateur créateur aux paramètres
            $selectedSettings['created_by_id'] = $createdById;
    
            // Colonnes à vérifier pour l'existence
            $conditions = ['created_by_id' => $createdById];
    
            // Vérifiez si un enregistrement existe pour cet utilisateur
            $existingRecord = Parametre::where($conditions)->first();
    
            if ($existingRecord) {
                // Mettez à jour les paramètres si l'utilisateur est le créateur
                if ($existingRecord->created_by_id == $createdById) {
                    // Comparez les valeurs actuelles avec les nouvelles
                    $updatedFields = array_intersect_key($selectedSettings, $existingRecord->toArray());
    
                    // Mettez à jour uniquement les champs modifiés
                    $existingRecord->update($updatedFields);
                } else {
                    // Si l'utilisateur n'est pas le créateur, répondez avec une erreur
                    return response()->json(['message' => 'Unauthorized user for update'], 403);
                }
            } else {
                // Si aucun enregistrement n'existe, insérez les paramètres
                Parametre::create($selectedSettings);
            }
    
            // Répondez avec un message de succès
            return response()->json(['message' => 'Settings saved successfully']);
        } catch (\Exception $e) {
            Log::error("Error saving settings", ['context' => $e]);
    
            // En cas d'erreur, répondez avec un message d'erreur
            return response()->json(['message' => 'Error saving settings', 'error' => $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    

    

    public function getSettings()
    {
        $user = auth()->user(); // Récupérez l'utilisateur connecté
        $settings = Parametre::where('created_by_id', $user->id)->latest()->first();

        Log::info("testtttt",[$settings]);
        return response()->json($settings);
    }


    public function profile() {

        return view("admin.users.profile");
    }



}

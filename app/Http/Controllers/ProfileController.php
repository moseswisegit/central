<?php

namespace App\Http\Controllers;

use App\Models\Ut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom' => 'nullable|string',
            'prenom' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $user = Auth::user();

        // Obtenez l'UT associée à l'utilisateur
        $ut = $user->ut;

        if (!$ut) {
            // Si l'UT n'existe pas, créez-en une
            $ut = new Ut();
            $ut->user_id = $user->id;
        }

        // Vérifiez si les champs ont été modifiés avant de les mettre à jour
        if ($request->input('nom') !== $ut->nom) {
            $ut->nom = $request->input('nom');
        }

        if ($request->input('prenom') !== $ut->prenom) {
            $ut->prenom = $request->input('prenom');
        }

        if ($request->input('telephone') !== $ut->telephone) {
            $ut->telephone = $request->input('telephone');
        }

        if ($request->input('email') !== $ut->email) {
            $ut->email = $request->input('email');
        }

        if ($request->hasFile('profile_picture')) {
            // Enregistrez le nouveau chemin de l'image
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $ut->profile_picture = $imagePath;
        }

        // Si au moins un champ a été modifié, sauvegardez les changements
        if ($ut->isDirty()) {
            $ut->save();
        }

        session()->flash('success', 'Mise à jour effectuée avec succès');
        return back();
    }
}

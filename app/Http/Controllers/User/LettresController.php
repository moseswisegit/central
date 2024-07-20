<?php

namespace App\Http\Controllers\User;

use TCPDF;
use Carbon\Carbon;
use App\Models\Decharge;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class LettresController extends Controller
{
    public function decharge()
    {
        return view("user/lettres/Decharge/decharge");
    }

    public function genererLettre(Request $request)
    {
        $userId = Auth::id();

        // Validez les données fournies par l'utilisateur
        $request->validate([
            'nom_donneur' => 'required',
            'nom_receveur' => 'required',
            'date_emission' => 'required|date',
            'montant' => 'required',
            'motif'   => 'required'
        ]);
    
        // Ajoutez l'ID de l'utilisateur actuellement authentifié aux données de la requête
        $request->merge(['user_id' => Auth::user()->id]);
    
        // Utilisez firstOrCreate pour créer ou récupérer une instance existante de Decharge
        $time = Carbon::now()->format('YmdHis');
        $fileName = 'decharge-' . $userId . '-' . $time . '-' . Str::random(10) . '.pdf';
        $filePath = public_path('decharge/' . $fileName);

        $decharge = Decharge::firstOrCreate(
            [
                'nom_donneur' => $request->nom_donneur,
                'nom_receveur' => $request->nom_receveur,
                'date_emission' => $request->date_emission,
                'montant' => $request->montant,
                'motif' => $request->motif,
                'user_id' => Auth::user()->id,
                'url' => $filePath
            ],
            $request->all()
        );
    
        // Retournez la vue avec le contenu de la lettre
        return view('user.lettres.Decharge.decharge', [
            'envoie' => 1,
            'nom_receveur' => $decharge->nom_receveur,
            'date_emission' => $decharge->date_emission,
            'nom_donneur' => $decharge->nom_donneur,
            'montant' => $decharge->montant,
            'motif' => $decharge->motif,
            'url' => $decharge->url
            // Ajoutez d'autres attributs si nécessaire
        ]);
    }
    


    

    // public function generatePDF(Request $request)
    // {
    //     $content = html_entity_decode($request->input('content'));

    //     // Générer le PDF avec TCPDF
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //     $pdf->AddPage();
    //     $pdf->writeHTML($content, true, false, true, false, '');

    //     // Enregistrer le fichier PDF sur le serveur
    //     $time = Carbon::now()->format('YmdHis');
    //     $fileName = 'decharge-' . $time . '-' . Str::random(10) . '.pdf';
    //     $filePath = storage_path('app/public/decharge/' . $fileName);
    //     $pdf->Output($filePath, 'F');

    //     // Retourner le nom du fichier pour le téléchargement
    //     return response()->json(['file_name' => $fileName]);
    // }

    public function generatePDF(Request $request)
    {
        $content = html_entity_decode($request->input('content'));
        // Obtenir l'ID de l'utilisateur connecté
        $userId = Auth::id();
       
        // Générer le PDF avec TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->writeHTML($content, true, false, true, false, '');
    
        $url = $request->url; // L'URL complète obtenue à partir de la requête

        // Utiliser parse_url pour obtenir le chemin de l'URL
        $path = parse_url($url, PHP_URL_PATH);

        // Utiliser basename pour obtenir le nom du fichier à partir du chemin
        $fileName = basename($path);
        $filePath = public_path('decharge/' . $fileName);
        $pdf->Output($filePath, 'F');
    
        // Retourner le nom du fichier pour le téléchargement
        return response()->json(['file_name' => $fileName]);
    }
    




    public function downloadPDF($fileName)
    {
        $filePath = public_path('decharge/' . $fileName);

        // Vérifiez que le fichier existe sur le serveur avant de le télécharger
        if (file_exists($filePath)) {
            // Téléchargez le fichier PDF
            return response()->download($filePath, $fileName);
        } else {
            // Retournez une erreur 404 si le fichier n'existe pas
            abort(404);
        }
    }

    public static function getUserFiles()
    {
        $userId = auth()->user()->id;
        $files = DB::table('decharges')
                    ->where('user_id', $userId)
                    ->get();   


       
        return $files; // Renvoyer la liste des fichiers de l'utilisateur connecté avec les autres colonnes de la table decharges
    }
    


    


}

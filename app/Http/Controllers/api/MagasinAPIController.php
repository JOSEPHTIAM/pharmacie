<?php

namespace App\Http\Controllers\api;

use App\Models\Magasin;
use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Rules\GmailFormat;
use App\Rules\ContactUser;
use App\Rules\PasswordUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Rules\NoScriptOrCode;


class MagasinAPIController extends Controller
{

    
    // Pour enregistrer les magasins
    public function storeMagasin_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'stock_magasin' => ['required', 'integer', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
        
            // Génération du id_magasin unique
            $id_magasin = $this->generateUniqueCode();
            $res = Magasin::create(array_merge($request->all(), ['id_magasin' => $id_magasin]));
            DB::commit();
            
            return redirect('listeMagasins_administrateur')->with('success', 'Magasin enregistré avec success !');
        
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th instanceof \PDOException) {
                if ($th->errorInfo[1] == 1062) {
                    if (str_contains($th->errorInfo[2], 'user_contact_unique')) {
                        return redirect('error')->with('error', 'Contact deja existant ! Veuillez entrer un autre contact !');                    
                    }
                }
                return redirect('error')->with('error', 'Données uniques des champs !');
            }
            return redirect('error')->with('error', 'Il y a un enregistrement identique dans la base de donnees !');
        }
    }
    
    public function storeMagasin_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'stock_magasin' => ['required', 'integer', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
        
            // Génération du id_magasin unique
            $id_magasin = $this->generateUniqueCode();
            $res = Magasin::create(array_merge($request->all(), ['id_magasin' => $id_magasin]));
            DB::commit();
            
            return redirect('listeMagasins_agent')->with('success', 'Magasin enregistré avec success !');
        
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th instanceof \PDOException) {
                if ($th->errorInfo[1] == 1062) {
                    if (str_contains($th->errorInfo[2], 'user_contact_unique')) {
                        return redirect('error')->with('error', 'Contact deja existant ! Veuillez entrer un autre contact !');                    
                    }
                }
                return redirect('error')->with('error', 'Données uniques des champs !');
            }
            return redirect('error')->with('error', 'Il y a un enregistrement identique dans la base de donnees !');
        }
    }




    // Pour afficher les données dans la page web    
    public function show($id_magasin)
    {
        $magasin = Magasin::find($id_magasin);
        if ($magasin) {
            return response()->json($magasin, 200);
        }

        return response()->json([ 'Status' => 400, 'Message' => 'Magasin non trouvée !' ], 400);
    }




    
    // Pour accéder à l'ouverture des fichiers de modification
    public function editMagasin_administrateur($id_magasin)
    {
        $magasin = Magasin::findOrFail($id_magasin);
        return view('authentification.administrateur.magasin.editMagasin_administrateur', compact('magasin'));
    }

    public function editMagasin_agent($id_magasin)
    {
        $magasin = Magasin::findOrFail($id_magasin);
        return view('authentification.utilisateur.agent.edits.editMagasin_agent', compact('magasin'));
    }





    // Pour confirmer la modification les données dans la base de données
    public function updateMagasin_administrateur(Request $request, $id_magasin)
    {

        $magasin = Magasin::where('id_magasin', $id_magasin)->first();

        $request->validate([
            'stock_magasin' => ['integer', 'string', new NoScriptOrCode],         
        ]);

        $magasin->stock_magasin = $request->stock_magasin;
        
        $magasin->save();
        return redirect()->route('listeMagasins_administrateur')->with('success', 'Magasin modifié avec succès !');
    }

    public function updateMagasin_agent(Request $request, $id_magasin)
    {

        $magasin = Magasin::where('id_magasin', $id_magasin)->first();

        $request->validate([
            'stock_magasin' => ['integer', 'string', new NoScriptOrCode],         
        ]);

        $magasin->stock_magasin = $request->stock_magasin;
        
        $magasin->save();
        return redirect()->route('listeMagasins_agent')->with('success', 'Magasin modifié avec succès !');
    }





    // Pour supprimer les localisations
    public function destroyMagasin_administrateur($id_magasin)
    {
        try{
            Magasin::destroy($id_magasin); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeMagasins_administrateur')->with('success', 'Suppression du magasin réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression du magasin !');
        }
    }

    public function destroyMagasin_agent($id_magasin)
    {
        try{
            Magasin::destroy($id_magasin); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeMagasins_agent')->with('success', 'Suppression du magasin réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression du magasin !');
        }
    }

    public function destroyMagasin_client($id_magasin)
    {
        try{
            Magasin::destroy($id_magasin); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeMagasins_client')->with('success', 'Suppression du magasin réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_client')->with('error', 'Erreur lors de la suppression du magasin !');
        }
    }





    // Fonctions de recherche du cote Administrateur
    public function searchMagasin_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $magasins = Magasin::where("stock_magasin","like","%$request->keyword%")
        ->get();
        return view('authentification.administrateur.magasin.listeMagasins_administrateur', compact('magasins'));
    }

    public function searchMagasin_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $magasins = Magasin::where("stock_magasin","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.agent.listes.listeMagasins_agent', compact('magasins'));
    }

    public function searchMagasin_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $magasins = Magasin::where("stock_magasin","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.client.listeMagasins_client', compact('magasins'));
    }





    // Pour la génération des enregistrements des id_localisation automatiquement des Localisations.
    public function generateUniqueCode()
    {
        $code = 'MAG' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }  
    
}

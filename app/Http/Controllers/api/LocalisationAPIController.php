<?php

namespace App\Http\Controllers\api;

use App\Models\Localisation;
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


class LocalisationAPIController extends Controller
{
    
    // Pour enregistrer les localisations
    public function storeLocalisation_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'nom_localisation' => ['required', 'string', new NoScriptOrCode],
                'quartier_localisation' => ['required', 'string', new NoScriptOrCode],
                'ville_localisation' => ['required', 'string', new NoScriptOrCode],
                'pays_localisation' => ['required', 'string', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
        
            // Génération du id_localisation unique
            $id_localisation = $this->generateUniqueCode();
            $res = Localisation::create(array_merge($request->all(), ['id_localisation' => $id_localisation]));
            DB::commit();
            
            return redirect('listeLocalisations_administrateur')->with('success', 'Localisation enregistrée avec success !');
        
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
            return redirect('error')->with('error', 'Problème de liaison à la base de données !');
        }
    }
    
    public function storeLocalisation_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'nom_localisation' => ['required', 'string', new NoScriptOrCode],
                'quartier_localisation' => ['required', 'string', new NoScriptOrCode],
                'ville_localisation' => ['required', 'string', new NoScriptOrCode],
                'pays_localisation' => ['required', 'string', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
        
            // Génération du id_localisation unique
            $id_localisation = $this->generateUniqueCode();
            $res = Localisation::create(array_merge($request->all(), ['id_localisation' => $id_localisation]));
            DB::commit();
            
            return redirect('listeLocalisations_agent')->with('success', 'Localisation enregistrée avec success !');
        
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
    public function show($id_localisation)
    {
        $localisation = Localisation::find($id_localisation);
        if ($localisation) {
            return response()->json($localisation, 200);
        }

        return response()->json([ 'Status' => 400, 'Message' => 'Localisation non trouvée !' ], 400);
    }




    
    // Pour accéder à l'ouverture des fichiers de modification
    public function editLocalisation_administrateur($id_localisation)
    {
        $localisation = Localisation::findOrFail($id_localisation);
        return view('authentification.administrateur.localisation.editLocalisation_administrateur', compact('localisation'));
    }

    public function editLocalisation_agent($id_localisation)
    {
        $localisation = Localisation::findOrFail($id_localisation);
        return view('authentification.utilisateur.agent.edits.editLocalisation_agent', compact('localisation'));
    }





    // Pour confirmer la modification les données dans la base de données
    public function updateLocalisation_administrateur(Request $request, $id_localisation)
    {

        $localisation = Localisation::where('id_localisation', $id_localisation)->first();

        $request->validate([
            'nom_localisation' => ['required', 'string', new NoScriptOrCode],
            'quartier_localisation' => ['required', 'string', new NoScriptOrCode],
            'ville_localisation' => ['required', 'string', new NoScriptOrCode],
            'pays_localisation' => ['required', 'string', new NoScriptOrCode],            
        ]);

        $localisation->nom_localisation = $request->nom_localisation;
        $localisation->quartier_localisation = $request->quartier_localisation;
        $localisation->ville_localisation = $request->ville_localisation;
        $localisation->pays_localisation = $request->pays_localisation;

        $localisation->save();
        return redirect()->route('listeLocalisations_administrateur')->with('success', 'Localisation modifiée avec succès !');
    }

    public function updateLocalisation_agent(Request $request, $id_localisation)
    {

        $localisation = Localisation::where('id_localisation', $id_localisation)->first();

        $request->validate([
            'nom_localisation' => ['required', 'string', new NoScriptOrCode],
            'quartier_localisation' => ['required', 'string', new NoScriptOrCode],
            'ville_localisation' => ['required', 'string', new NoScriptOrCode],
            'pays_localisation' => ['required', 'string', new NoScriptOrCode],            
        ]);

        $localisation->nom_localisation = $request->nom_localisation;
        $localisation->quartier_localisation = $request->quartier_localisation;
        $localisation->ville_localisation = $request->ville_localisation;
        $localisation->pays_localisation = $request->pays_localisation;
        
        $localisation->save();
        return redirect()->route('listeLocalisations_agent')->with('success', 'Localisation modifiée avec succès !');
    }





    // Pour supprimer les localisations
    public function destroyLocalisation_administrateur($id_localisation)
    {
        try{
            Localisation::destroy($id_localisation); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeLocalisations_administrateur')->with('success', 'Suppression de la localisation réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de la localisation !');
        }
    }

    public function destroyLocalisation_agent($id_localisation)
    {
        try{
            Localisation::destroy($id_localisation); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeLocalisations_agent')->with('success', 'Suppression de la localisation réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression de la localisation !');
        }
    }

    public function destroyLocalisation_client($id_localisation)
    {
        try{
            Localisation::destroy($id_localisation); // Supprimer la localisation
            // Redirection avec un message de succès
            return redirect('listeLocalisations_client')->with('success', 'Suppression de la localisation réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_client')->with('error', 'Erreur lors de la suppression de la localisation !');
        }
    }





    // Fonctions de recherche du cote Administrateur
    public function searchLocalisation_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $localisations = Localisation::where("id_localisation","like","%$request->keyword%")
            ->orWhere("nom_localisation","like","%$request->keyword%")
            ->orWhere("quartier_localisation","like","%$request->keyword%")
            ->orWhere("ville_localisation","like","%$request->keyword%")
            ->orWhere("pays_localisation","like","%$request->keyword%")
        ->get();
        return view('authentification.administrateur.localisation.listeLocalisations_administrateur', compact('localisations'));
    }

    public function searchLocalisation_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $localisations = Localisation::where("id_localisation","like","%$request->keyword%")
            ->orWhere("nom_localisation","like","%$request->keyword%")
            ->orWhere("quartier_localisation","like","%$request->keyword%")
            ->orWhere("ville_localisation","like","%$request->keyword%")
            ->orWhere("pays_localisation","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.agent.listes.listeLocalisations_agent', compact('localisations'));
    }

    public function searchLocalisation_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $localisations = Localisation::where("id_localisation","like","%$request->keyword%")
            ->orWhere("nom_localisation","like","%$request->keyword%")
            ->orWhere("quartier_localisation","like","%$request->keyword%")
            ->orWhere("ville_localisation","like","%$request->keyword%")
            ->orWhere("pays_localisation","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.client.listeLocalisations_client', compact('localisations'));
    }





    // Pour la génération des enregistrements des id_localisation automatiquement des Localisations.
    public function generateUniqueCode()
    {
        $code = 'LOCAL' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }  

}

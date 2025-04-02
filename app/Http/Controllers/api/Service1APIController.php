<?php

namespace App\Http\Controllers\api;

use App\Models\Service1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Localisation;
use App\Models\Ordinateur;
use App\Models\Magasin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Rules\GmailFormat;
use App\Rules\ContactUser;
use App\Rules\PasswordUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoScriptOrCode;



class Service1APIController extends Controller
{

    // Pour enregistrer un service électromenager du coté administrateur
    public function storeService1_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'description_service' => ['nullable', 'string', new NoScriptOrCode],
                'prix_service' => ['required', 'integer', new NoScriptOrCode],
                'id_magasin' => 'required|string|exists:magasin,id_magasin',
                'matricule' => 'required|string|exists:user,matricule',
                'id_localisation' => 'required|string|exists:localisation,id_localisation',                
                'id_ordinateur' => 'nullable|string|exists:ordinateur,id_ordinateur',                
            ];                       

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_service
            $total_service = $request->prix_service * $stock_magasin;
            
            // Génération du id_service1 unique
            $id_service1 = $this->generateUniqueCode();
            $res = Service1::create(array_merge($request->all(), [
                'id_service1' => $id_service1,
                'total_service' => $total_service
            ]));
            DB::commit();

            //return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
            return redirect('listeServices_administrateur')->with('success', 'Service ordinateur enregistré avec succès !')->with('id_service1', $id_service1);

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

    public function storeService1_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'description_service' => ['nullable', 'string', new NoScriptOrCode],
                'prix_service' => ['required', 'integer', new NoScriptOrCode],
                'id_magasin' => 'required|string|exists:magasin,id_magasin',
                'matricule' => 'required|string|exists:user,matricule',
                'id_localisation' => 'required|string|exists:localisation,id_localisation',                
                'id_ordinateur' => 'nullable|string|exists:ordinateur,id_ordinateur',                
            ];                       

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_service
            $total_service = $request->prix_service * $stock_magasin;

            // Génération du id_service1 unique
            $id_service1 = $this->generateUniqueCode();
            $res = Service1::create(array_merge($request->all(), [
                'id_service1' => $id_service1,
                'total_service' => $total_service
            ]));
            DB::commit();
            

            //return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
            return redirect('listeServices_agent')->with('success', 'Service ordinateur enregistré avec succès !')->with('id_service1', $id_service1);

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


    // Pour la génération des enregistrements des id_service automatiquement des services.
    public function generateUniqueCode()
    {
        $code = 'SERVC' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    // Pour régler la casse des caractères de toutes les interfaces.
    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }




    // Pour accéder à l'ouverture des fichiers de modification
    public function editService1_administrateur($id_service1)
    {
        $service1 = Service1::findOrFail($id_service1);
        return view('authentification.administrateur.service.editService1_administrateur', compact('service1'));
    }

    // Pour accéder à l'ouverture des fichiers de modification
    public function editService1_agent($id_service1)
    {
        $service1 = Service1::findOrFail($id_service1);
        return view('authentification.utilisateur.edits.editService1_agent', compact('service1'));
    }




    // Pour confirmer la modification les données dans la base de données
    public function updateService1_administrateur(Request $request, $id_service1)
    {

        $service1 = Service1::where('id_service1', $id_service1)->first();

        $request->validate([
            'description_service' => ['nullable', 'string', new NoScriptOrCode],
            'prix_service' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',                
            'id_ordinateur' => 'nullable|string|exists:ordinateur,id_ordinateur',              
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_service
        $total_service = $request->prix_service * $stock_magasin;

        $service1->description_service = $request->description_service;
        $service1->prix_service = $request->prix_service;
        $service1->total_service = $request->total_service;
        $service1->id_magasin = $request->id_magasin;
        $service1->matricule = $request->matricule;
        $service1->id_localisation = $request->id_localisation;
        $service1->id_ordinateur = $request->id_ordinateur;

        $service1->save();
        return redirect()->route('listeServices_administrateur')->with('success', 'Service ordinateur modifié avec succès !');
    }

    public function updateService1_agent(Request $request, $id_service1)
    {

        $service1 = Service1::where('id_service1', $id_service1)->first();

        $request->validate([
            'description_service' => ['nullable', 'string', new NoScriptOrCode],
            'prix_service' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',                
            'id_ordinateur' => 'nullable|string|exists:ordinateur,id_ordinateur',              
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_service
        $total_service = $request->prix_service * $stock_magasin;

        $service1->description_service = $request->description_service;
        $service1->prix_service = $request->prix_service;
        $service1->total_service = $request->total_service;
        $service1->id_magasin = $request->id_magasin;
        $service1->matricule = $request->matricule;
        $service1->id_localisation = $request->id_localisation;
        $service1->id_ordinateur = $request->id_ordinateur;

        $service1->save();
        return redirect()->route('listeServices_agent')->with('success', 'Service ordinateur modifié avec succès !');
    }




    // Pour supprimer les services
    public function destroyService1_administrateur($id_service1)
    {
        try{
            Service1::destroy($id_service1); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeServices_administrateur')->with('success', 'Suppression du service ordinateur réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression du service ordiateur !');
        }
    }

    public function destroyService1_agent($id_service1)
    {
        try{
            Service1::destroy($id_service1); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeServices_agent')->with('success', 'Suppression du service ordinateur réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression du service ordinateur !');
        }
    }




     
    // Fonctions de recherche du cote Administrateur
    public function searchService1_administrateur(Request $request)
    {
        $keyword1 = $request->input('keyword1');
        $services1 = Service1::where("id_service1","like","%$request->keyword1%")
            ->orWhere("description_service","like","%$request->keyword1%")
            ->orWhere("prix_service","like","%$request->keyword1%")
        ->get();
        return view('authentification.administrateur.service.listeServices_administrateur', compact('services1'));
    }

    public function searchService1_agent(Request $request)
    {
        $keyword1 = $request->input('keyword1');
        $services1 = Service1::where("id_service1","like","%$request->keyword1%")
            ->orWhere("description_service","like","%$request->keyword1%")
            ->orWhere("prix_service","like","%$request->keyword1%")
        ->get();
        return view('authentification.utilisateur.agent.listes.listeServices_agent', compact('services1'));
    }

    public function searchService1_client(Request $request)
    {
        $keyword1 = $request->input('keyword1');
        $services1 = Service1::where("description_service","like","%$request->keyword1%")
            ->orWhere("prix_service","like","%$request->keyword1%")
        ->get();
        return view('authentification.utilisateur.client.service.listeServiceOrdinateur', compact('services1'));
    }




    
    // Pour les ouvertures des données détaillées
    public function OpenService1_administrateur($id_service1)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service1 = Service1::where('id_service1', $id_service1)
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.service.OpenService1_administrateur', ['service1' => $service1]);
    }

    public function OpenService1_agent($id_service1)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service1 = Service1::where('id_service1', $id_service1)
                    ->firstOrFail(); 
                    
        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.utilisateur.agent.opens.OpenService1_agent', ['service1' => $service1]);
    }

    public function OpenService1_client($id_service1)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service1 = Service1::where('id_service1', $id_service1)
                    ->firstOrFail(); 
                    
        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.utilisateur.client.service.OpenService1_client', ['service1' => $service1]);
    }


}

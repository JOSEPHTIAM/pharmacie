<?php

namespace App\Http\Controllers\api;

use App\Models\Service;
use App\Models\User;
use App\Models\Localisation;
use App\Models\Magasin;
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
use Illuminate\Support\Facades\Validator;
use App\Rules\NoScriptOrCode;


class ServiceAPIController extends Controller
{

    // Pour enregistrer un service électromenager du coté administrateur
    public function storeService_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'description_service' => ['nullable', 'string', new NoScriptOrCode],
                'prix_service' => ['required', 'integer', new NoScriptOrCode],
                'id_magasin' => 'required|string|exists:magasin,id_magasin',
                'matricule' => 'required|string|exists:user,matricule',
                'id_localisation' => 'required|string|exists:localisation,id_localisation',
                'id_electromenager' => 'nullable|string|exists:electromenager,id_electromenager',
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_service
            $total_service = $request->prix_service * $stock_magasin;

            // Génération du id_service unique
            $id_service = $this->generateUniqueCode();
            $res = Service::create(array_merge($request->all(), [
                'id_service' => $id_service,
                'total_service' => $total_service
            ]));
            DB::commit();

            return redirect('listeServices_administrateur')->with('success', 'Service électromenager enregistré avec succès !')->with('id_service', $id_service);

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

    public function storeService_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'description_service' => ['nullable', 'string', new NoScriptOrCode],
                'prix_service' => ['required', 'integer', new NoScriptOrCode],
                'id_magasin' => 'required|string|exists:magasin,id_magasin',
                'matricule' => 'required|string|exists:user,matricule',
                'id_localisation' => 'required|string|exists:localisation,id_localisation',
                'id_electromenager' => 'nullable|string|exists:electromenager,id_electromenager',
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_service
            $total_service = $request->prix_service * $stock_magasin;

            // Génération du id_service unique
            $id_service = $this->generateUniqueCode();
            $res = Service::create(array_merge($request->all(), [
                'id_service' => $id_service,
                'total_service' => $total_service
            ]));
            DB::commit();

            return redirect('listeServices_agent')->with('success', 'Service électromenager enregistré avec succès !')->with('id_service', $id_service);

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
        $code = 'SERV' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
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
    public function editService_administrateur($id_service)
    {
        $service = Service::findOrFail($id_service);
        return view('authentification.administrateur.service.editService_administrateur', compact('service'));
    }

    // Pour accéder à l'ouverture des fichiers de modification
    public function editService_agent($id_service)
    {
        $service = Service::findOrFail($id_service);
        return view('authentification.utilisateur.edits.editService_agent', compact('service'));
    }

    // Pour confirmer la modification les données dans la base de données
    public function updateService_administrateur(Request $request, $id_service)
    {
        $service = Service::where('id_service', $id_service)->first();

        $request->validate([
            'description_service' => ['nullable', 'string', new NoScriptOrCode],
            'prix_service' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',
            'id_electromenager' => 'nullable|string|exists:electromenager,id_electromenager',
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_service
        $total_service = $request->prix_service * $stock_magasin;

        $service->description_service = $request->description_service;
        $service->prix_service = $request->prix_service;
        $service->total_service = $total_service;
        $service->id_magasin = $request->id_magasin;
        $service->matricule = $request->matricule;
        $service->id_localisation = $request->id_localisation;
        $service->id_electromenager = $request->id_electromenager;

        $service->save();
        
        return redirect()->route('listeServices_administrateur')->with('success', 'Service électromenager modifié avec succès !');
    }

    public function updateService_agent(Request $request, $id_service)
    {
        $service = Service::where('id_service', $id_service)->first();

        $request->validate([
            'description_service' => ['nullable', 'string', new NoScriptOrCode],
            'prix_service' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',
            'id_electromenager' => 'nullable|string|exists:electromenager,id_electromenager',
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_service
        $total_service = $request->prix_service * $stock_magasin;

        $service->description_service = $request->description_service;
        $service->prix_service = $request->prix_service;
        $service->total_service = $total_service;
        $service->id_magasin = $request->id_magasin;
        $service->matricule = $request->matricule;
        $service->id_localisation = $request->id_localisation;
        $service->id_electromenager = $request->id_electromenager;

        $service->save();
        return redirect()->route('listeServices_agent')->with('success', 'Service électromenager modifié avec succès !');
    }

    // Pour supprimer les services
    public function destroyService_administrateur($id_service)
    {
        try {
            Service::destroy($id_service); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeServices_administrateur')->with('success', 'Suppression du service électromenager réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression du service électromenager !');
        }
    }

    public function destroyService_agent($id_service)
    {
        try {
            Service::destroy($id_service); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeServices_agent')->with('success', 'Suppression du service électromenager réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression du service électromenager !');
        }
    }

    // Fonctions de recherche du cote Administrateur
    public function searchService_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $services = Service::where("id_service", "like", "%$request->keyword%")
            ->orWhere("description_service", "like", "%$request->keyword%")
            ->orWhere("prix_service", "like", "%$request->keyword%")
            ->get();
        return view('authentification.administrateur.service.listeServices_administrateur', compact('services'));
    }

    public function searchService_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $services = Service::where("id_service", "like", "%$request->keyword%")
            ->orWhere("description_service", "like", "%$request->keyword%")
            ->orWhere("prix_service", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.agent.listes.listeServices_agent', compact('services'));
    }

    public function searchService_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $services = Service::where("description_service", "like", "%$request->keyword%")
            ->orWhere("prix_service", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.client.service.listeServiceElectronique', compact('services'));
    }

    // Pour les ouvertures des données détaillées
    public function OpenService_administrateur($id_service)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service = Service::where('id_service', $id_service)
            ->firstOrFail();

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.service.OpenService_administrateur', ['service' => $service]);
    }

    public function OpenService_agent($id_service)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service = Service::where('id_service', $id_service)
            ->firstOrFail();

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.utilisateur.agent.opens.OpenService_agent', ['service' => $service]);
    }

    public function OpenService_client($id_service)
    {
        // Récupérer l'utilisateur avec le id_service spécifié et vérifier qu'il est un service
        $service = Service::where('id_service', $id_service)
            ->firstOrFail();

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.utilisateur.client.service.OpenService_client', ['service' => $service]);
    }

}

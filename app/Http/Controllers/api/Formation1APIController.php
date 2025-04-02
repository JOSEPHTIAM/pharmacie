<?php

namespace App\Http\Controllers\api;

use App\Models\Formation1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Localisation;
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
use Illuminate\Support\Facades\Storage;



class Formation1APIController extends Controller
{

    // Pour la génération des enregistrements des id_formation automatiquement des formations.
    public function generateUniqueCode()
    {
        $code = 'FMTP' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    // Pour régler la casse des caractères de toutes les interfaces.
    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }

    // Pour enregistrer une Formation vidéo du côté administrateur
    public function storeFormation1_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'nom_formation' => ['required', 'string', new NoScriptOrCode],
                'description_formation' => ['nullable', 'string', new NoScriptOrCode],
                'prix_formation' => ['required', 'integer', new NoScriptOrCode],
                'id_magasin' => 'required|string|exists:magasin,id_magasin',
                'matricule' => 'required|string|exists:user,matricule',
                'id_localisation' => 'required|string|exists:localisation,id_localisation',
                'pdf_formation' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
            
            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Conditions pour l'image
            if ($request->hasFile('pdf_formation')) {
                $pdf_formation = $request->file('pdf_formation');
                $name = time().'.'.$pdf_formation->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $pdf_formation->move($destinationPath, $name);
                $request->merge(['pdf_formation' => 'storage/images/'.$name]);
            }

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_formation
            $total_formation = $request->prix_formation * $stock_magasin;

            // Génération du id_formation1 unique
            $id_formation1 = $this->generateUniqueCode();
            $res = Formation1::create(array_merge($request->all(), [
                'id_formation1' => $id_formation1,
                'total_formation' => $total_formation,
                'pdf_formation'=> $name
            ]));

            DB::commit();

            return redirect('listeFormations_administrateur')->with('success', 'Formation PDF enregistrée avec succès !')->with('id_formation1', $id_formation1);

        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th instanceof \PDOException) {
                if ($th->errorInfo[1] == 1062) {
                    return redirect('error')->with('error', 'Données uniques des champs !');
                }
                return redirect('error')->with('error', 'Problème de liaison à la base de données !');
            }
            return redirect('error')->with('error', 'Problème de liaison à la base de données !');
        }
    }

    public function storeFormation1_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'nom_formation' => ['required', 'string', new NoScriptOrCode],
                'description_formation' => ['nullable', 'string', new NoScriptOrCode],
                'prix_formation' => ['required', 'integer', new NoScriptOrCode],
                'niveau_formation' => ['required', 'integer', new NoScriptOrCode],
                'matricule' => 'required|string|exists:users,matricule',
                'pdf_formation' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Calculer le total_formation
            $total_formation = $request->prix_formation * $request->niveau_formation;

            // Conditions pour l'image
            if ($request->hasFile('pdf_formation')) {
                $image = $request->file('pdf_formation');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['pdf_formation' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
                    
            // Génération du id_formation unique
            $id_formation1 = $this->generateUniqueCode();
            $res = Formation1::create(array_merge($request->all(), [
                'id_formation1' => $id_formation1,
                'total_formation' => $total_formation,
                'pdf_formation'=> $name
            ]));            

            DB::commit();

            return redirect('listeFormations_agent')->with('success', 'Formation PDF enregistrée avec succès !')->with('id_formation1', $id_formation1);

        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th instanceof \PDOException) {
                if ($th->errorInfo[1] == 1062) {
                    return redirect('error')->with('error', 'Données uniques des champs !');
                }
                return redirect('error')->with('error', 'Problème de liaison à la base de données !');
            }
            return redirect('error')->with('error', 'Problème de liaison à la base de données !');
        }
    }

    // Pour accéder à l'ouverture des fichiers de modification
    public function editFormation1_administrateur($id_formation1)
    {
        $formation1 = Formation1::findOrFail($id_formation1);
        return view('authentification.administrateur.Formation.editFormation1_administrateur', compact('formation1'));
    }

    // Pour accéder à l'ouverture des fichiers de modification
    public function editFormation1_agent($id_formation1)
    {
        $formation1 = Formation1::findOrFail($id_formation1);
        return view('authentification.utilisateur.edits.editFormation1_agent', compact('formation1'));
    }

    // Pour confirmer la modification des données dans la base de données
    public function updateFormation1_administrateur(Request $request, $id_formation1)
    {
        $formation1 = Formation1::where('id_formation1', $id_formation1)->first();

        $request->validate([
            'nom_formation' => ['required', 'string', new NoScriptOrCode],
            'description_formation' => ['nullable', 'string', new NoScriptOrCode],
            'prix_formation' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_formation
        $total_formation = $request->prix_formation * $stock_magasin;

        $formation1->description_formation = $request->description_formation;
        $formation1->prix_formation = $request->prix_formation;
        $formation1->total_formation = $total_formation;
        $formation1->id_magasin = $request->id_magasin;
        $formation1->matricule = $request->matricule;
        $formation1->id_localisation = $request->id_localisation;

        $formation1->save();

        return redirect()->route('listeFormations_administrateur')->with('success', 'Formation pdf modifiée avec succès !');
    }

    public function updateFormation1_agent(Request $request, $id_formation1)
    {
        $formation1 = Formation1::where('id_formation1', $id_formation1)->first();

        $request->validate([
            'nom_formation' => ['required', 'string', new NoScriptOrCode],
            'description_formation' => ['nullable', 'string', new NoScriptOrCode],
            'prix_formation' => ['required', 'integer', new NoScriptOrCode],
            'id_magasin' => 'required|string|exists:magasin,id_magasin',
            'matricule' => 'required|string|exists:user,matricule',
            'id_localisation' => 'required|string|exists:localisation,id_localisation',
        ]);

        // Récupérer le stock_magasin en fonction de id_magasin
        $magasin = Magasin::findOrFail($request->id_magasin);
        $stock_magasin = $magasin->stock_magasin;

        // Calculer le total_formation
        $total_formation = $request->prix_formation * $stock_magasin;

        $formation1->description_formation = $request->description_formation;
        $formation1->prix_formation = $request->prix_formation;
        $formation1->total_formation = $total_formation;
        $formation1->id_magasin = $request->id_magasin;
        $formation1->matricule = $request->matricule;
        $formation1->id_localisation = $request->id_localisation;

        $formation1->save();

        return redirect()->route('listeFormations_agent')->with('success', 'Formation vidéo modifiée avec succès !');
    }

    // Pour supprimer les formations
    public function destroyFormation1_administrateur($id_formation1)
    {
        try {
            Formation1::destroy($id_formation1); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeFormations_administrateur')->with('success', 'Suppression de la formation pdf réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de la formation pdf !');
        }
    }

    public function destroyFormation1_agent($id_formation1)
    {
        try {
            Formation1::destroy($id_formation1); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeFormations_agent')->with('success', 'Suppression de la formation pdf réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression de la formation pdf !');
        }
    }

    // Fonctions de recherche du côté Administrateur
    public function searchFormation1_administrateur(Request $request)
    {
        $keyword1 = $request->input('keyword');
        $formations1 = Formation1::where("id_formation1", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.administrateur.Formation.listeFormations_administrateur', compact('formations1'));
    }

    public function searchFormation1_agent(Request $request)
    {
        $keyword1 = $request->input('keyword');
        $formations1 = Formation1::where("id_formation1", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.agent.listes.listeFormations_agent', compact('formations1'));
    }

    public function searchFormation1_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $formations1 = Formation1::where("id_formation1", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.client.listeFormations_client', compact('formations1'));
    }


    
    // Pour les ouvertures des données détaillées
    public function OpenFormation1_administrateur($id_formation1)
    {
        // Récupérer la formation avec le id_formation spécifié
        $formation1 = Formation1::where('id_formation1', $id_formation1)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.administrateur.Formation.OpenFormation_administrateur', ['formation1' => $formation1]);
    }

    public function OpenFormation1_agent($id_formation1)
    {
        // Récupérer la formation avec le id_formation spécifié
        $formation1 = Formation1::where('id_formation1', $id_formation1)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.utilisateur.agent.opens.OpenFormation_agent', ['formation1' => $formation1]);
    }

    public function OpenFormation1_client($id_formation1)
    {
        // Récupérer la formation avec le id_formation spécifié
        $formation1 = Formation1::where('id_formation1', $id_formation1)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.utilisateur.client.OpenFormation_client', ['formation1' => $formation1]);
    }

}

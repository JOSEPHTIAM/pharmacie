<?php

namespace App\Http\Controllers\api;

use App\Models\Formation;
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

use FFMpeg\FFProbe;



class FormationAPIController extends Controller
{
    
    // Pour la génération des enregistrements des id_formation automatiquement des formations.
    public function generateUniqueCode()
    {
        $code = 'FMT' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
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
    public function storeFormation_administrateur(Request $request)
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
                'video_formation' => 'nullable|video|mimes:mp4,mov,avi,flv|max:20480', // Accepter uniquement les vidéos
            ];
            
            // Validation du formulaire
            $this->validate($request, $rules);


            if ($request->hasFile('image_ordinateur')) {
                $image_ordinateur = $request->file('image_ordinateur');
                $name = time().'.'.$image_ordinateur->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image_ordinateur->move($destinationPath, $name);
                $request->merge(['image_ordinateur' => 'storage/images/'.$name]);
            }

            DB::beginTransaction();

            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;
            
            // Condition pour la vidéo compris enrte 01 seconde et 05 heures de temps
            if ($request->hasFile('video_formation')) {
                $video = $request->file('video_formation');
                $name = time().'.'.$video->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/videos');
                $video->move($destinationPath, $name);

                // Vérification de la durée de la vidéo
                $videoPath = $destinationPath.'/'.$name;
                $ffprobe = FFProbe::create();
                $duration = $ffprobe->format($videoPath)->get('duration');

                // Condition de la Munitation
                if ($duration < 1 || $duration > 18000) {
                    throw new \Exception('La durée de la vidéo doit être comprise entre 1 seconde et 5 heures (18 000 secondes).');
                }

                $request->merge(['video_formation' => 'storage/videos/'.$name]);
            }

            
            // Calculer le total_formation
            $total_formation = $request->prix_formation * $stock_magasin;

            // Génération du id_formation unique
            $id_formation = $this->generateUniqueCode();
            $res = Formation::create(array_merge($request->all(), [
                'id_formation' => $id_formation,
                'total_formation' => $total_formation, 
                'video_formation'=> $name,
            ]));

            DB::commit();

            return redirect('listeFormations_administrateur')->with('success', 'Formation vidéo enregistrée avec succès !');

        } catch (\Throwable $th) {
            DB::rollBack();
            if ($th instanceof \PDOException) {
                if ($th->errorInfo[1] == 1062) {
                    return redirect('error')->with('error', 'Données uniques des champs !');
                }
                return redirect('error')->with('error', 'Problème de liaison à la base de données !');
            }
            return redirect('error')->with('error', 'Aucune connexion à la base de données !');
        }
    }

    public function storeFormation_agent(Request $request)
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
                'video_formation' => 'nullable|mimes:mp4,mov,avi,flv|max:20480', // Accepter uniquement les vidéos
                ];
            
            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Condition pour la vidéo compris enrte 01 seconde et 05 heures de temps
            if ($request->hasFile('video_formation')) {
                $video = $request->file('video_formation');
                $name = time() . '.' . $video->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/videos');
                $video->move($destinationPath, $name);

                // Vérification de la durée de la vidéo
                $videoPath = $destinationPath . '/' . $name;
                $ffprobe = FFProbe::create();
                $duration = $ffprobe->format($videoPath)->get('duration');

                // Condition de la Munitation
                if ($duration < 1 || $duration > 18000) {
                    throw new \Exception('La durée de la vidéo doit être comprise entre 1 seconde et 5 heures (18 000 secondes).');
                }

                $request->merge(['video_formation' => 'storage/videos/' . $name]);
            }

            
            // Récupérer le stock_magasin en fonction de id_magasin
            $magasin = Magasin::findOrFail($request->id_magasin);
            $stock_magasin = $magasin->stock_magasin;

            // Calculer le total_formation
            $total_formation = $request->prix_formation * $stock_magasin;

            // Génération du id_formation unique
            $id_formation = $this->generateUniqueCode();
            $res = Formation::create(array_merge($request->all(), [
                'id_formation' => $id_formation,
                'total_formation' => $total_formation, 
                'video_formation'=> $name,
            ]));

            DB::commit();

            return redirect('listeFormations_agent')->with('success', 'Formation vidéo enregistrée avec succès !');

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
    public function editFormation_administrateur($id_formation)
    {
        $formation = Formation::findOrFail($id_formation);
        return view('authentification.administrateur.Formation.editFormation_administrateur', compact('formation'));
    }

    // Pour accéder à l'ouverture des fichiers de modification
    public function editFormation_agent($id_formation)
    {
        $formation = Formation::findOrFail($id_formation);
        return view('authentification.utilisateur.edits.editFormation_agent', compact('formation'));
    }

    // Pour confirmer la modification des données dans la base de données
    public function updateFormation_administrateur(Request $request, $id_formation)
    {
        $formation = Formation::where('id_formation', $id_formation)->first();

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

        $formation->description_formation = $request->description_formation;
        $formation->prix_formation = $request->prix_formation;
        $formation->total_formation = $total_formation;
        $formation->id_magasin = $request->id_magasin;
        $formation->matricule = $request->matricule;
        $formation->id_localisation = $request->id_localisation;

        $formation->save();

        return redirect()->route('listeFormations_administrateur')->with('success', 'Formation vidéo modifiée avec succès !');
    }

    public function updateFormation_agent(Request $request, $id_formation)
    {
        $formation = Formation::where('id_formation', $id_formation)->first();

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

        $formation->description_formation = $request->description_formation;
        $formation->prix_formation = $request->prix_formation;
        $formation->total_formation = $total_formation;
        $formation->id_magasin = $request->id_magasin;
        $formation->matricule = $request->matricule;
        $formation->id_localisation = $request->id_localisation;

        $formation->save();

        return redirect()->route('listeFormations_agent')->with('success', 'Formation vidéo modifiée avec succès !');
    }

    // Pour supprimer les formations
    public function destroyFormation_administrateur($id_formation)
    {
        try {
            Formation::destroy($id_formation); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeFormations_administrateur')->with('success', 'Suppression de la formation vidéo réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de la formation vidéo !');
        }
    }

    public function destroyFormation_agent($id_formation)
    {
        try {
            Formation::destroy($id_formation); // Supprimer la service
            // Redirection avec un message de succès
            return redirect('listeFormations_agent')->with('success', 'Suppression de la formation vidéo réussie !');
        } catch (\Throwable $th) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de la formation vidéo !');
        }
    }

    // Fonctions de recherche du côté Administrateur
    public function searchFormation_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $formations = Formation::where("id_formation", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.administrateur.Formation.listeFormations_administrateur', compact('formations'));
    }

    public function searchFormation_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $formations = Formation::where("id_formation", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.agent.listes.listeFormations_agent', compact('formations'));
    }

    public function searchFormation_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $formations = Formation::where("id_formation", "like", "%$request->keyword%")
            ->orWhere("description_formation", "like", "%$request->keyword%")
            ->orWhere("nom_formation", "like", "%$request->keyword%")
            ->orWhere("prix_formation", "like", "%$request->keyword%")
            ->get();
        return view('authentification.utilisateur.client.listeFormations_client', compact('formations'));
    }


    
    // Pour les ouvertures des données détaillées
    public function OpenFormation_administrateur($id_formation)
    {
        // Récupérer la formation avec le id_formation spécifié
        $formation = Formation::where('id_formation', $id_formation)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.administrateur.Formation.OpenFormation_administrateur', ['formation' => $formation]);
    }

    public function OpenFormation_agent($id_formation)
    {
        // Récupérer la formation avec le id_formation spécifié
        $formation = Formation::where('id_formation', $id_formation)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.utilisateur.agent.opens.OpenFormation_agent', ['formation' => $formation]);
    }

    public function OpenFormation_client($id_formation)
    {
      
        // Récupérer la formation avec le id_formation spécifié
        $formation = Formation::where('id_formation', $id_formation)
            ->firstOrFail();

        // Passer la formation à la vue
        return view('authentification.utilisateur.client.OpenFormation_client', ['formation' => $formation]);
    }

}

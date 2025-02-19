<?php

namespace App\Http\Controllers\api;

use App\Models\Ordinateur;
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



class OrdinateurAPIController extends Controller
{
    
    // Pour enregistrer les ordinateur
    public function storeOrdinateur_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'image_ordinateur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom_ordinateur' => ['required', 'string', new NoScriptOrCode],
                'processeur' => ['required', 'string', new NoScriptOrCode],
                'disque' => ['required', 'string', new NoScriptOrCode],
                'ram' => ['required', 'integer', new NoScriptOrCode],
                'core' => ['required', 'string', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            if ($request->hasFile('image_ordinateur')) {
                $image_ordinateur = $request->file('image_ordinateur');
                $name = time().'.'.$image_ordinateur->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image_ordinateur->move($destinationPath, $name);
                $request->merge(['image_ordinateur' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
                    
            // Génération du id_ordinateur unique
            $id_ordinateur = $this->generateUniqueCode();
            $res = Ordinateur::create(array_merge($request->all(), ['id_ordinateur' => $id_ordinateur]));
            DB::commit();
            
            return redirect('listeOrdinateurs_administrateur')->with('success', 'Ordinateur enregistré avec success !');
        
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

    public function storeOrdinateur_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'image_ordinateur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom_ordinateur' => ['required', 'string', new NoScriptOrCode],
                'processeur' => ['required', 'string', new NoScriptOrCode],
                'disque' => ['required', 'string', new NoScriptOrCode],
                'ram' => ['required', 'integer', new NoScriptOrCode],
                'core' => ['required', 'string', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            if ($request->hasFile('image_ordinateur')) {
                $image = $request->file('image_ordinateur');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['image_ordinateur' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
                    
            // Génération du id_ordinateur unique
            $id_ordinateur = $this->generateUniqueCode();
            $res = Ordinateur::create(array_merge($request->all(), ['id_ordinateur' => $id_ordinateur]));
            DB::commit();
            
            return redirect('listeOrdinateurs_agent')->with('success', 'Ordinateur enregistré avec success !');
        
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





    // Pour afficher les données dans la page web
    public function show($id_ordinateur)
    {
        $ordinateur = Ordinateur::find($id_ordinateur);
        if ($ordinateur) {
            return response()->json($ordinateur, 200);
        }

        return response()->json([ 'Status' => 400, 'Message' => 'Ordinateur non trouvée !' ], 400);
    }





    // Pour accéder à l'ouverture des fichiers de modification
    public function editOrdinateur_administrateur($id_ordinateur)
    {
        $ordinateur = Ordinateur::findOrFail($id_ordinateur);
        return view('authentification.administrateur.ordinateur.editOrdinateur_administrateur', compact('ordinateur'));
    }

    public function editOrdinateur_agent($id_ordinateur)
    {
        $ordinateur = Ordinateur::findOrFail($id_ordinateur);
        return view('authentification.utilisateur.agent.edits.editOrdinateur_agent', compact('ordinateur'));
    }





    // Pour confirmer la modification les données dans la base de données
    public function updateOrdinateur_administrateur(Request $request, $id_ordinateur)
    {

        $ordinateur = Ordinateur::where('id_ordinateur', $id_ordinateur)->first();

        $request->validate([
            'image_ordinateur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom_ordinateur' => ['required', 'string', new NoScriptOrCode],
            'processeur' => ['required', 'string', new NoScriptOrCode],  
            'disque' => ['required', 'string', new NoScriptOrCode],  
            'ram' => ['required', 'integer', new NoScriptOrCode],     
            'core' => ['required', 'string', new NoScriptOrCode],                   
        ]);

        if ($request->hasFile('image_ordinateur')) {
            $imagePath = $request->file('image_ordinateur')->store('photos', 'public');
            $user->image_ordinateur = $imagePath;
        }
        $ordinateur->nom_ordinateur = $request->nom_ordinateur;
        $ordinateur->processeur = $request->processeur;
        $ordinateur->disque = $request->disque;
        $ordinateur->ram = $request->ram;
        $ordinateur->core = $request->core;
        
        $ordinateur->save();
        return redirect()->route('listeOrdinateurs_administrateur')->with('success', 'Ordinateur modifié avec succès !');
    }

    public function updateOrdinateur_agent(Request $request, $id_ordinateur)
    {

        $ordinateur = Ordinateur::where('id_ordinateur', $id_ordinateur)->first();

        $request->validate([
            'image_ordinateur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom_ordinateur' => ['required', 'string', new NoScriptOrCode],
            'processeur' => ['required', 'string', new NoScriptOrCode],  
            'disque' => ['required', 'string', new NoScriptOrCode],  
            'ram' => ['required', 'integer', new NoScriptOrCode],     
            'core' => ['required', 'string', new NoScriptOrCode],                   
        ]);

        if ($request->hasFile('image_ordinateur')) {
            $imagePath = $request->file('image_ordinateur')->store('photos', 'public');
            $user->image_ordinateur = $imagePath;
        }
        $ordinateur->nom_ordinateur = $request->nom_ordinateur;
        $ordinateur->processeur = $request->processeur;
        $ordinateur->disque = $request->disque;
        $ordinateur->ram = $request->ram;
        $ordinateur->core = $request->core;
        
        $ordinateur->save();
        return redirect()->route('listeOrdinateurs_agent')->with('success', 'Ordinateur modifié avec succès !');
    }





    // Pour supprimer les ordinateurs
    public function destroyOrdinateur_administrateur($id_ordinateur)
    {
        try{
            Ordinateur::destroy($id_ordinateur); // Supprimer 
            // Redirection avec un message de succès
            return redirect('listeOrdinateurs_administrateur')->with('success', 'Suppression de ordinateur réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de ordinateur !');
        }
    }

    public function destroyOrdinateur_agent($id_ordinateur)
    {
        try{
            Ordinateur::destroy($id_ordinateur); // Supprimer 
            // Redirection avec un message de succès
            return redirect('listeOrdinateurs_agent')->with('success', 'Suppression de ordinateur réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression de ordinateur !');
        }
    }





    // Fonctions de rechercher ordinateur
    public function searchOrdinateur_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $ordinateurs = Ordinateur::where("id_ordinateur","like","%$request->keyword%")
            ->orWhere("nom_ordinateur","like","%$request->keyword%")
            ->orWhere("processeur","like","%$request->keyword%")
            ->orWhere("disque","like","%$request->keyword%")
            ->orWhere("ram","like","%$request->keyword%")
            ->orWhere("core","like","%$request->keyword%")
        ->get();
        return view('authentification.administrateur.ordinateur.listeOrdinateurs_administrateur', compact('ordinateurs'));
    }

    public function searchOrdinateur_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $ordinateurs = Ordinateur::where("id_ordinateur","like","%$request->keyword%")
            ->orWhere("nom_ordinateur","like","%$request->keyword%")
            ->orWhere("processeur","like","%$request->keyword%")
            ->orWhere("disque","like","%$request->keyword%")
            ->orWhere("ram","like","%$request->keyword%")
            ->orWhere("core","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.agent.listes.listeOrdinateurs_agent', compact('ordinateurs'));
    }

    public function searchOrdinateur_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $ordinateurs = Ordinateur::where("id_ordinateur","like","%$request->keyword%")
            ->orWhere("nom_ordinateur","like","%$request->keyword%")
            ->orWhere("processeur","like","%$request->keyword%")
            ->orWhere("disque","like","%$request->keyword%")
            ->orWhere("ram","like","%$request->keyword%")
            ->orWhere("core","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.client.listeOrdinateurs_client', compact('ordinateurs'));
    }





    // Pour la génération des enregistrements des id_ordinateur automatiquement des Ordinateur.
    public function generateUniqueCode()
    {
        $code = 'ORDI' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }  

}

<?php

namespace App\Http\Controllers\api;

use App\Models\Electromenager;
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


class ElectromenagerAPIController extends Controller
{

    // Pour enregistrer les electromenager
    public function storeElectromenager_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'image_electromenager' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom_electromenager' => ['required', 'string', new NoScriptOrCode],
                'puissance_electromenager' => ['required', 'integer', new NoScriptOrCode],
                'tension_electromenager' => ['required', 'integer', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
            $name = '';
            if ($request->hasFile('image_electromenager')) {
                $image = $request->file('image_electromenager');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['image_electromenager' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
                    
            // Génération du id_electromenager unique
            $id_electromenager = $this->generateUniqueCode();
            $res = Electromenager::create(array_merge($request->all(), ['id_electromenager' => $id_electromenager, 'image_electromenager'=> $name]));
            DB::commit();
            
            return redirect('listeElectromenagers_administrateur')->with('success', 'Electromenager enregistré avec success !');
        
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
    
    public function storeElectromenager_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'image_electromenager' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom_electromenager' => ['required', 'string', new NoScriptOrCode],
                'puissance_electromenager' => ['required', 'integer', new NoScriptOrCode],
                'tension_electromenager' => ['required', 'integer', new NoScriptOrCode],
            ];

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            if ($request->hasFile('image_electromenager')) {
                $image = $request->file('image_electromenager');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['image_electromenager' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
                    
            // Génération du id_electromenager unique
            $id_electromenager = $this->generateUniqueCode();
            $res = Electromenager::create(array_merge($request->all(), ['id_electromenager' => $id_electromenager, 'image_electromenager'=> $name]));
            DB::commit();
            
            return redirect('listeElectromenagers_agent')->with('success', 'Electromenager enregistré avec success !');
        
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
    public function show($id_electromenager)
    {
        $electromenager = Electromenager::find($id_electromenager);
        if ($electromenager) {
            return response()->json($electromenager, 200);
        }

        return response()->json([ 'Status' => 400, 'Message' => 'Electromenager non trouvée !' ], 400);
    }





    // Pour accéder à l'ouverture des fichiers de modification
    public function editElectromenager_administrateur($id_electromenager)
    {
        $electromenager = Electromenager::findOrFail($id_electromenager);
        return view('authentification.administrateur.electromenager.editElectromenager_administrateur', compact('electromenager'));
    }

    public function editElectromenager_agent($id_electromenager)
    {
        $electromenager = Electromenager::findOrFail($id_electromenager);
        return view('authentification.utilisateur.agent.edits.editElectromenager_agent', compact('electromenager'));
    }





    // Pour confirmer la modification les données dans la base de données
    public function updateElectromenager_administrateur(Request $request, $id_electromenager)
    {

        $electromenager = Electromenager::where('id_electromenager', $id_electromenager)->first();

        $request->validate([
            
            'nom_electromenager' => ['required', 'string', new NoScriptOrCode],
            'puissance_electromenager' => ['required', 'integer', new NoScriptOrCode],
            'tension_electromenager' => ['required', 'integer', new NoScriptOrCode],            
        ]);

        $electromenager->nom_electromenager = $request->nom_electromenager;
        $electromenager->puissance_electromenager = $request->puissance_electromenager;
        $electromenager->tension_electromenager = $request->tension_electromenager;
        
        $electromenager->save();
        return redirect()->route('listeElectromenagers_administrateur')->with('success', 'Electromenager modifié avec succès !');
    }

    public function updateElectromenager_agent(Request $request, $id_electromenager)
    {

        $electromenager = Electromenager::where('id_electromenager', $id_electromenager)->first();

        $request->validate([
            
            'nom_electromenager' => ['required', 'string', new NoScriptOrCode],
            'puissance_electromenager' => ['required', 'integer', new NoScriptOrCode],
            'tension_electromenager' => ['required', 'integer', new NoScriptOrCode],            
        ]);

        $electromenager->nom_electromenager = $request->nom_electromenager;
        $electromenager->puissance_electromenager = $request->puissance_electromenager;
        $electromenager->tension_electromenager = $request->tension_electromenager;
        
        $electromenager->save();
        return redirect()->route('listeElectromenagers_agent')->with('success', 'Electromenager modifié avec succès !');
    }

    



    // Pour supprimer les electromenagers
    public function destroyElectromenager_administrateur($id_electromenager)
    {
        try{
            Electromenager::destroy($id_electromenager); // Supprimer 
            // Redirection avec un message de succès
            return redirect('listeElectromenagers_administrateur')->with('success', 'Suppression de electromenager réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de electromenager !');
        }
    }

    public function destroyElectromenager_agent($id_electromenager)
    {
        try{
            Electromenager::destroy($id_electromenager); // Supprimer
            // Redirection avec un message de succès
            return redirect('listeElectromenagers_agent')->with('success', 'Suppression de electromenager réussie !');
        } catch (\Throwable $th){
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_agent')->with('error', 'Erreur lors de la suppression de electromenager !');
        }
    }





    // Fonctions de rechercher Electromenager
    public function searchElectromenager_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $electromenagers = Electromenager::where("id_electromenager","like","%$request->keyword%")
            ->orWhere("nom_electromenager","like","%$request->keyword%")
            ->orWhere("puissance_electromenager","like","%$request->keyword%")
            ->orWhere("tension_electromenager","like","%$request->keyword%")
        ->get();
        return view('authentification.administrateur.electromenager.listeElectromenagers_administrateur', compact('electromenagers'));
    }

    public function searchElectromenager_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $electromenagers = Electromenager::where("id_electromenager","like","%$request->keyword%")
            ->orWhere("nom_electromenager","like","%$request->keyword%")
            ->orWhere("puissance_electromenager","like","%$request->keyword%")
            ->orWhere("tension_electromenager","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.agent.listes.listeElectromenagers_agent', compact('electromenagers'));
    }

    public function searchElectromenager_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $electromenagers = Electromenager::where("id_electromenager","like","%$request->keyword%")
            ->orWhere("nom_electromenager","like","%$request->keyword%")
            ->orWhere("puissance_electromenager","like","%$request->keyword%")
            ->orWhere("tension_electromenager","like","%$request->keyword%")
        ->get();
        return view('authentification.utilisateur.client.listeElectromenagers_client', compact('electromenagers'));
    }





    // Pour la génération des enregistrements des id_electromenager automatiquement des Electromenager.
    public function generateUniqueCode()
    {
        $code = 'ELEC' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }  

}

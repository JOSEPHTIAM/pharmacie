<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Chauffeur;
use App\Models\Mecanicien;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function index()
    {
        return view("abonnement.index");
    }


    public function create()
    {
        $chauffeurs = Chauffeur::all();
        $mecaniciens = Mecanicien::all();
        return view('abonnement.create', compact('chauffeurs', 'mecaniciens'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo_abon' => 'nullable|image',
            'nom_abon' => 'required|string|max:255',
            'nombre_jour_abon' => 'required|integer',
            'prix_abon' => 'required|integer',
            'matricule_chau' => 'required|string',
            'matricule_meca' => 'required|string',
        ]);

        $id_abon = $this->generateUniqueCode();

        $abonnement = new Abonnement();
        $abonnement->id_abon = $id_abon;
        $abonnement->photo_abon = $validatedData['photo_abon'];
        $abonnement->nom_abon = $validatedData['nom_abon'];
        $abonnement->nombre_jour_abon = $validatedData['nombre_jour_abon'];
        $abonnement->prix_abon = $validatedData['prix_abon'];
        $abonnement->matricule_chau = $validatedData['matricule_chau'];
        $abonnement->matricule_meca = $validatedData['matricule_meca'];

        if ($abonnement->save()) {
            return redirect('/list_abonnement')->with('success', 'Enregistrement abonnement réussi avec succès !')->with('abonnement', $abonnement);
        } else {
            return back()->with('error', 'Enregistrement note échoué pour abonnement !')->withInput();
        }

    }


    public function show(Abonnement $abonnement)
    {
        //
    }


    public function edit($id_abon)
    {
        $abonnement = Abonnement::findOrFail($id_abon);
        $chauffeurs = Chauffeur::all();
        $mecaniciens = Mecanicien::all();

        return view('abonnement.edit', compact('abonnement', 'chauffeurs', 'mecaniciens'));
    }


    public function update(Request $request)
    {
        $res = Abonnement::firstWhere("id_abon", $request->id_abon)->update($request->all());
        if($res){
            return redirect('/list_abonnement')->with('success', 'Abonnement mis à jour avec succès !');
        }else{
            return redirect('/list_abonnement')->with('error', 'Echec de l operation pour abonnement !');
        }
    }


    public function destroy($id_abon)
    {
        try{
            Abonnement::destroy($id_abon);
            return redirect('/list_abonnement')->with('success', 'Abonnement supprimé avec succès !');
        } catch (\Throwable $th){
            return redirect('/list_abonnement')->with('error', 'Echec de l operation pour abonnement !');
        }
    }

    public function generateUniqueCode() {
        $code = 'ABON' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        return $code;
    }

    public function search(Request $request)
    {
        $abonnements = Abonnement::where("id_abon","like","%$request->keyword%")
            ->orWhere("nom_abon","like","%$request->keyword%")
            ->orWhere("nombre_jour_abon","like","%$request->keyword%")
            ->orWhere("prix_abon","like","%$request->keyword%")->get();
        return view("abonnement.index", compact("abonnements"));
    }
}

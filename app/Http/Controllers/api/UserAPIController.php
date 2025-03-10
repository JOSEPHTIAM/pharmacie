<?php

namespace App\Http\Controllers\api;

use App\Models\User;
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

class UserAPIController extends Controller
{

    public function index_administrateur()
    {
        $users = User::where('role', 'Administrateur')->get();        
        //return response()->json([ 'Status' => 200,  'Message' => 'Liste des  users administrateur', $users ], 200);
        return view("administrateur.administrateur.index", ['users' => $users]);
    }
    
    public function index_agent()
    {
        $users = User::where('role', 'Agent')->get();        
        //return response()->json([ 'Status' => 200,  'Message' => 'Liste des  users agent', $users ], 200);
        return view("administrateur.agent.index", ['users' => $users]);
    } 
    
    public function index_client()
    {
        $users = User::where('role', 'Client')->get();        
        //return response()->json([ 'Status' => 200,  'Message' => 'Liste des  users client', $users ], 200);
        return view("administrateur.client.index", ['users' => $users]);
    } 






    
    public function store(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom' => ['required', 'string', new NoScriptOrCode],
                'prenom' => ['nullable', 'string', new NoScriptOrCode],
                'contact' => ['required', new ContactUser, new NoScriptOrCode],
                'role' => ['required', 'in:Client,Agent,Administrateur,Admin', new NoScriptOrCode],
                'email' => ['required', 'email', 'unique:user,email', new GmailFormat, new NoScriptOrCode],
                'password' => ['required', 'unique:user,password', new PasswordUser, new NoScriptOrCode],
                'statut' => ['nullable', 'string', new NoScriptOrCode],
                'latitude' => ['nullable', 'string', new NoScriptOrCode],
                'longitude' => ['nullable', 'string', new NoScriptOrCode],
                'nom_societe' => ['nullable', 'string', new NoScriptOrCode],
                'numero_societe' => ['nullable', 'integer', new NoScriptOrCode],
                'non_redevence' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
                'periode' => ['nullable', 'date_format:H:i:s', new NoScriptOrCode],
            ];

            if ($request->role === 'Agent') {
                $rules['nom_societe'] = ['required', 'string', new NoScriptOrCode];
                $rules['numero_societe'] = ['required', 'integer'];
                $rules['non_redevence'] = ['nullable', 'file', 'mimes:pdf,doc,docx'];
            }

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Gestion de l'upload des fichiers images
            $image = $request->file('photo')->store('uploads', 'public');
            
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['photo' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }
            
            if ($request->hasFile('non_redevence')) {
                $document = $request->file('non_redevence');
                $docName = time().'.'.$document->getClientOriginalExtension();
                $docPath = public_path('/documents');
                $document->move($docPath, $docName);
                $request->merge(['non_redevence' => '/documents/'.$docName]);
            }

            // Hash du mot de passe
            $request->merge(['password' => Hash::make($request->password)]);

            // Définir statut à 'actif' par défaut pour 'Client' et 'Agent'
            if (in_array($request->role, ['Client', 'Agent'])) {
                $request->merge(['statut' => 'actif']);
            }

            // Génération du matricule unique
            $matricule = $this->generateUniqueCode();
            $res = User::create(array_merge($request->all(), ['matricule' => $matricule, 'photo'=> $name]));
            
            DB::commit();

            // Définit une période par défaut de 10 secondes
            $periode = $request->input('periode', '00:00:10'); 

            if ($request->role === 'Agent') {
                $request->session()->put('login_time', now());
                return redirect('tokenAgent')->with('success', 'Agent enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Client') {
                $request->session()->put('login_time', now());
                return redirect('tokenClient')->with('success', 'Client enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Administrateur') {
                $request->session()->put('login_time', now());
                return redirect('tokenAdministrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Admin') {
                $request->session()->put('login_time', now());
                return redirect('tokenAdministrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }

            return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
        
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

    public function store_administrateur(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom' => ['required', 'string', new NoScriptOrCode],
                'prenom' => ['nullable', 'string', new NoScriptOrCode],
                'contact' => ['required', new ContactUser, new NoScriptOrCode],
                'role' => ['required', 'in:Client,Agent,Administrateur,Admin', new NoScriptOrCode],
                'email' => ['required', 'email', 'unique:user,email', new GmailFormat, new NoScriptOrCode],
                'password' => ['required', 'unique:user,password', new PasswordUser, new NoScriptOrCode],
                'statut' => ['nullable', 'string', new NoScriptOrCode],
                'latitude' => ['nullable', 'string', new NoScriptOrCode],
                'longitude' => ['nullable', 'string', new NoScriptOrCode],
                'nom_societe' => ['nullable', 'string', new NoScriptOrCode],
                'numero_societe' => ['nullable', 'integer', new NoScriptOrCode],
                'non_redevence' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
                'periode' => ['nullable', 'date_format:H:i:s', new NoScriptOrCode],
            ];

            if ($request->role === 'Agent') {
                $rules['nom_societe'] = ['required', 'string', new NoScriptOrCode];
                $rules['numero_societe'] = ['required', 'integer'];
                $rules['non_redevence'] = ['nullable', 'file', 'mimes:pdf,doc,docx'];
            }

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();
            
            // Gestion de l'upload des fichiers
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['photo' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }

            if ($request->hasFile('non_redevence')) {
                $document = $request->file('non_redevence');
                $docName = time().'.'.$document->getClientOriginalExtension();
                $docPath = public_path('/documents');
                $document->move($docPath, $docName);
                $request->merge(['non_redevence' => '/documents/'.$docName]);
            }

            // Hash du mot de passe
            $request->merge(['password' => Hash::make($request->password)]);

            // Définir statut à 'actif' par défaut pour 'Client' et 'Agent'
            if (in_array($request->role, ['Client', 'Agent'])) {
                $request->merge(['statut' => 'actif']);
            }

            // Génération du matricule unique
            $matricule = $this->generateUniqueCode();
            $res = User::create(array_merge($request->all(), ['matricule' => $matricule, 'photo'=> $name]));
            DB::commit();

            // Définit une période par défaut de 10 secondes
            $periode = $request->input('periode', '00:00:10'); 

            if ($request->role === 'Agent') {
                $request->session()->put('login_time', now());
                return redirect('listeAgents_administrateur')->with('success', 'Agent enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Client') {
                $request->session()->put('login_time', now());
                return redirect('listeClients_administrateur')->with('success', 'Client enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Administrateur') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Admin') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }

            return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
        
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

    public function store_agent(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom' => ['required', 'string', new NoScriptOrCode],
                'prenom' => ['nullable', 'string', new NoScriptOrCode],
                'contact' => ['required', new ContactUser, new NoScriptOrCode],
                'role' => ['required', 'in:Client,Agent,Administrateur,Admin', new NoScriptOrCode],
                'email' => ['required', 'email', 'unique:user,email', new GmailFormat, new NoScriptOrCode],
                'password' => ['required', 'unique:user,password', new PasswordUser, new NoScriptOrCode],
                'statut' => ['nullable', 'string', new NoScriptOrCode],
                'latitude' => ['nullable', 'string', new NoScriptOrCode],
                'longitude' => ['nullable', 'string', new NoScriptOrCode],
                'nom_societe' => ['nullable', 'string', new NoScriptOrCode],
                'numero_societe' => ['nullable', 'integer', new NoScriptOrCode],
                'non_redevence' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
                'periode' => ['nullable', 'date_format:H:i:s', new NoScriptOrCode],
            ];

            if ($request->role === 'Agent') {
                $rules['nom_societe'] = ['required', 'string', new NoScriptOrCode];
                $rules['numero_societe'] = ['required', 'integer'];
                $rules['non_redevence'] = ['nullable', 'file', 'mimes:pdf,doc,docx'];
            }

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Gestion de l'upload des fichiers
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['photo' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }

            if ($request->hasFile('non_redevence')) {
                $document = $request->file('non_redevence');
                $docName = time().'.'.$document->getClientOriginalExtension();
                $docPath = public_path('/documents');
                $document->move($docPath, $docName);
                $request->merge(['non_redevence' => '/documents/'.$docName]);
            }

            // Hash du mot de passe
            $request->merge(['password' => Hash::make($request->password)]);

            // Définir statut à 'actif' par défaut pour 'Client' et 'Agent'
            if (in_array($request->role, ['Client', 'Agent'])) {
                $request->merge(['statut' => 'actif']);
            }

            // Génération du matricule unique
            $matricule = $this->generateUniqueCode();
            $res = User::create(array_merge($request->all(), ['matricule' => $matricule, 'photo'=> $name]));
            DB::commit();

            // Définit une période par défaut de 10 secondes
            $periode = $request->input('periode', '00:00:10'); 

            if ($request->role === 'Agent') {
                $request->session()->put('login_time', now());
                return redirect('listeAgents_administrateur')->with('success', 'Agent enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Client') {
                $request->session()->put('login_time', now());
                return redirect('listeClients_administrateur')->with('success', 'Client enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Administrateur') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Admin') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }


            return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
        
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

    public function store_client(Request $request)
    {
        // Phase des enregistrements et des erreurs
        try {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nom' => ['required', 'string', new NoScriptOrCode],
                'prenom' => ['nullable', 'string', new NoScriptOrCode],
                'contact' => ['required', new ContactUser, new NoScriptOrCode],
                'role' => ['required', 'in:Client,Agent,Administrateur,Admin', new NoScriptOrCode],
                'email' => ['required', 'email', 'unique:user,email', new GmailFormat, new NoScriptOrCode],
                'password' => ['required', 'unique:user,password', new PasswordUser, new NoScriptOrCode],
                'statut' => ['nullable', 'string', new NoScriptOrCode],
                'latitude' => ['nullable', 'string', new NoScriptOrCode],
                'longitude' => ['nullable', 'string', new NoScriptOrCode],
                'nom_societe' => ['nullable', 'string', new NoScriptOrCode],
                'numero_societe' => ['nullable', 'integer', new NoScriptOrCode],
                'non_redevence' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
                'periode' => ['nullable', 'date_format:H:i:s', new NoScriptOrCode],
            ];

            if ($request->role === 'Agent') {
                $rules['nom_societe'] = ['required', 'string', new NoScriptOrCode];
                $rules['numero_societe'] = ['required', 'integer'];
                $rules['non_redevence'] = ['nullable', 'file', 'mimes:pdf,doc,docx'];
            }

            // Validation du formulaire
            $this->validate($request, $rules);

            DB::beginTransaction();

            // Gestion de l'upload des fichiers
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images');
                $image->move($destinationPath, $name);
                $request->merge(['photo' => 'storage/images/'.$name]); // Assurez-vous que ce chemin est stocké
            }

            if ($request->hasFile('non_redevence')) {
                $document = $request->file('non_redevence');
                $docName = time().'.'.$document->getClientOriginalExtension();
                $docPath = public_path('/documents');
                $document->move($docPath, $docName);
                $request->merge(['non_redevence' => '/documents/'.$docName]);
            }

            // Hash du mot de passe
            $request->merge(['password' => Hash::make($request->password)]);

            // Définir statut à 'actif' par défaut pour 'Client' et 'Agent'
            if (in_array($request->role, ['Client', 'Agent'])) {
                $request->merge(['statut' => 'actif']);
            }

            // Génération du matricule unique
            $matricule = $this->generateUniqueCode();
            $res = User::create(array_merge($request->all(), ['matricule' => $matricule, 'photo'=> $name]));
            DB::commit();

            // Définit une période par défaut de 10 secondes
            $periode = $request->input('periode', '00:00:10'); 

            if ($request->role === 'Agent') {
                $request->session()->put('login_time', now());
                return redirect('listeAgents_administrateur')->with('success', 'Agent enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Client') {
                $request->session()->put('login_time', now());
                return redirect('listeClients_administrateur')->with('success', 'Client enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Administrateur') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }
            if ($request->role === 'Admin') {
                $request->session()->put('login_time', now());
                return redirect('listeAdministrateurs_administrateur')->with('success', 'Administrateur enregistré avec succès !')->with('matricule', $matricule)->with('periode', $periode);
            }

            return response()->json([ 'Status' => 200, 'Message' => 'Utilisateur enregistré avec succès !' ], 200);
        
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






    // Pour afficher les donner dans la page du site web
    public function show($matricule)
    {
        $user = User::find($matricule);
        if ($user) {
            return response()->json($user, 200);
        }

        return response()->json([ 'Status' => 400, 'Message' => 'Utilisateur non trouvé !' ], 400);
    }

    
    
    
    
    // Pour les ouvertures des données détaillées
    public function OpenAdministrateur_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Administrateur') // Vérifier que le rôle est Administrateur
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.agent.OpenAdministrateur_administrateur', ['user' => $user]);
    }

    public function OpenAgent_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un agent
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Agent') // Vérifier que le rôle est Agent
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.agent.OpenAgent_administrateur', ['user' => $user]);
    }

    public function OpenClient_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un Client
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Client') // Vérifier que le rôle est Client
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.agent.OpenClient_administrateur', ['user' => $user]);
    }





    public function editAdministrateur_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Administrateur') // Vérifier que le rôle est Administrateur
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.agent.editAdministrateur_administrateur', ['user' => $user]);
    }

    public function editAgent_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Agent') // Vérifier que le rôle est Agent
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_agent
        return view('authentification.administrateur.agent.editAgent_administrateur', ['user' => $user]);
    }

    public function editCLient_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Client') // Vérifier que le rôle est Client
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_client
        return view('authentification.administrateur.agent.editCLient_administrateur', ['user' => $user]);
    }




    public function editDetailsAdministrateur_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Administrateur') // Vérifier que le rôle est Administrateur
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_administrateur
        return view('authentification.administrateur.agent.editDetailsAdministrateur_administrateur', ['user' => $user]);
    }

    public function editDetailsAgent_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Agent') // Vérifier que le rôle est Agent
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_agent
        return view('authentification.administrateur.agent.editDetailsAgent_administrateur', ['user' => $user]);
    }

    public function editDetailsClient_administrateur($matricule)
    {
        // Récupérer l'utilisateur avec le matricule spécifié et vérifier qu'il est un administrateur
        $user = User::where('matricule', $matricule)
                    ->where('role', 'Client') // Vérifier que le rôle est Client
                    ->firstOrFail(); 

        // Passer l'utilisateur à la vue edit_client
        return view('authentification.administrateur.agent.editDetailsClient_administrateur', ['user' => $user]);
    }

    



    public function updateAdministrateur_administrateur(Request $request, $matricule)
    {
        $user = User::where('matricule', $matricule)->first();
        $request->validate([
            'nom' => ['required', 'string', new NoScriptOrCode],
            'prenom' => ['nullable', 'string', new NoScriptOrCode],
            'contact' => ['required', new ContactUser, new NoScriptOrCode],
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', new PasswordUser, new NoScriptOrCode],
            'statut' => ['nullable', 'string', new NoScriptOrCode],
            
        ]);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->contact = $request->contact;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->statut = $request->statut;
        
        $user->save();
        return redirect()->route('listeAdministrateurs_administrateur')->with('success', 'Administrateur modifié avec succès !');
    }

    public function updateClient_administrateur(Request $request, $matricule)
    {
        $user = User::where('matricule', $matricule)->first();
        $request->validate([
            'nom' => ['required', 'string', new NoScriptOrCode],
            'prenom' => ['nullable', 'string', new NoScriptOrCode],
            'contact' => ['required', new ContactUser, new NoScriptOrCode],
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', new PasswordUser, new NoScriptOrCode],
            'statut' => ['nullable', 'string', new NoScriptOrCode],
        ]);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->statut = $request->statut;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('listeClients_administrateur')->with('success', 'Client modifié avec succès !');
    }

    public function updateAgent_administrateur(Request $request, $matricule)
    {

        $user = User::where('matricule', $matricule)->first();

        $request->validate([
            'nom' => ['required', 'string', new NoScriptOrCode],
            'prenom' => ['nullable', 'string', new NoScriptOrCode],
            'contact' => ['required', new ContactUser, new NoScriptOrCode],
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', new PasswordUser, new NoScriptOrCode],
            'statut' => ['nullable', 'string', new NoScriptOrCode],
            'nom_societe' => ['nullable', 'string', new NoScriptOrCode],
            'numero_societe' => ['nullable', 'integer', new NoScriptOrCode],
        ]);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->contact = $request->contact;
        $user->email = $request->email;        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->statut = $request->statut;
        
        $user->nom_societe = $request->nom_societe;
        $user->numero_societe = $request->numero_societe;

        $user->save();
        return redirect()->route('listeAgents_administrateur')->with('success', 'Agent modifié avec succès !');
    }

    

    
    // Pour supprimer les Acteurs
    public function destroyAdministrateur_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Administrateur') // Vérifier que le rôle est Administrateur
                        ->firstOrFail(); 
            $user->delete(); // Supprimer l'utilisateur
            // Redirection avec un message de succès
            return redirect('listeAdministrateurs_administrateur')->with('success', 'Suppression de l\'administrateur réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de l\'administrateur !');            
        }
    }

    public function destroyDetailsAdministrateur_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Administrateur') // Vérifier que le rôle est Administrateur
                        ->firstOrFail(); 
            $user->delete(); // Supprimer l'utilisateur
            // Redirection avec un message de succès
            return redirect('listeDetailsAdministrateurs_administrateur')->with('success', 'Suppression de l\'administrateur réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de l\'administrateur !');            
        }
    }

    public function destroyAgent_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Agent') // Vérifier que le rôle est agent
                        ->firstOrFail(); 

            $user->delete(); // Supprimer l'utilisateur

            // Redirection avec un message de succès
            return redirect('listeAgents_administrateur')->with('success', 'Suppression de l\'agent réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de l\'agent !');            
        }
    }

    public function destroyDetailsAgent_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Agent') // Vérifier que le rôle est agent
                        ->firstOrFail(); 

            $user->delete(); // Supprimer l'utilisateur

            // Redirection avec un message de succès
            return redirect('listeDetailsAgents_administrateur')->with('success', 'Suppression de l\'agent réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression de l\'agent !');            
        }
    }

    public function destroyClient_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Client') // Vérifier que le rôle est client
                        ->firstOrFail(); 

            $user->delete(); // Supprimer l'utilisateur

            // Redirection avec un message de succès
            return redirect('listeClients_administrateur')->with('success', 'Suppression du client réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression du client !');            
        }
    }

    public function destroyDetailsClient_administrateur($matricule)
    {
        try {
            // Trouver l'utilisateur avec le matricule spécifié
            $user = User::where('matricule', $matricule)
                        ->where('role', 'Client') // Vérifier que le rôle est client
                        ->firstOrFail(); 

            $user->delete(); // Supprimer l'utilisateur

            // Redirection avec un message de succès
            return redirect('listeDetailsClients_administrateur')->with('success', 'Suppression du client réussie !');            
        } catch (\Exception $e) {
            // Redirection en cas d'erreur avec un message d'erreur
            return redirect('error_administrateur')->with('error', 'Erreur lors de la suppression du client !');            
        }
    }
       



    // Fonction de recherche des clients    
    public function search_client(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Client')
            ->where(function($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('statut', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.utilisateur.client.listeDesClients', compact('users'));
    }



    // Fonctions de recherche du coté Agent
    public function searchAgent_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Agent')
            ->where(function($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('statut', 'like', "%$keyword%")
                    ->orWhere('nom_societe', 'like', "%$keyword%")
                    ->orWhere('numero_societe', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.utilisateur.agent.listes.listeAgents_agent', compact('users'));
    }
    
    public function searchClient_agent(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Client')
            ->where(function($query) use ($keyword) {
                $query->where('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('statut', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.utilisateur.agent.listes.listeClients_agent', compact('users'));
    }




    // Fonctions de recherche du cote Administrateur
    public function searchAgent_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Administrateur')
            ->where(function($query) use ($keyword) {
                $query->where('matricule', 'like', "%$keyword%")
                    ->orWhere('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('nom_societe', 'like', "%$keyword%")
                    ->orWhere('numero_societe', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.administrateur.agent.listeAgents_administrateur', compact('users'));
    }

    public function searchAdministrateur_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Agent')
            ->where(function($query) use ($keyword) {
                $query->where('matricule', 'like', "%$keyword%")
                    ->orWhere('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.administrateur.agent.listeAdministrateurs_administrateur', compact('users'));
    }

    public function searchClient_administrateur(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('role', 'Agent')
            ->where(function($query) use ($keyword) {
                $query->where('matricule', 'like', "%$keyword%")
                    ->orWhere('nom', 'like', "%$keyword%")
                    ->orWhere('prenom', 'like', "%$keyword%")
                    ->orWhere('contact', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('statut', 'like', "%$keyword%");
            })
        ->get();
        return view('authentification.administrateur.agent.listeClients_administrateur', compact('users'));
    }

    

    // Pour l'authentification (Login et SignUp)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {

            if ($user->role === 'Agent') {
                //return redirect()->route('tokenAgent')->with('success', 'Connexion réussie !');
                return redirect()->intended('tokenAgent');
            } elseif ($user->role === 'Client') {
                //return redirect()->route('tokenClient')->with('success', 'Connexion réussie !');
                return redirect()->intended('tokenClient');
            } elseif ($user->role === 'Administrateur' || $user->role === 'Admin') {
                //return redirect()->route('tokenAdministrateur')->with('success', 'Connexion réussie !');
                return redirect()->intended('tokenAdministrateur');
            }

        }

        return back()->withErrors([
            'email' => 'Les informations de connexion fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



    // Pour la génération des enregistrements des matricules automatiquement des Actors.
    public function generateUniqueCode()
    {
        $code = 'ACTOR' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);
        return $code;
    }

    public function sanitizeRequestData(array $data)
    {
        return array_map(function($item) {
            return is_string($item) ? htmlspecialchars($item, ENT_QUOTES, 'UTF-8') : $item;
        }, $data);
    }

    // Pour récupérer les agent en ligne
    public function getOnlineAgents()
    {
        // Récupérer les agents en ligne
        $onlineAgents = User::where('role', 'Agent')
            ->where('is_online', true)
            ->get();

        return response()->json($onlineAgents);
    }

}


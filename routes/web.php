<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//_______________________________________________________________________________-
// La route principale
Route::get('/', function () { return view('welcome'); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// La route pour le Mail
Route::post('/send-email', function (Request $request) {
    $data = $request->all();

    Mail::raw($data['text'], function ($message) use ($data) {
        $message->from('josephtiam8@gmail.com', 'gestion_plateforme_anonces')
                ->to($data['to'])
                ->subject($data['subject']);
    });

    return response()->json(['message' => 'Gmail envoyé avec succès ! Bien vouloir le consulter dans votre boîte de réception !']);
});
//_______________________________________________________________________________-


// 'Gmail envoyé avec succès ! Bien vouloir le consulter dans votre boîte de réception !']);


//_______________________________________________________________________________-
// Pour les simples navigations
Route::get('connexion', function () { return view('authentification.connexion'); })->name('connexion');
Route::get('connexionUtilisateur', function () { return view('authentification.utilisateur.connexionUtilisateur'); })->name('connexionUtilisateur');
Route::get('connexionAdministrateur', function () { return view('authentification.administrateur.connexionAdministrateur'); })->name('connexionAdministrateur');
Route::get('accueilClient', function () { return view('authentification.utilisateur.client.accueilClient'); })->name('accueilClient');
Route::get('accueilAgent', function () { return view('authentification.utilisateur.agent.accueilAgent'); })->name('accueilAgent');
Route::get('accueilAdministrateur', function () { return view('authentification.administrateur.accueilAdministrateur'); })->name('accueilAdministrateur');
Route::get('listeDesClients', function () { return view('authentification.utilisateur.client.listeDesClients'); })->name('listeDesClients');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour les listes du coté Agent
Route::get('listeClients_agent', function () { return view('authentification.utilisateur.agent.listes.listeClients_agent'); })->name('listeClients_agent');
Route::get('listeAgents_agent', function () { return view('authentification.utilisateur.agent.listes.listeAgents_agent'); })->name('listeAgents_agent');
Route::get('listeAnnonces_agent', function () { return view('authentification.utilisateur.agent.listes.listeAnnonces_agent'); })->name('listeAnnonces_agent');
Route::get('listeLocalisations_agent', function () { return view('authentification.utilisateur.agent.listes.listeLocalisations_agent'); })->name('listeLocalisations_agent');
Route::get('listeElectromenagers_agent', function () { return view('authentification.utilisateur.agent.listes.listeElectromenagers_agent'); })->name('listeElectromenagers_agent');
Route::get('listeOrdinateurs_agent', function () { return view('authentification.utilisateur.agent.listes.listeOrdinateurs_agent'); })->name('listeOrdinateurs_agent');
Route::get('listeServices_agent', function () { return view('authentification.utilisateur.agent.listes.listeServices_agent'); })->name('listeServices_agent');
Route::get('listeFormations_agent', function () { return view('authentification.utilisateur.agent.listes.listeFormations_agent'); })->name('listeFormations_agent');
Route::get('listeMagasins_agent', function () { return view('authentification.utilisateur.agent.listes.listeMagasins_agent'); })->name('listeMagasins_agent');
Route::get('listeTransactions_agent', function () { return view('authentification.utilisateur.agent.listes.listeTransactions_agent'); })->name('listeTransactions_agent');
Route::get('listePaniers_agent', function () { return view('authentification.utilisateur.agent.listes.listePaniers_agent'); })->name('listePaniers_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour les listes du coté Administrateur
Route::get('listeClients_administrateur', function () { return view('authentification.administrateur.agent.listeClients_administrateur'); })->name('listeClients_administrateur');
Route::get('listeAgents_administrateur', function () { return view('authentification.administrateur.agent.listeAgents_administrateur'); })->name('listeAgents_administrateur');
Route::get('listeAdministrateurs_administrateur', function () { return view('authentification.administrateur.agent.listeAdministrateurs_administrateur'); })->name('listeAdministrateurs_administrateur');
Route::get('listeAnnonces_administrateur', function () { return view('authentification.administrateur.annonce.listeAnnonces_administrateur'); })->name('listeAnnonces_administrateur');
Route::get('listeLocalisations_administrateur', function () { return view('authentification.administrateur.localisation.listeLocalisations_administrateur'); })->name('listeLocalisations_administrateur');
Route::get('listeElectromenagers_administrateur', function () { return view('authentification.administrateur.electromenager.listeElectromenagers_administrateur'); })->name('listeElectromenagers_administrateur');
Route::get('listeOrdinateurs_administrateur', function () { return view('authentification.administrateur.ordinateur.listeOrdinateurs_administrateur'); })->name('listeOrdinateurs_administrateur');
Route::get('listeServices_administrateur', function () { return view('authentification.administrateur.service.listeServices_administrateur'); })->name('listeServices_administrateur');
Route::get('listeFormations_administrateur', function () { return view('authentification.administrateur.formation.listeFormations_administrateur'); })->name('listeFormations_administrateur');
Route::get('listeMagasins_administrateur', function () { return view('authentification.administrateur.magasin.listeMagasins_administrateur'); })->name('listeMagasins_administrateur');
Route::get('listeTransactions_administrateur', function () { return view('authentification.administrateur.transaction.listeTransactions_administrateur'); })->name('listeTransactions_administrateur');
Route::get('listePaniers_administrateur', function () { return view('authentification.administrateur.panier.listePaniers_administrateur'); })->name('listePaniers_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la liste dans les liste du coté Agent et du coté administrateur
Route::get('listeDetailsClients_agent', function () { return view('authentification.utilisateur.agent.listes.listeDetailsClients_agent'); })->name('listeDetailsClients_agent');
Route::get('listeDetailsAgents_agent', function () { return view('authentification.utilisateur.agent.listes.listeDetailsAgents_agent'); })->name('listeDetailsAgents_agent');
Route::get('listeDetailsClients_administrateur', function () { return view('authentification.administrateur.agent.listeDetailsClients_administrateur'); })->name('listeDetailsClients_administrateur');
Route::get('listeDetailsAgents_administrateur', function () { return view('authentification.administrateur.agent.listeDetailsAgents_administrateur'); })->name('listeDetailsAgents_administrateur');
Route::get('listeDetailsAdministrateurs_administrateur', function () { return view('authentification.administrateur.agent.listeDetailsAdministrateurs_administrateur'); })->name('listeDetailsAdministrateurs_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouveau compte (client ou agent ou administrateur)
Route::get('nouveauUtilisateur', function () { return view('authentification.utilisateur.nouveauUtilisateur'); });
Route::get('nouveauAdministrateur', function () { return view('authentification.administrateur.nouveauAdministrateur'); });
Route::post('/utilisateur/store', [\App\Http\Controllers\api\UserAPIController::class, 'store'])->name('utilisateur.store');
Route::post('/store', [\App\Http\Controllers\api\UserAPIController::class, 'store'])->name('store');
Route::post('/store_administrateur', [\App\Http\Controllers\api\UserAPIController::class, 'store_administrateur'])->name('store_administrateur');
Route::post('/store_agent', [\App\Http\Controllers\api\UserAPIController::class, 'store_agent'])->name('store_agent');
Route::post('/store_client', [\App\Http\Controllers\api\UserAPIController::class, 'store_client'])->name('store_client');
Route::get("/nouveauAgent_administrateur", function(){ return view("authentification.administrateur.agent.nouveauAgent_administrateur"); });
Route::get("/nouveauAdministrateur_administrateur", function(){ return view("authentification.administrateur.agent.nouveauAdministrateur_administrateur"); });
Route::get("/nouveauClient_administrateur", function(){ return view("authentification.administrateur.agent.nouveauClient_administrateur"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'une localisation
Route::get("/nouveauLocalisation_administrateur", function(){ return view("authentification.administrateur.localisation.nouveauLocalisation_administrateur"); });
Route::get("/nouveauLocalisation_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauLocalisation_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'une electromenager
Route::get("/nouveauElectromenager_administrateur", function(){ return view("authentification.administrateur.electromenager.nouveauElectromenager_administrateur"); });
Route::get("/nouveauElectromenager_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauElectromenager_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'une ordinateur
Route::get("/nouveauOrdinateur_administrateur", function(){ return view("authentification.administrateur.ordinateur.nouveauOrdinateur_administrateur"); });
Route::get("/nouveauOrdinateur_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauOrdinateur_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'un magasin
Route::get("/nouveauMagasin_administrateur", function(){ return view("authentification.administrateur.magasin.nouveauMagasin_administrateur"); });
Route::get("/nouveauMagasin_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauMagasin_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'un service
Route::get("/nouveauService_administrateur", function(){ return view("authentification.administrateur.service.nouveauService_administrateur"); });
Route::get("/nouveauService_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauService_agent"); });

Route::get("/nouveauService1_administrateur", function(){ return view("authentification.administrateur.service.nouveauService1_administrateur"); });
Route::get("/nouveauService1_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauService1_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Pour la création d'une formation
Route::get("/nouveauFormation_administrateur", function(){ return view("authentification.administrateur.formation.nouveauFormation_administrateur"); });
Route::get("/nouveauFormation_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauFormation_agent"); });

Route::get("/nouveauFormation1_administrateur", function(){ return view("authentification.administrateur.formation.nouveauFormation1_administrateur"); });
Route::get("/nouveauFormation1_agent", function(){ return view("authentification.utilisateur.agent.creates.nouveauFormation1_agent"); });
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouvelle localisation
Route::post('/storeLocalisation_administrateur', [\App\Http\Controllers\api\LocalisationAPIController::class, 'storeLocalisation_administrateur'])->name('storeLocalisation_administrateur');
Route::post('/storeLocalisation_agent', [\App\Http\Controllers\api\LocalisationAPIController::class, 'storeLocalisation_agent'])->name('storeLocalisation_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouvelle electromenager
Route::post('/storeElectromenager_administrateur', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'storeElectromenager_administrateur'])->name('storeElectromenager_administrateur');
Route::post('/storeElectromenager_agent', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'storeElectromenager_agent'])->name('storeElectromenager_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouvelle ordinateur
Route::post('/storeOrdinateur_administrateur', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'storeOrdinateur_administrateur'])->name('storeOrdinateur_administrateur');
Route::post('/storeOrdinateur_agent', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'storeOrdinateur_agent'])->name('storeOrdinateur_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouvel magasin
Route::post('/storeMagasin_administrateur', [\App\Http\Controllers\api\MagasinAPIController::class, 'storeMagasin_administrateur'])->name('storeMagasin_administrateur');
Route::post('/storeMagasin_agent', [\App\Http\Controllers\api\MagasinAPIController::class, 'storeMagasin_administrateur'])->name('storeMagasin_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouveau service
Route::post('/storeService_administrateur', [\App\Http\Controllers\api\ServiceAPIController::class, 'storeService_administrateur'])->name('storeService_administrateur');
Route::post('/storeService_agent', [\App\Http\Controllers\api\ServiceAPIController::class, 'storeService_agent'])->name('storeService_agent');

Route::post('/storeService1_administrateur', [\App\Http\Controllers\api\Service1APIController::class, 'storeService1_administrateur'])->name('storeService1_administrateur');
Route::post('/storeService1_agent', [\App\Http\Controllers\api\Service1APIController::class, 'storeService1_agent'])->name('storeService1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Nouvelle formation
Route::post('/storeFormation_administrateur', [\App\Http\Controllers\api\FormationAPIController::class, 'storeFormation_administrateur'])->name('storeFormation_administrateur');
Route::post('/storeFormation_agent', [\App\Http\Controllers\api\FormationAPIController::class, 'storeFormation_agent'])->name('storeFormation_agent');

Route::post('/storeFormation1_administrateur', [\App\Http\Controllers\api\Formation1APIController::class, 'storeFormation1_administrateur'])->name('storeFormation1_administrateur');
Route::post('/storeFormation1_agent', [\App\Http\Controllers\api\Formation1APIController::class, 'storeFormation1_agent'])->name('storeFormation1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Ajout d'une route pour le fichier d'erreur personnalisé
Route::get('error', function () { return view('authentification.error'); })->name('error');
Route::get('error_agent', function () { return view('authentification.error_agent'); })->name('error_agent');
Route::get('error_administrateur', function () { return view('authentification.error_administrateur'); })->name('error_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Authentification des utilisateurs et des administrateurs
Route::post('/login', [\App\Http\Controllers\api\UserAPIController::class, 'login'])->name('utilisateur.login');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Choisir la plage horaire
Route::post('/set-time', [\App\Http\Controllers\api\TokenAPIController::class, 'setTime'])->name('setTime');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Gestion du temps des utilisateurs
Route::post('storeTimeClient', [\App\Http\Controllers\api\TokenAPIController::class, 'storeTimeClient'])->name('storeTimeClient');
Route::post('storeTimeAgent', [\App\Http\Controllers\api\TokenAPIController::class, 'storeTimeAgent'])->name('storeTimeAgent');
Route::post('storeTimeAdministrateur', [\App\Http\Controllers\api\TokenAPIController::class, 'storeTimeAdministrateur'])->name('storeTimeAdministrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Gestion des tokens
Route::get('tokenClient', function () { return view('authentification.utilisateur.client.tokenClient'); })->name('tokenClient');
Route::get('tokenAgent', function () { return view('authentification.utilisateur.agent.tokenAgent'); })->name('tokenAgent');
Route::get('tokenAdministrateur', function () { return view('authentification.administrateur.tokenAdministrateur'); })->name('tokenAdministrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de l'acteur (client ou agent ou administrateur)
Route::get("/search_client", [\App\Http\Controllers\api\UserAPIController::class, 'search_client'])->name('search_client');
Route::get("/searchClient_agent", [\App\Http\Controllers\api\UserAPIController::class, 'searchClient_agent'])->name('searchClient_agent');
Route::get("/searchAgent_agent", [\App\Http\Controllers\api\UserAPIController::class, 'searchAgent_agent'])->name('searchAgent_agent');
Route::get("/searchClient_administrateur", [\App\Http\Controllers\api\UserAPIController::class, 'searchClient_administrateur'])->name('searchClient_administrateur');
Route::get("/searchAgent_administrateur", [\App\Http\Controllers\api\UserAPIController::class, 'searchAgent_administrateur'])->name('searchAgent_administrateur');
Route::get("/searchAdministrateur_administrateur", [\App\Http\Controllers\api\UserAPIController::class, 'searchAdministrateur_administrateur'])->name('searchAdministrateur_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de la localisation
Route::get("/searchLocalisation_administrateur", [\App\Http\Controllers\api\LocalisationAPIController::class, 'searchLocalisation_administrateur'])->name('searchLocalisation_administrateur');
Route::get("/searchLocalisation_agent", [\App\Http\Controllers\api\LocalisationAPIController::class, 'searchLocalisation_agent'])->name('searchLocalisation_agent');
Route::get("/searchLocalisation_client", [\App\Http\Controllers\api\LocalisationAPIController::class, 'searchLocalisation_client'])->name('searchLocalisation_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de la service et service1
Route::get("/searchService_administrateur", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_administrateur'])->name('searchService_administrateur');
Route::get("/searchService_agent", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_agent'])->name('searchService_agent');
Route::get("/searchService_client", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_client'])->name('searchService_client');
Route::get("/searchService1_administrateur", [\App\Http\Controllers\api\Service1APIController::class, 'searchService1_administrateur'])->name('searchService1_administrateur');
Route::get("/searchService1_agent", [\App\Http\Controllers\api\Service1APIController::class, 'searchService1_agent'])->name('searchService1_agent');
Route::get("/searchService1_client", [\App\Http\Controllers\api\Service1APIController::class, 'searchService1_agent'])->name('searchService1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de la electromenager
Route::get("/searchLElectromenager_administrateur", [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'searchLElectromenager_administrateur'])->name('searchLElectromenager_administrateur');
Route::get("/searchElectromenager_agent", [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'searchElectromenager_agent'])->name('searchElectromenager_agent');
Route::get("/searchElectromenager_client", [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'searchElectromenager_agent'])->name('searchElectromenager_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de la ordinateur
Route::get("/searchOrdinateur_administrateur", [\App\Http\Controllers\api\OrdinateurAPIController::class, 'searchOrdinateur_administrateur'])->name('searchOrdinateur_administrateur');
Route::get("/searchOrdinateur_agent", [\App\Http\Controllers\api\OrdinateurAPIController::class, 'searchOrdinateur_agent'])->name('searchOrdinateur_agent');
Route::get("/searchOrdinateur_client", [\App\Http\Controllers\api\OrdinateurAPIController::class, 'searchOrdinateur_client'])->name('searchOrdinateur_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche de la Magasin
Route::get("/searchMagasin_administrateur", [\App\Http\Controllers\api\MagasinAPIController::class, 'searchMagasin_administrateur'])->name('searchMagasin_administrateur');
Route::get("/searchMagasin_agent", [\App\Http\Controllers\api\MagasinAPIController::class, 'searchMagasin_agent'])->name('searchMagasin_agent');
Route::get("/searchMagasin_client", [\App\Http\Controllers\api\MagasinAPIController::class, 'searchMagasin_client'])->name('searchMagasin_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche du service
Route::get("/searchService_administrateur", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_administrateur'])->name('searchService_administrateur');
Route::get("/searchService_agent", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_agent'])->name('searchService_agent');
Route::get("/searchService_client", [\App\Http\Controllers\api\ServiceAPIController::class, 'searchService_client'])->name('searchService_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche du service Ordinateur
Route::get("/FiltreServiceOrdinateur_administrateur", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceOrdinateur_administrateur'])->name('FiltreServiceOrdinateur_administrateur');
Route::get("/FiltreServiceOrdinateur_agent", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceOrdinateur_agent'])->name('FiltreServiceOrdinateur_agent');
Route::get("/FiltreServiceOrdinateur_client", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceOrdinateur_client'])->name('FiltreServiceOrdinateur_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Recherche du service informatique
Route::get("/FiltreServiceElectromenager_administrateur", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceElectromenager_administrateur'])->name('FiltreServiceElectromenager_administrateur');
Route::get("/FiltreServiceElectromenager_agent", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceElectromenager_agent'])->name('FiltreServiceElectromenager_agent');
Route::get("/FiltreServiceElectromenager_client", [\App\Http\Controllers\api\ServiceAPIController::class, 'FiltreServiceElectromenager_client'])->name('FiltreServiceElectromenager_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer (client ou agent ou administrateur)
Route::get('/deleteClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyClient_administrateur'])->name('deleteClient_administrateur');
Route::get('/deleteAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyAgent_administrateur'])->name('deleteAgent_administrateur');
Route::get('/deleteAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyAdministrateur_administrateur'])->name('deleteAdministrateur_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer (service et service1)
Route::get('/deleteService_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyService_administrateur'])->name('deleteService_administrateur');
Route::get('/deleteService_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyService_agent'])->name('deleteService_agent');
Route::get('/deleteService1_administrateur/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'destroyService1_administrateur'])->name('deleteService1_administrateur');
Route::get('/deleteService1_agent/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'destroyService1_agent'])->name('deleteService1_agent');
//_______________________________________________________________________________-






//_______________________________________________________________________________-
// Supprimer la liste dans les listes (client ou agent ou administrateur)
Route::get('/deleteDetailsAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyDetailsAdministrateur_administrateur'])->name('deleteDetailsAdministrateur_administrateur');
Route::get('/deleteDetailsAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyDetailsAgent_administrateur'])->name('deleteDetailsAgent_administrateur');
Route::get('/deleteDetailsClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'destroyDetailsClient_administrateur'])->name('deleteDetailsClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer la localisation
Route::get('/deleteLocalisation_administrateur/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'destroyLocalisation_administrateur'])->name('deleteLocalisation_administrateur');
Route::get('/deleteLocalisation_agent/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'destroyLocalisation_agent'])->name('deleteLocalisation_agent');
Route::get('/deleteLocalisation_client/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'destroyLocalisation_client'])->name('deleteLocalisation_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer la electromenager
Route::get('/deleteElectromenager_administrateur/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'destroyElectromenager_administrateur'])->name('deleteElectromenager_administrateur');
Route::get('/deleteElectromenager_agent/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'destroyElectromenager_agent'])->name('deleteElectromenager_agent');
Route::get('/deleteElectromenager_client/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'destroyElectromenager_client'])->name('deleteElectromenager_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer la ordinateur
Route::get('/deleteOrdinateur_administrateur/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'destroyOrdinateur_administrateur'])->name('deleteOrdinateur_administrateur');
Route::get('/deleteOrdinateur_agent/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'destroyOrdinateur_agent'])->name('deleteOrdinateur_agent');
Route::get('/deleteOrdinateur_client/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'destroyOrdinateur_client'])->name('deleteOrdinateur_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer la Magasin
Route::get('/deleteMagasin_administrateur/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'destroyMagasin_administrateur'])->name('deleteMagasin_administrateur');
Route::get('/deleteMagasin_agent/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'destroyMagasin_agent'])->name('deleteMagasin_agent');
Route::get('/deleteMagasin_client/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'destroyMagasin_client'])->name('deleteMagasin_client');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer le service
Route::get('/deleteService_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyService_administrateur'])->name('deleteService_administrateur');
Route::get('/deleteService_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyService_agent'])->name('deleteService_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer le service "Informatique"
Route::get('/deleteServiceInformatique_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyServiceInformatique_administrateur'])->name('deleteServiceInformatique_administrateur');
Route::get('/deleteServiceInformatique_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyServiceInformatique_agent'])->name('deleteServiceInformatique_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer le service "Electromenager"
Route::get('/deleteServiceElectromenager_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyServiceElectromenager_administrateur'])->name('deleteServiceElectromenager_administrateur');
Route::get('/deleteServiceElectromenager_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'destroyServiceElectromenager_agent'])->name('deleteServiceElectromenager_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Supprimer la formation "Vidéo ou pdf" 
Route::get('/deleteFormation_administrateur/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'destroyFormation_administrateur'])->name('deleteFormation_administrateur');
Route::get('/deleteFormation_agent/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'destroyFormation_agent'])->name('deleteFormation_agent');

Route::get('/deleteFormation1_administrateur/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'destroyFormation1_administrateur'])->name('deleteFormation1_administrateur');
Route::get('/deleteFormation1_agent/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'destroyFormation1_agent'])->name('deleteFormation1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer (client ou agent ou administrateur)
Route::get('/editAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editAgent_administrateur'])->name('editAgent_administrateur');
Route::get('/editAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editAdministrateur_administrateur'])->name('editAdministrateur_administrateur');
Route::get('/editClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editClient_administrateur'])->name('editClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer (service et service1)
Route::get('/editService_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'editService_administrateur'])->name('editService_administrateur');
Route::get('/editService_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'editService_agent'])->name('editService_agent');

Route::get('/editService1_administrateur/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'editService1_administrateur'])->name('editService1_administrateur');
Route::get('/editService1_agent/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'editService1_agent'])->name('editService1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer (formation et formation1)
Route::get('/editFormation_administrateur/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'editFormation_administrateur'])->name('editFormation_administrateur');
Route::get('/editFormation_agent/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'editFormation_agent'])->name('editFormation_agent');

Route::get('/editFormation1_administrateur/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'editFormation1_administrateur'])->name('editFormation1_administrateur');
Route::get('/editFormation1_agent/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'editFormation1_agent'])->name('editFormation1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer la liste dans les listes (client ou agent ou administrateur)
Route::get('/editDetailsAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editDetailsAgent_administrateur'])->name('editDetailsAgent_administrateur');
Route::get('/editDetailsAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editDetailsAdministrateur_administrateur'])->name('editDetailsAdministrateur_administrateur');
Route::get('/editDetailsClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'editDetailsClient_administrateur'])->name('editDetailsClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer la localisation
Route::get('/editLocalisation_administrateur/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'editLocalisation_administrateur'])->name('editLocalisation_administrateur');
Route::get('/editLocalisation_agent/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'editLocalisation_agent'])->name('editLocalisation_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer la electromenager
Route::get('/editElectromenager_administrateur/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'editElectromenager_administrateur'])->name('editElectromenager_administrateur');
Route::get('/editElectromenager_agent/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'editElectromenager_agent'])->name('editElectromenager_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer la ordinateur
Route::get('/editOrdinateur_administrateur/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'editOrdinateur_administrateur'])->name('editOrdinateur_administrateur');
Route::get('/editOrdinateur_agent/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'editOrdinateur_agent'])->name('editOrdinateur_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Editer la Magasin
Route::get('/editMagasin_administrateur/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'editMagasin_administrateur'])->name('editMagasin_administrateur');
Route::get('/editMagasin_agent/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'editMagasin_agent'])->name('editMagasin_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour (client ou agent ou administrateur)
Route::post('/updateAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateAdministrateur_administrateur'])->name('updateAdministrateur_administrateur');
Route::post('/updateAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateAgent_administrateur'])->name('updateAgent_administrateur');
Route::post('/updateClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateClient_administrateur'])->name('updateClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour (service et service1)
Route::post('/updateService_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'updateService_administrateur'])->name('updateService_administrateur');
Route::post('/updateService_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'updateService_agent'])->name('updateService_agent');

Route::post('/updateService1_administrateur/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'updateService1_administrateur'])->name('updateService1_administrateur');
Route::post('/updateService1_agent/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'updateService1_agent'])->name('updateService1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour (formation et formation1)
Route::post('/updateFormation_administrateur/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'updateFormation_administrateur'])->name('updateFormation_administrateur');
Route::post('/updateFormation_agent/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'updateFormation_agent'])->name('updateFormation_agent');

Route::post('/updateFormation1_administrateur/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'updateFormation1_administrateur'])->name('updateFormation1_administrateur');
Route::post('/updateFormation1_agent/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'updateFormation1_agent'])->name('updateFormation1_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour la liste dans les listes (client ou agent ou administrateur)
Route::post('/updateDetailsAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateDetailsAdministrateur_administrateur'])->name('updateDetailsAdministrateur_administrateur');
Route::post('/updateDetailsAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateDetailsAgent_administrateur'])->name('updateDetailsAgent_administrateur');
Route::post('/updateDetailsClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'updateDetailsClient_administrateur'])->name('updateDetailsClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour de la localisation
Route::post('/updateLocalisation_administrateur/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'updateLocalisation_administrateur'])->name('updateLocalisation_administrateur');
Route::post('/updateLocalisation_agent/{id_localisation}', [\App\Http\Controllers\api\LocalisationAPIController::class, 'updateLocalisation_agent'])->name('updateLocalisation_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour de la electromenager
Route::post('/updateElectromenager_administrateur/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'updateElectromenager_administrateur'])->name('updateElectromenager_administrateur');
Route::post('/updateElectromenager_agent/{id_electromenager}', [\App\Http\Controllers\api\ElectromenagerAPIController::class, 'updateElectromenager_administrateur'])->name('updateElectromenager_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour de la ordinateur
Route::post('/updateOrdinateur_administrateur/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'updateOrdinateur_administrateur'])->name('updateOrdinateur_administrateur');
Route::post('/updateOrdinateur_agent/{id_ordinateur}', [\App\Http\Controllers\api\OrdinateurAPIController::class, 'updateOrdinateur_agent'])->name('updateOrdinateur_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Mise à jour de la Magasin
Route::post('/updateMagasin_administrateur/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'updateMagasin_administrateur'])->name('updateMagasin_administrateur');
Route::post('/updateMagasin_agent/{id_magasin}', [\App\Http\Controllers\api\MagasinAPIController::class, 'updateMagasin_agent'])->name('updateMagasin_agent');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Open (client ou agent ou administrateur)
Route::get('/OpenAdministrateur_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'OpenAdministrateur_administrateur'])->name('OpenAdministrateur_administrateur');
Route::get('/OpenAgent_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'OpenAgent_administrateur'])->name('OpenAgent_administrateur');
Route::get('/OpenClient_administrateur/{matricule}', [\App\Http\Controllers\api\UserAPIController::class, 'OpenClient_administrateur'])->name('OpenClient_administrateur');
//_______________________________________________________________________________-





//_______________________________________________________________________________-
// Open (electromenager ou ordinateur)
Route::get('/OpenService_administrateur/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'OpenService_administrateur'])->name('OpenService_administrateur');
Route::get('/OpenService_agent/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'OpenService_agent'])->name('OpenService_agent');
Route::get('/OpenService_client/{id_service}', [\App\Http\Controllers\api\ServiceAPIController::class, 'OpenService_client'])->name('OpenService_client');

Route::get('/OpenService1_administrateur/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'OpenService1_administrateur'])->name('OpenService1_administrateur');
Route::get('/OpenService1_agent/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'OpenService1_agent'])->name('OpenService1_agent');
Route::get('/OpenService1_client/{id_service1}', [\App\Http\Controllers\api\Service1APIController::class, 'OpenService1_client'])->name('OpenService1_client');
//_______________________________________________________________________________-






//_______________________________________________________________________________-
// Open (video ou pdf)
Route::get('/OpenFormation_administrateur/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'OpenFormation_administrateur'])->name('OpenFormation_administrateur');
Route::get('/OpenFormation_agent/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'OpenFormation_agent'])->name('OpenFormation_agent');
Route::get('/OpenFormation_client/{id_formation}', [\App\Http\Controllers\api\FormationAPIController::class, 'OpenFormation_client'])->name('OpenFormation_client');

Route::get('/OpenFormation1_administrateur/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'OpenFormation1_administrateur'])->name('OpenFormation1_administrateur');
Route::get('/OpenFormation1_agent/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'OpenFormation1_agent'])->name('OpenFormation1_agent');
Route::get('/OpenFormation1_client/{id_formation1}', [\App\Http\Controllers\api\Formation1APIController::class, 'OpenFormation1_client'])->name('OpenFormation1_client');
//_______________________________________________________________________________-



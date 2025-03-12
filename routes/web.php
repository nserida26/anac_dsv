<?php

use App\Http\Controllers\Admin\AutoriteController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');

        Route::get('/errors/500', function () {
            return view('errors.500');
        })->name('errors.500');
        Auth::routes();
        Route::middleware(['auth:web'])->group(function () {
            Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
        });
        Route::middleware(['auth:web', 'role:daf'])
            ->prefix('daf')
            ->group(function () {

                Route::get('/', [App\Http\Controllers\DafController::class, 'index'])->name('daf');
                Route::get('/create/{ordre}', [App\Http\Controllers\DafController::class, 'create'])->name('daf.create');
                Route::get('/edit/{facture}', [App\Http\Controllers\DafController::class, 'edit'])->name('daf.edit');
                Route::get('/show/{paiement}', [App\Http\Controllers\DafController::class, 'show'])->name('daf.show');
                Route::post('/store', [App\Http\Controllers\DafController::class, 'store'])->name('daf.store');
                Route::post('/update/{facture}', [App\Http\Controllers\DafController::class, 'update'])->name('daf.update');
                Route::delete('/destroy/{facture}', [App\Http\Controllers\DafController::class, 'destroy'])
                    ->name('daf.destroy');
                Route::patch('/valider/{facture}', [App\Http\Controllers\DafController::class, 'valider'])->name('daf.valider');
                Route::patch('/valider_paiement/{paiement}', [App\Http\Controllers\DafController::class, 'validerPaiement'])->name('daf.valider_paiement');
            });
        Route::middleware(['auth:web', 'role:dg|dsv'])
            ->prefix('dir')
            ->group(function () {
                Route::get('/dsv', [App\Http\Controllers\DgDsvController::class, 'index'])->name('dsv');
                Route::get('/dsv/show/{id}', [App\Http\Controllers\DgDsvController::class, 'show'])->name('dsv.show');


                Route::get('/dsv/create/{id}', [App\Http\Controllers\DgDsvController::class, 'create'])->name('dsv.create');
                Route::post('/dsv/store', [App\Http\Controllers\DgDsvController::class, 'store'])->name('dsv.store');
                Route::get('/dsv/edit/{ordre}', [App\Http\Controllers\DgDsvController::class, 'edit'])->name('dsv.edit');
                Route::post('/ordre/update/{ordre}', [App\Http\Controllers\DgDsvController::class, 'update'])->name('dsv.ordre.update');
                Route::patch('/ordre/valider/{ordre}', [App\Http\Controllers\DgDsvController::class, 'valider'])->name('dsv.ordre.valider');
                Route::delete('/ordre/destroy/{ordre}', [App\Http\Controllers\DgDsvController::class, 'destroy'])
                    ->name('dsv.ordre.destroy');

                Route::patch('/dsv/annoter/{id}', [App\Http\Controllers\DgDsvController::class, 'annoterDemandeDSVtoPEL'])->name('dsv.annoter');
                Route::patch('/dsv/valider/{id}', [App\Http\Controllers\DgDsvController::class, 'validerDsv'])->name('dsv.valider');
                Route::patch('/dsv/rejeter/{id}', [App\Http\Controllers\DgDsvController::class, 'rejeterDSV'])->name('dsv.rejeter');
                Route::patch('/dsv/signer/{id}', [App\Http\Controllers\DgDsvController::class, 'signerDsv'])->name('dsv.signer');

                Route::get('/dg', [App\Http\Controllers\DgDsvController::class, 'index'])->name('dg');
                Route::get('/dg/show/{id}', [App\Http\Controllers\DgDsvController::class, 'show'])->name('dg.show');
                Route::patch('/dg/annoter/{id}', [App\Http\Controllers\DgDsvController::class, 'annoterDemandeDGtoDSV'])->name('dg.annoter');
                Route::patch('/dg/valider/{id}', [App\Http\Controllers\DgDsvController::class, 'validerDg'])->name('dg.valider');
                Route::patch('/dg/rejeter/{id}', [App\Http\Controllers\DgDsvController::class, 'rejeter'])->name('dg.rejeter');
                Route::patch('/dg/signer/{id}', [App\Http\Controllers\DgDsvController::class, 'signerDg'])->name('dg.signer');

                Route::post('/store', [App\Http\Controllers\DgDsvController::class, 'store_sc'])->name('dir.store');
                Route::get('/', [App\Http\Controllers\DgDsvController::class, 'sc'])->name('dir');
            });
        Route::middleware(['auth:web', 'role:centre'])
            ->prefix('centre')
            ->group(function () {

                Route::get('/', [App\Http\Controllers\CentreFormationController::class, 'index'])->name('centre');
                Route::get('/create/{demandeur}', [App\Http\Controllers\CentreFormationController::class, 'create'])->name('centre.create');
                Route::post('/store', [App\Http\Controllers\CentreFormationController::class, 'store'])->name('centre.store');
                Route::put('/update/{formation}', [App\Http\Controllers\CentreFormationController::class, 'update'])->name('centre.update');
                Route::delete('/destroy/{formation}', [App\Http\Controllers\CentreFormationController::class, 'destroy'])
                    ->name('centre.destroy');
            });
        Route::middleware(['auth:web', 'role:compagnie'])
            ->prefix('compagnie')
            ->group(function () {
                Route::get('/payer/{paiement}', [App\Http\Controllers\CompagnieController::class, 'pay'])->name('compagnie.pay');
                Route::post('/update/{paiement}', [App\Http\Controllers\CompagnieController::class, 'update'])->name('compagnie.update');
                Route::patch('/valider/{demandeur}', [App\Http\Controllers\CompagnieController::class, 'valider'])->name('compagnie.valider');
                Route::get('/', [App\Http\Controllers\CompagnieController::class, 'index'])->name('compagnie');
            });
        Route::middleware(['auth:web', 'role:examinateur'])
            ->prefix('examinateur')
            ->group(function () {

                Route::get('/', [App\Http\Controllers\ExaminateurController::class, 'index'])->name('examinateur');
                Route::get('/create/{demandeur}', [App\Http\Controllers\ExaminateurController::class, 'create'])->name('examinateur.create');
                Route::get('/edit/{examen}', [App\Http\Controllers\ExaminateurController::class, 'edit'])->name('examinateur.edit');
                Route::get('/show/{examen}', [App\Http\Controllers\ExaminateurController::class, 'show'])->name('examinateur.show');
                Route::post('/store', [App\Http\Controllers\ExaminateurController::class, 'store'])->name('examinateur.store');
                Route::post('/update/{examen}', [App\Http\Controllers\ExaminateurController::class, 'update'])->name('examinateur.update');
                Route::delete('/destroy/{examen}', [App\Http\Controllers\ExaminateurController::class, 'destroy'])
                    ->name('examinateur.destroy');
                Route::patch('/valider/{examen}', [App\Http\Controllers\ExaminateurController::class, 'valider'])->name('examinateur.valider');
            });



        Route::middleware(['auth:web', 'role:evaluateur'])
            ->prefix('evaluateur')
            ->group(function () {

                Route::get('/', [App\Http\Controllers\EvaluateurController::class, 'index'])->name('evaluateur');
                Route::get('/edit/{examen}', [App\Http\Controllers\EvaluateurController::class, 'edit'])->name('evaluateur.edit');
                Route::get('/show/{examen}', [App\Http\Controllers\EvaluateurController::class, 'show'])->name('evaluateur.show');
                Route::post('/update/{examen}', [App\Http\Controllers\EvaluateurController::class, 'update'])->name('evaluateur.update');
                Route::patch('/valider/{examen}', [App\Http\Controllers\EvaluateurController::class, 'valider'])->name('evaluateur.valider');
            });

        Route::middleware(['auth:web', 'role:sma|sla'])
            ->prefix('sec')
            ->group(function () {
                Route::get('/sma', [App\Http\Controllers\SmaSlaController::class, 'index'])->name('sma');
                Route::get('/sma/show/{id}', [App\Http\Controllers\SmaSlaController::class, 'show'])->name('sma.show');
                Route::patch('/sma/valider/{id}', [App\Http\Controllers\SmaSlaController::class, 'validerSma'])->name('sma.valider');

                Route::get('/sla', [App\Http\Controllers\SmaSlaController::class, 'index'])->name('sla');
                Route::get('/sla/show/{id}', [App\Http\Controllers\SmaSlaController::class, 'show'])->name('sla.show');
                Route::patch('/sla/valider/{id}', [App\Http\Controllers\SmaSlaController::class, 'validerSla'])->name('sla.valider');
                Route::patch('/rejeter/{table}/{id}/{demande}', [App\Http\Controllers\SmaSlaController::class, 'rejeter'])->name('rejeter');

                //valider
                Route::patch('/sma/valider_examen/{examen}', [App\Http\Controllers\SmaSlaController::class, 'valider'])->name('sma.valider_examen');
            });
        Route::middleware(['auth:web', 'role:user'])
            ->prefix('user')
            ->group(function () {

                Route::get('/profile', [App\Http\Controllers\DemandeurController::class, 'index'])->name('user.profile');
                Route::post('/profile/update', [App\Http\Controllers\DemandeurController::class, 'store'])->name('user.profile.update');
                Route::get('/', [App\Http\Controllers\DemandeController::class, 'index'])->name('user');
                Route::get('/create', [App\Http\Controllers\DemandeController::class, 'create'])->name('user.create');

                Route::get('/payer/{paiement}', [App\Http\Controllers\DemandeController::class, 'pay'])->name('user.pay');
                Route::post('/update/{paiement}', [App\Http\Controllers\DemandeController::class, 'update'])->name('user.update');

                Route::get('/edit/{id}', [App\Http\Controllers\DemandeController::class, 'edit'])->name('user.edit');
                Route::post('/store', [App\Http\Controllers\DemandeController::class, 'store'])->name('user.store');


                Route::delete('/destroy/{id}', [App\Http\Controllers\DemandeController::class, 'destroy'])
                    ->name('user.destroy');
                Route::patch('/validate/{id}', [App\Http\Controllers\DemandeController::class, 'validateDemande'])->name('user.validate');

                Route::post('/store_licences', [App\Http\Controllers\DemandeController::class, 'storeLicences'])->name('user.store_licences');

                Route::put('/update_licences/{licence_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateLicences'])->name('user.update_licences');
                Route::delete('/destroy_licences/{licence_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyLicences'])
                    ->name('user.destroy_licences');

                Route::post('/store_qualifications', [App\Http\Controllers\DemandeController::class, 'storeQualifications'])->name('user.store_qualifications');
                Route::put('/update_qualifications/{qualification_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateQualifications'])->name('user.update_qualifications');
                Route::delete('/destroy_qualifications/{qualification_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyQualifications'])
                    ->name('user.destroy_qualifications');

                Route::post('/store_aptitudes', [App\Http\Controllers\DemandeController::class, 'storeAptitudes'])->name('user.store_aptitudes');

                Route::put('/update_aptitudes/{medical_examination}', [App\Http\Controllers\DemandeController::class, 'updateAptitudes'])->name('user.update_aptitudes');

                Route::delete('/destroy_aptitudes/{medical_examination}', [App\Http\Controllers\DemandeController::class, 'destroyAptitudes'])
                    ->name('user.destroy_aptitudes');
                Route::post('/store_expriences', [App\Http\Controllers\DemandeController::class, 'storeExpriences'])->name('user.store_experiences');

                Route::put('/update_experiences/{experience_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateExpriences'])->name('user.update_experiences');

                Route::delete('/destroy_experiences/{experience_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyExpriences'])
                    ->name('user.destroy_experiences');
                Route::post('/store_competences', [App\Http\Controllers\DemandeController::class, 'storeCompetences'])->name('user.store_competences');

                Route::put('/update_competences/{competence_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateCompetences'])->name('user.update_competences');

                Route::delete('/destroy_competences/{competence_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyCompetences'])
                    ->name('user.destroy_competences');
                Route::post('/store_entrainements', [App\Http\Controllers\DemandeController::class, 'storeEntrainements'])->name('user.store_entrainements');

                Route::put('/update_entrainements/{entrainement_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateEntrainements'])->name('user.update_entrainements');

                Route::delete('/destroy_entrainements/{entrainement_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyEntrainements'])
                    ->name('user.destroy_entrainements');
                Route::post('/store_documents', [App\Http\Controllers\DemandeController::class, 'storeDocuments'])->name('user.store_documents');

                Route::put('/update_documents/{document}', [App\Http\Controllers\DemandeController::class, 'updateDocuments'])->name('user.update_documents');

                Route::delete('/destroy_documents/{document}', [App\Http\Controllers\DemandeController::class, 'destroyDocuments'])
                    ->name('user.destroy_documents');
                Route::post('/store_formations', [App\Http\Controllers\DemandeController::class, 'storeFormations'])->name('user.store_formations');
                Route::put('/update_formations/{formation}', [App\Http\Controllers\DemandeController::class, 'updateFormations'])->name('user.update_formations');
                Route::delete('/destroy_formations/{formation}', [App\Http\Controllers\DemandeController::class, 'destroyFormations'])
                    ->name('user.destroy_formations');

                Route::post('/store_interruptions', [App\Http\Controllers\DemandeController::class, 'storeInterruptions'])->name('user.store_interruptions');

                Route::put('/update_interruptions/{interruption_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateInterruptions'])->name('user.update_interruptions');

                Route::delete('/destroy_interruptions/{interruption_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyInterruptions'])
                    ->name('user.destroy_interruptions');
                Route::post('/store_maintenances', [App\Http\Controllers\DemandeController::class, 'storeMaintenances'])->name('user.store_maintenances');

                Route::put('/update_maintenances', [App\Http\Controllers\DemandeController::class, 'storeMaintenances'])->name('user.update_maintenances');

                Route::delete('/destroy_maintenances/{experience_maintenance_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyMaintenances'])
                    ->name('user.destroy_maintenances');

                Route::post('/store_employeurs', [App\Http\Controllers\DemandeController::class, 'storeEmployeurs'])->name('user.store_employeurs');

                Route::put('/update_employeurs/{employeur_demandeur}', [App\Http\Controllers\DemandeController::class, 'updateEmployeurs'])->name('user.update_employeurs');

                Route::delete('/destroy_employeurs/{employeur_demandeur}', [App\Http\Controllers\DemandeController::class, 'destroyEmployeurs'])
                    ->name('user.destroy_employeurs');
            });

        Route::middleware(['auth:web', 'role:admin'])
            ->prefix('admin')
            ->group(function () {

                Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
                Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');

                Route::get('/demandes', [App\Http\Controllers\AdminController::class, 'index'])->name('demandes');
                Route::get('/demandes/show/{id}', [App\Http\Controllers\AdminController::class, 'show'])->name('demandes.show');
                Route::patch('/demandes/annoter/{id}', [App\Http\Controllers\AdminController::class, 'annoterDemande'])->name('admin.annoter');
                Route::patch('/demandes/valider/{id}', [App\Http\Controllers\AdminController::class, 'valider'])->name('admin.valider');
                Route::post('/demandes/update/{demande}', [App\Http\Controllers\AdminController::class, 'update'])->name('demandes.update');

                Route::get('/licences', [App\Http\Controllers\AdminController::class, 'licences'])->name('licences');
                Route::get('/licences/show/{licence}', [App\Http\Controllers\AdminController::class, 'showLicence'])->name('licences.show');
                Route::post('/licences/update/{licence}', [App\Http\Controllers\AdminController::class, 'updateLicence'])->name('licences.update');
                Route::patch('/licences/valider/{licence}', [App\Http\Controllers\AdminController::class, 'validerLicence'])->name('licences.valider');

                Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
                Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

                Route::resource('roles', RoleController::class);
                Route::resource('users', UserController::class);
                Route::resource('qualifications', QualificationController::class);
                Route::resource('autorites', AutoriteController::class);

                Route::post('users/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('users.assign-roles');
            });
        Route::middleware(['auth:web', 'role:agent'])
            ->prefix('agent')
            ->group(function () {

                Route::get('/', [App\Http\Controllers\AgentController::class, 'index'])->name('agent');
                Route::get('/imprimer/{id}', [App\Http\Controllers\AgentController::class, 'imprimer'])->name('agent.imprimer');
                Route::patch('/valider/{id}', [App\Http\Controllers\AgentController::class, 'valider'])->name('agent.valider');
            });
    }
);

// Rida
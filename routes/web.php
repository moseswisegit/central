<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParoisseController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\User\LettresController;
use App\Http\Controllers\User\ProduitsController;
use App\Http\Controllers\User\CategorieController;
use App\Http\Controllers\User\FournisseurController;
use App\Http\Controllers\SuperAdmin\ProgrammeBiblique;

Route::get('/', function () { 
    // return redirect('/dashboard/home'); 
    return view('accueil');
})->name("accueil");
Route::get('/dashboard/home', 'HomeController@index');
Route::get('/paroisse/dirigeant', 'AccueilController@dirigeant_paroisse')->name('paroisse_dirigeant');



// Authentication Routes...
$this->router->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->router->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->router->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->router->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->router->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
// $this->router->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
// $this->router->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
// $this->router->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->router->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
// $this->router->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
// $this->router->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth'], 'prefix' => '²', 'as' => 'superAdmin.'], function () {
    // Route::get('/home', 'HomeController@index');

    Route::resource('subscriptions', 'SuperAdmin\SubscriptionsController');
    Route::resource('payments', 'SuperAdmin\PaymentsController');
    Route::resource('roles', 'SuperAdmin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'SuperAdmin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'SuperAdmin\UsersController');

    Route::post('users_mass_destroy', ['uses' => 'SuperAdmin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('folders', 'SuperAdmin\FoldersController');
    Route::post('folders_mass_destroy', ['uses' => 'SuperAdmin\FoldersController@massDestroy', 'as' => 'folders.mass_destroy']);
    Route::post('folders_restore/{id}', ['uses' => 'SuperAdmin\FoldersController@restore', 'as' => 'folders.restore']);
    Route::delete('folders_perma_del/{id}', ['uses' => 'SuperAdmin\FoldersController@perma_del', 'as' => 'folders.perma_del']);
    Route::resource('files', 'SuperAdmin\FilesController');
    Route::get('/{uuid}/download', 'SuperAdmin\DownloadsController@download');
    Route::post('files_mass_destroy', ['uses' => 'SuperAdmin\FilesController@massDestroy', 'as' => 'files.mass_destroy']);
    Route::post('files_restore/{id}', ['uses' => 'SuperAdmin\FilesController@restore', 'as' => 'files.restore']);
    Route::delete('files_perma_del/{id}', ['uses' => 'SuperAdmin\FilesController@perma_del', 'as' => 'files.perma_del']);
    Route::post('/spatie/media/upload', 'SuperAdmin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'SuperAdmin\SpatieMediaController@destroy')->name('media.remove');

    Route::resource('pays', 'SuperAdmin\PaysController');
    Route::post('pays_mass_destroy', ['uses' => 'SuperAdmin\PaysController@massDestroy', 'as' => 'pays.mass_destroy']);
    Route::resource('ville', 'SuperAdmin\VilleController');
    Route::post('ville_mass_destroy', ['uses' => 'SuperAdmin\VilleController@massDestroy', 'as' => 'ville.mass_destroy']);
    Route::resource('commune', 'SuperAdmin\CommuneController');
    Route::post('commune_mass_destroy', ['uses' => 'SuperAdmin\CommuneController@massDestroy', 'as' => 'commune.mass_destroy']);
    Route::resource('quartier', 'SuperAdmin\QuartierController');
    Route::post('quartier_mass_destroy', ['uses' => 'SuperAdmin\QuartierController@massDestroy', 'as' => 'quartier.mass_destroy']);
   

    Route::resource('paroisse', 'SuperAdmin\ParoisseController');
    Route::post('paroisse_mass_destroy', ['uses' => 'SuperAdmin\ParoisseController@massDestroy', 'as' => 'paroisse.mass_destroy']);
    Route::resource('decision', 'SuperAdmin\DecisionController');
    Route::post('decision_mass_destroy', ['uses' => 'SuperAdmin\DecisionController@massDestroy', 'as' => 'decision.mass_destroy']);


    Route::get('changer-decision/{paroisseId}/{decisionId}', 'SuperAdmin\ParoisseController@changeDecision')->name('changer-decision');


    Route::post('send-whatsapp', 'SuperAdmin\WhatsAppController@send')->name("whatsapp.send");
    Route::post('send-sms', 'SuperAdmin\SmsController@send')->name("sms.send");

    Route::resource('gestion_programme', 'SuperAdmin\ProgrammeBiblique');

    Route::post('/texts-themes/store', [ProgrammeBiblique::class, 'store'])->name('textsThemes.store');
    Route::post('/texts-themes/update', [ProgrammeBiblique::class, 'update'])->name('textsThemes.update');
    Route::get('/texts-themes/events', [ProgrammeBiblique::class, 'getEvents'])->name('textsThemes.events');
    Route::delete('/texts-themes/destroy/{id}', [ProgrammeBiblique::class, 'destroy'])->name('textsThemes.destroy');

    

});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Route::get('/home', 'HomeController@index');

    Route::resource('subscriptions', 'Admin\SubscriptionsController');
    Route::resource('payments', 'Admin\PaymentsController');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('folders', 'Admin\FoldersController');
    Route::post('folders_mass_destroy', ['uses' => 'Admin\FoldersController@massDestroy', 'as' => 'folders.mass_destroy']);
    Route::post('folders_restore/{id}', ['uses' => 'Admin\FoldersController@restore', 'as' => 'folders.restore']);
    Route::delete('folders_perma_del/{id}', ['uses' => 'Admin\FoldersController@perma_del', 'as' => 'folders.perma_del']);
    Route::resource('files', 'Admin\FilesController');
    Route::get('/{uuid}/download', 'Admin\DownloadsController@download');
    Route::post('files_mass_destroy', ['uses' => 'Admin\FilesController@massDestroy', 'as' => 'files.mass_destroy']);
    Route::post('files_restore/{id}', ['uses' => 'Admin\FilesController@restore', 'as' => 'files.restore']);
    Route::delete('files_perma_del/{id}', ['uses' => 'Admin\FilesController@perma_del', 'as' => 'files.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

});




Route::get('/get-settings', [ParametreController::class, 'getSettings']);

Route::post('/sauvegarde_parametre', [ParametreController::class, 'sauvegardeParametre']);

Route::get('/user/profile',  [ParametreController::class, 'profile'])->name('admin.user.profile');

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::resource('categorie', 'User\CategorieController');
    Route::post('categorie_mass_destroy', [CategorieController::class, 'massDestroy'])->name('categorie.mass_destroy');
    Route::resource('fournisseur', 'User\FournisseurController');
    Route::post('fournisseur_mass_destroy', [FournisseurController::class, 'massDestroy'])->name('fournisseur.mass_destroy');
    Route::resource('produits', 'User\ProduitsController');

    Route::post('produits_mass_destroy', [ProduitsController::class, 'massDestroy'])->name('produits.mass_destroy');

    Route::get('obtenir-categories', [CategorieController::class, 'obtenirCategories'])->name('obtenir.categories');
    Route::get('obtenir-fournisseur', [FournisseurController::class, 'obtenirfournisseurs'])->name('obtenir.fournisseur');

    Route::get('lettres', [LettresController::class, 'decharge'])->name('decharge.index');
    Route::post('genererLettre', [LettresController::class, 'genererLettre'])->name('genererLettre');


    Route::post('generate-pdf',[LettresController::class, 'generatePDF'])->name('generate.pdf');


});


Route::get('download-pdf/{fileName}',[LettresController::class, 'downloadPDF'])->name('user.download.pdf');
// Route pour charger les villes
Route::get('/load-cities', 'SuperAdmin\LoadDataJson@loadCities')->name('load.cities');
Route::get('/load-phoneCode', 'SuperAdmin\LoadDataJson@loadPhoneCode')->name('load.phoneCode');

// Route pour charger les communes
Route::get('/load-communes', 'SuperAdmin\LoadDataJson@loadCommunes')->name('load.communes');
// Route pour charger les quartiers
Route::get('/load-quartiers', 'SuperAdmin\LoadDataJson@loadQuartiers')->name('load.quartiers');


Route::post('/enregistrer-paroisse', [ParoisseController::class, 'enregistrerParoisse'])->name('enregistrerParoisse');



<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success','UserController@success');
Route::resource('company', 'CompanyController');
Route::resource('users', 'UserController');
//pass in verify email option
Auth::routes(['verify' => true]);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');
});
//----------------------------------------------SuperAdminRoutes----------------------------------------------------------------------
Route::resource('superAdmin/addAdmin', 'App\Http\Controllers\AdminsController');
Route::resource('superAdmin/addCompany', 'App\Http\Controllers\CompanyController');
Route::resource('superAdmin',"App\Http\Controllers\SuperAdminController");

Route::get('/superAdmin/viewcustomersuperadmin/{id}', 'App\Http\Controllers\ViewCustomerSuperAController@show')->name('ViewAdmin');
Route::post('/superAdmin/viewcustomersuperadmin/update/{uid}', 'App\Http\Controllers\ViewCustomerSuperAController@update')->name('UpdateAdmin');
Route::post('/superAdmin/viewcustomersuperadmin/delete/{id}', 'App\Http\Controllers\ViewCustomerSuperAController@delete')->name('ChangeStatus');
Route::get('/superAdmin/viewcustomersuperadmin/showAdmin/{id}', 'App\Http\Controllers\ViewCustomerSuperAController@show')->name('ShowAdmin');
Route::get('/superAdmin/viewcustomersuperadmin/editAdmin/{id}', 'App\Http\Controllers\ViewCustomerSuperAController@edit')->name('EditAdmin');
Route::get('/superAdmin/viewCostumers/cancelAdmin', 'App\Http\Controllers\ViewCustomerSuperAController@cancel')->name('CancelAdmin');
Route::post('/superAdmin/viewcustomersuperadmin/destroy/{id}{companyId}', 'App\Http\Controllers\ViewCustomerSuperAController@destroy')->name('DestroyAdmin');
Route::get('/superAdmin/viewcustomersuperadmin', 'App\Http\Controllers\ViewCustomerSuperAController@create');
Route::get('/superAdmin/create','App\Http\Controllers\SuperAdminController@create')->name('createAdmins');
Route::prefix('CreateCompany')->group(function (){
    Route::post('/superAdmin', 'App\Http\Controllers\SuperAdminController@storeCompany');
    Route::get('/superAdmin', 'App\Http\Controllers\SuperAdminController@storeCompany');
    Route::get('/addCompany/create', 'App\Http\Controllers\SuperAdminController@createCompany');
});
Route::prefix('CreateAdmin')->group(function () {
    Route::post('/superAdmin', 'App\Http\Controllers\SuperAdminController@storeAdmin');
    Route::get('/superAdmin', 'App\Http\Controllers\SuperAdminController@storeAdmin');
    Route::get('/addAdmin/create', 'App\Http\Controllers\SuperAdminController@createAdmin');
});
Route::get('/superAdmin/index', "App\Http\Controllers\SuperAdminController@index")->name('SAH');
Route::get('/superAdmin/history','App\Http\Controllers\SuperAdminController@history')->name('HistoryS');
Route::put('/superAdmin/history/delete','App\Http\Controllers\SuperAdminController@historydelete')->name('HistoryDelete');
Route::get('/superAdmin/viewCompanies/create','App\Http\Controllers\SuperAdminController@showCompany');
Route::get('/superAdmin/viewCompanies/showCompany/{id}','App\Http\Controllers\SuperAdminController@show')->name('ShowCompanySA');
Route::get('/superAdmin/viewCompanies/editCompany/{id}','App\Http\Controllers\SuperAdminController@edit')->name('EditCompany');
Route::put('/superAdmin/viewCompanies/editCompany/updateCompany/{id}','App\Http\Controllers\SuperAdminController@update')->name('UpdateCompany');
Route::get('/superAdmin/viewCompanies/cancelCompany','App\Http\Controllers\SuperAdminController@cancel')->name('CancelCompany');
Route::put('/superAdmin/viewCompanies/create/status/{id}','App\Http\Controllers\CompanyController@status')->name('status');

Route::get('/superAdmin/viewSponsors/listSponsors', 'App\Http\Controllers\SponsorsController@showList');
Route::get('/superAdmin/addSponsors/create', 'App\Http\Controllers\SponsorsController@createSponsor');
Route::get('/superAdmin/viewSponsors/showSponsors/{id}', 'App\Http\Controllers\SponsorsController@show')->name('ShowSponsor');
Route::get('/superAdmin/viewSponsors/editSponsor/{id}', 'App\Http\Controllers\SponsorsController@edit')->name('EditSponsor');
Route::get('/superAdmin/viewSponsors/cancelSponsor', 'App\Http\Controllers\SponsorsController@cancel')->name('CancelSponsor');
Route::post('/superAdmin/viewSponsors/editSponsor/update/{id}', 'App\Http\Controllers\SponsorsController@update')->name('UpdateSponsor');
Route::post('/superAdmin/viewSponsors/editSponsor/delete/{id}', 'App\Http\Controllers\SponsorsController@delete')->name('DeleteSponsor');
Route::post('/superAdmin/addSponsors/create', 'App\Http\Controllers\SponsorsController@storeSponsor');


//---------------------------------------------------Admin----------------------------------------------------------------------------
Route::get('/admin', 'App\Http\Controllers\AdminsController@index');
Route::get('/admins/area/Edit/editArea/{id}', 'App\Http\Controllers\AreaController@showArea')->name('showAreaAD');
Route::put('/admins/area/Edit/editArea/EditArea/{id}', 'App\Http\Controllers\AreaController@EditArea')->name('UpdateArea');

Route::get('/admin/viewResults/{id}','App\Http\Controllers\AdminsController@viewResults')->name('adminViewResults');
Route::get('/admins/maturity/addML', 'App\Http\Controllers\AdminsController@storeMaturityLevel');
Route::put('/admins/maturity/editML', 'App\Http\Controllers\AdminsController@UpdateMaturity')->name('UpdateMaturity');
Route::get('/admins/maturity/editML', 'App\Http\Controllers\AdminsController@editMaturityLevel')->name('editMaturity');
Route::get('addUser/create', 'App\Http\Controllers\AdminsController@createUser');
Route::prefix('createArea')->group(function () {
    Route::post('/admins', 'App\Http\Controllers\AdminsController@storeArea');
});
Route::get('/admins/area/addArea', 'App\Http\Controllers\AdminsController@createArea');
Route::post('/admins/user/index', 'App\Http\Controllers\AdminsController@storeUser');

Route::post('/admins/index', 'App\Http\Controllers\AdminsController@storeMaturityLevel');
Route::get('/admins/user/index','App\Http\Controllers\AdminsController@showUsers')->name('showUsers');
Route::get('/admins/user/viewUsers/showUser/{id}','App\Http\Controllers\AdminsController@show')->name('ShowUser');
Route::get('/admins/user/viewUsers/editUser/{id}', 'App\Http\Controllers\AdminsController@edit')->name('EditUser');
Route::get('/admins/user/viewUsers/cancelUser', 'App\Http\Controllers\AdminsController@cancel')->name('CancelUser');
Route::post('/admins/user/delete/{id}','App\Http\Controllers\AdminsController@DeleteUsers')->name('DeleteUsers');
Route::get('/admins/user/{id}', 'App\Http\Controllers\AdminsController@show')->name('show'); //Mostrar
Route::get('/analista/viewResults/{id}','App\Http\Controllers\AnalistaController@viewResults')->name('analistaViewResults');
Route::put('/admins/user/{id}', 'App\Http\Controllers\AdminsController@UpdateUsers')->name('UpdateUsers'); //Cambios
Route::prefix('createTest')->group(function () {
    Route::post('/admins', 'App\Http\Controllers\CreateTestController@store');
});
Route::get('/admins/area/test/users', 'App\Http\Controllers\CreateTestController@getUsers');
Route::get('/admins/area/test/create', 'App\Http\Controllers\CreateTestController@create');
Route::prefix('conceptTest')->group(function () {
    Route::post('/admins', 'App\Http\Controllers\ConceptTestController@store');
});
Route::get('/admins/area/concept_test/create', 'App\Http\Controllers\ConceptTestController@create');
Route::get('/admins/area/test/edit', 'App\Http\Controllers\AdminsController@EditTest')->name('editTest');
Route::get('/admins/area/test/delete/{id}','App\Http\Controllers\CreateTestController@DeleteTest') ->name('DeleteTest');
Route::get('/admins/area/concept/editTest/delete/{id}','App\Http\Controllers\CreateTestController@DeleteConcept') ->name('DeleteConcept');
Route::get('/admins/area/Edit/editArea/delete/{id}', 'App\Http\Controllers\AreaController@DeleteArea')->name('DeleteArea');
Route::get('/admins/history','App\Http\Controllers\AdminsController@history');
Route::put('/admins/history/delete','App\Http\Controllers\AdminsController@historydelete')->name('HistoryDeleteA');

Route::get('/admins/area/test/listTest', 'App\Http\Controllers\CreateTestController@index')->name('ListTests');
Route::get('/admins/area/test/showTest/{id}', 'App\Http\Controllers\CreateTestController@show')->name('ShowTest');
Route::get('/admins/area/test/editTest/{id}', 'App\Http\Controllers\CreateTestController@edit')->name('EditTest');
Route::get('/admins/area/test/cancelTest', 'App\Http\Controllers\CreateTestController@cancel')->name('CancelTest');
Route::post('/admins/area/test/editTest/update/{id}', 'App\Http\Controllers\CreateTestController@update')->name('UpdateTest');


Route::get('/admins/maturity/index', 'App\Http\Controllers\MaturityLevelController@index');
Route::get('/admins/maturity/viewML/showML/{id}', 'App\Http\Controllers\MaturityLevelController@show')->name('ShowML');
Route::get('/admins/maturity/viewML/editML/{id}', 'App\Http\Controllers\MaturityLevelController@edit')->name('EditML');
Route::get('/admins/maturity/viewML/cancelTest', 'App\Http\Controllers\MaturityLevelController@cancel')->name('CancelML');
Route::get('/admins/maturity/addML/create', 'App\Http\Controllers\MaturityLevelController@create')->name('CreateML');
Route::post('/admins/maturity/addML/create', 'App\Http\Controllers\MaturityLevelController@store')->name('StoreML');
Route::post('/admins/maturity/viewML/editML/delete/{id}', 'App\Http\Controllers\MaturityLevelController@delete')->name('DeleteML');
Route::post('/admins/maturity/viewML/editML/update/{id}', 'App\Http\Controllers\MaturityLevelController@update')->name('UpdateML');

//---------------------------------------------------Comun----------------------------------------------------------------------------
Route::get('/comun', 'App\Http\Controllers\HomeController@index');
Route::get('/admins/area/test/edit', 'App\Http\Controllers\AdminsController@EditTest')->name('editTest');

Route::get('/Area/{id}', 'App\Http\Controllers\AdminsController@showArea');
Route::get('/Area/Test/{id}', 'App\Http\Controllers\AdminsController@showtest');
Route::get('/Area/Test/Concept/{id}', 'App\Http\Controllers\AdminsController@showconcept');
Route::get('/Area/Test/Concept/MaturityL/{id}', 'App\Http\Controllers\AdminsController@showLevelM');
Route::get('/Area/Test/Concept/Attributes/{id}', 'App\Http\Controllers\AdminsController@showAtributtes');
//-----------------------------------------------File Upload----------------------------------------------------------------------------
Route::get('/upload/{id}', 'App\Http\Controllers\TestController@index');
Route::resource('/upload', 'App\Http\Controllers\TestController');
//-------------------------------------------------Analista---------------------------------------------------------------------------
Route::get('/analista', 'App\Http\Controllers\AnalistaController@index');
Route::get('/areas', 'App\Http\Controllers\AnalistaController@getAreas');
Route::get('/analista/viewResults/{id}','App\Http\Controllers\AnalistaController@viewResults')->name('analistaViewResults');
Route::get('/analista/test/{testId}/concepto/{conceptoId}', 'App\Http\Controllers\AnalistaController@test')->name('analistaTest');
Route::post('test', 'App\Http\Controllers\AnalistaController@storeTest');
//---------------------------------------------------Comun----------------------------------------------------------------------------
Route::get('/comun', 'App\Http\Controllers\ComunController@index');
Route::get('/comun/test/{testId}/concepto/{conceptoId}', 'App\Http\Controllers\ComunController@test')->name('comunTest');
Route::get('/Areaf/{request}/{Test}/{concept}/{user}', 'App\Http\Controllers\AreaController@show');
Route::get('/Beta', 'App\Http\Controllers\AreaController@beta');
Route::get('/Beta2', "App\Http\Controllers\UserAreaController@index");


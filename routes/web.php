<?php

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Etudiant;
use App\Models\Speciality;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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


Route::controller(Controller::class)->group(function(){
    Route::get('/', 'home')->name('home');
});

Route::middleware('etudiant')->name('etudiant')->group(function(){
    Route::get('/' , [EtudiantController::class])->name('home');
});

Route::prefix("admin")->middleware('auth:admin')->name('admin.')->group(function(){
    Route::get('/home' , function(){

        return view('admin.home');
    })->name("home");

    Route::get('/alletudiants' , function(){
        $etudiants = Etudiant::all();
        return view('admin.etudiants-list', compact('etudiants'));
    })->name('list.etudiants');

    Route::post('/delete-etudiant/{etudiant}' , function(Etudiant $etudiant){
        $etudiant->delete();
        return redirect()->back();
    })->name('remove.etudiant');

    Route::get('/create-etudiant' , function(Etudiant $etudiant){
        $branches = \App\Models\Branch::all();
        return view('admin.create-etudiant', compact("branches"));
    })->name('create.etudiant');

    Route::post('/create-etudiant' , [RegisteredUserController::class, 'store'])->name('create.etudiant');

    Route::get('/edit-etudiant/{etudiant}', function(Etudiant $etudiant){
        return 'etudiant : '. $etudiant->matricule;
    })->name("etudiant.edit");

    Route::post('/remove-etudiant/{etudiant}' , function(Etudiant $etudiant){
        $etudiant->delete();
        return redirect()->back();
    } )->name('etudiant.remove');

    Route::get('/allspecialities' , function(){
        $specialities = Speciality::all();
        return view('admin.specialities-list', compact('specialities'));
    })->name('list.specialities');

    Route::post('/delete-speciality/{speciality}' , function(Speciality $speciality){
        $speciality->delete();
        return redirect()->back();
    })->name('remove.speciality');

    Route::get('/create-speciality' , function(){
        return view('admin.create-speciality');
    })->name('create.speciality');



    Route::get('/alladmins' , function(){
        $admins = Admin::all();
        return view('admin.admins-list', compact('admins'));
    })->name('list.admins');

    Route::get('/create-admin' , function(){
        return view('admin.create-admin');
    })->name('create.admin');

    Route::post('/orienter' , [Controller::class, 'orienter'])->name("orientation");


});






Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
});

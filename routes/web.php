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
        return redirect()->back()->with("etudiant deleted successfully");
    })->name('remove.etudiant');

    Route::get('/create-etudiant' , function(Etudiant $etudiant){
        $branches = \App\Models\Branch::all();
        return view('admin.create-etudiant', compact("branches"));
    })->name('create.etudiant');

    Route::post('/create-etudiant' , [RegisteredUserController::class, 'store'])->name('create.etudiant');

    Route::get('/edit-etudiant/{etudiant}', function(Etudiant $etudiant){
        $branches = \App\Models\Branch::all();
        $etudiant->makeVisible(["password"]);
        return view("admin.edit-etudiant", compact('etudiant', 'branches'));
    })->name("etudiant.edit");

    Route::post('/edit-etudiant/{etudiant}', function(\Illuminate\Http\Request $request, Etudiant $etudiant){
        $request->merge([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        $request->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $etudiant->update($request->all());

        $etudiant->setNotes([
            "math" => $request->math_note,
            "arabic" => $request->arab_note,
            "science" => $request->sci_note
        ]);
        return redirect()->back()->with('status', 'etudiant updated successfully');
    });

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
        $modules  = \App\Models\Module::all();
        return view('admin.create-speciality', compact("modules"));
    })->name('create.speciality');

    Route::post('/create-speciality', function(\Illuminate\Http\Request $request){
        $request->validate([
            "name" => ['required', 'min:15' , 'unique:specialities'],
            "university" => ['required', 'min:15'],
            "module_name" => ['required', 'exists:modules,name'],
            "places"=> ['integer', "max:200", "min:1"]
        ]);
        $speciality = new Speciality($request->all());

        if($request->has("bac_only")){
            $speciality->only_bac = true;
        }else{
            $speciality->only_bac = false;
        }

        $speciality->save();

        return redirect()->back()->with('status' , 'speciality created successfully');
    });

    Route::get('/edit-speciality/{speciality}', function(Speciality $speciality){
        $modules  = \App\Models\Module::all();
        return view('admin.edit-speciality', compact("modules", 'speciality'));
    })->name("edit.speciality");

    Route::post('/edit-speciality/{speciality}' , function(\Illuminate\Http\Request $request, Speciality $speciality){
        $request->validate([
            "name" => ['required', 'min:15', \Illuminate\Validation\Rule::unique("specialities")->ignore($speciality->id)],
            "university" => ['required', 'min:15'],
            "module_name" => ['required', 'exists:modules,name'],
            "places"=> ['integer', "max:200", "min:1"]
        ]);

        $request->merge([
            'only_bac' => $request->has('bac_only')
        ]);

        $speciality->update($request->all());

        return redirect()->back()->with('status' , "speciality updated successfully");
    });


    Route::post('/remove-speciality/{speciality}', function(Speciality $speciality){
        $speciality->delete();
        return redirect()->back()->with('status' , 'speciality deletted successfully');
    })->name("remove.speciality");



    Route::get('/alladmins' , function(){
        $admins = Admin::all();
        return view('admin.admins-list', compact('admins'));
    })->name('list.admins');

    Route::get('/create-admin' , function(){
        return view('admin.create-admin');
    })->name('create.admin');

    Route::post('/orienter' , [Controller::class, 'orienter'])->name("orientation");


});



//now the etudiant routes
Route::prefix("etudiant")->middleware('auth:etudiant')->name('etudiant.')->group(function(){
    Route::get('/', function(){
        return redirect()->to(route('dashboard'));
    })->name('home');

    Route::get('/chose' , function (){
        if(count(auth("etudiant")->user()->choices) > 0 || auth("etudiant")->user()->oriented){
            return redirect()->to(route('etudiant.result'))->with('status' , "you already chosed or oriented");
        }
        $specialities = Speciality::all();
        return view("etudiant.chose", compact('specialities'));
    })->name('chose');



    Route::post('/chose' , function(\Illuminate\Http\Request $request){


        $request->validate([
            "choice_1" => ['required', 'exists:specialities,id'],
            "choice_2" => ['required', 'exists:specialities,id'],
            "choice_3" => ['required', 'exists:specialities,id'],
        ]);
        $mat = auth("etudiant")->user()->matricule;
        $choices = array(
            [
                "etudiant_matricule" => $mat,
                "speciality_id" => $request->choice_1
            ],
            [
                "etudiant_matricule" => $mat,
                "speciality_id" => $request->choice_2
            ],
            [
                "etudiant_matricule" => $mat,
                "speciality_id" => $request->choice_3
            ]
        );


        foreach ($choices as $choice){
            \Illuminate\Support\Facades\DB::table("choix")->insert($choice);
        }

        return redirect()->to(route('dashboard'));
    } );

    Route::get('/result' , function(){
        $etudiant = auth('etudiant')->user();

        $choices = $etudiant->choices;
        $dir = $etudiant->speciality ?? null;
        $oriented = $etudiant->oriented;


        return view("etudiant.result", compact("choices", "dir", "oriented") );
    })->name('result');




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
       if(session('guard') == "admin"){
           return view('admin.home');
       }
        return view('etudiant.home');
    })->name('dashboard');
});

/*
 * \Illuminate\Support\Facades\DB::table("messagings")
            ->where("sedner", $user->number)
            ->orWhere("receiver", $user)
            ->distinct();

 */

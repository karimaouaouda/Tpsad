<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Etudiant;
use App\Models\Module;
use App\Models\Speciality;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class newAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admin = Admin::where("email", "chaima@gmail.com")->get();
        if(!count($admin)){
            $admin = Admin::create([
                "name" => "chaima brahmia",
                "email" => "chaima@gmail.com",
                "password" => Hash::make('chaima1234')
            ]);
            $admin->save();
        }


        $branches = ["math", "science"];
        $modules = ["arabic", "science", "math"];

        $specialities = [
            [
                "university" => "guelma 1954",
                "name" => "math informatic",
                "only_bac" => true,
                "places" => 150,
                "module_name" => "math"
            ],
            [
                "university" => "guelma 1954",
                "name" => "science technology",
                "only_bac" => true,
                "places" => 50,
                "module_name" => "science"
            ],
            [
                "university" => "guelma 1954",
                "name" => "science matiere",
                "only_bac" => false,
                "places" => 50,
                "module_name" => null
            ],
        ];

        $etudiant = fn() =>
          [
              "matricule" => "".rand(36000000, 36099999),
              "name" => Str::random(10) ." ". Str::random(10),
              "email" => Str::random(15)."@gmail.com",
              "password" => Hash::make("karim1234"),
              "branch_name" => $branches[rand(0, 1)],
              "bac_note" => rand(10, 18),

        ];
        $etudiants = [];

        foreach ($branches as $branch){
            Branch::create([
                "name" => $branch
            ])->save();
        }
        foreach ($modules as $module){
            Module::create([
                "name" => $module
            ])->save();
        }

        foreach ( $specialities as $speciality){
            Speciality::create($speciality)->save();
        }

        for($i = 0; $i < 20; $i++){
            $e = $etudiant();
            $etudiants[] = $e;
            Etudiant::create($e)->save();
        }


        foreach ($etudiants as $etud){
            for($i = 0 ; $i < 2; $i++){
                DB::table("choix")->insert([
                    "etudiant_matricule" => $etud['matricule'],
                    "speciality_id" => rand(1, 3),
                    "priority" => $i
                ]);
            }
        }

        foreach ($etudiants as $etud){
            foreach ($modules as $module){
                DB::table("notes")->insert([
                    "etudiant_matricule" => $etud['matricule'],
                    "module_name" => $module,
                    "note" => rand(8, 20)
            ]);
            }
        }
    }
}

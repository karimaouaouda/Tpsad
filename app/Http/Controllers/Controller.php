<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Etudiant;

use App\Models\Speciality;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    public function orienter(){
        //get all un oriented etudiants
        $etudiants = Etudiant::where("oriented" , false)->get();


        //filter them and keep only the ones who has chosed
        $etudiants = $etudiants->filter(function($etudiant){
            return count($etudiant->choices) > 0;
        });

        //available choices
        $avalaible_choices = Speciality::all();

        //now we will try to orient etudiants choice by choice

        foreach($avalaible_choices as $choice){
            $my_etudiants = $etudiants->filter(function($etudiant) use ($choice){
                return $etudiant->first_choice->id == $choice->id;
            });

            $available_places = $choice->places;
            $with_bac = $choice->with_bac;
            if(!$with_bac){
                $my_etudiants = $my_etudiants->sortByDesc("bac_note");
            }else{
                $my_etudiants = $my_etudiants->sortDesc(function($etudiant) use ($choice){
                    return $etudiant->calcMoyen($choice->module_name);
                });
            }
            $i = 0;
            foreach($my_etudiants as $etudiant){
                if($available_places == 0){
                    break;
                }

                $etudiant->sendTo($choice);
            }

            $failedEtudiants = $my_etudiants->filter(function($etudiant){
                return !$etudiant->oriented;
            });

            foreach($failedEtudiants as $etudiant){
                $etudiant->rejectedFrom($choice);
            }
        }
    
    
        $failed = collect();
        $success = collect();
    
        foreach($etudiants as $etudiant){
            if($res = $etudiant->orienter()){
                //true one
                $success->add($etudiant);
            }else{
                //has problem
                $failed->add($etudiant);
            }
        }
    }
}

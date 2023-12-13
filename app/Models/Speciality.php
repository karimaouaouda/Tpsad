<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = [
        "university",
        "name",
        "only_bac",
        "places",
        "module_name"
    ];


    public function module(){
        if(!$this->only_bac){
            return null;
        }

        return $this->belongsTo(Module::class, "module_name");
    }

    public function etudiants(){
        
    }
}

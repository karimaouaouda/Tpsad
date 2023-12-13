<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Etudiant extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "matricule",
        'name',
        'branch_name',
        'email',
        'password',
        "bac_note"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    //relations

    public function branch(){
        return $this->belongsTo(Branch::class, "branch_name");
    }

    public function choices(){
        return $this->belongsToMany(Speciality::class, "choix", "etudiant_matricule");;
    }

    //attributes
    public function getFirstChoiceAttribute(){
        if( count( $choices = $this->choices ) > 0 ){
            foreach($choices as $choice){
                if($choice->pivot->status == "waiting"){
                    return $choice;
                }
            }

            return null;
        }
    }

    public function calcMoyen(Speciality $speciality){
        $modulename = $speciality->module_name;
        
    }


    //this is the action of orientation etudiant
    public function orienter(){
        //first we need all the requirements
    }
}

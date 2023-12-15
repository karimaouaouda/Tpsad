<?php

namespace App\Actions\Fortify;

use App\Models\Etudiant;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Authenticatable
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            "guard" => ["required", "in:admin,etudiant"],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $guard = $input['guard'];

        if($guard == "etudiant"){
            Validator::make($input, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:etudiants'],
                'matricule' => ["required", "unique:etudiants"],
                'branch_name' => ["required", "exists:branches,name"],
                "bac_note" => ["numeric" , "min:0", "max:20"],
                "math_note" => ["numeric" , "min:0", "max:20"],
                "sci_note" => ["numeric" , "min:0", "max:20"],
                "arab_note" => ["numeric" , "min:0", "max:20"],
            ])->validate();

            session([
                "guard" => $guard
            ]);

            $input['password'] = Hash::make($input['password']);

            return Etudiant::create($input);
        }

        session([
            "guard" => $input['gur']
        ]);

        if($input['role'] == 'admin'){
            return Admin::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

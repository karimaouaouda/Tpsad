<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $primaryKey = "name";
    public $incrementing = false;

    protected $fillable = [
        "name"
    ];

    public function notes(){
        $this->belongsToMany(Module::class, "notes", "module_name")->withPivot("note");
    }

}

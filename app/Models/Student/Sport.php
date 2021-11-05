<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    ];

    /**
     * Relaciones
     */

    //Sport relacionados con el Student
    public function students(){
        return $this->belongsToMany('App\Models\Student\Student')->withTimestamps();
    }
}

<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'last_name',
    	'gender',
    	'code',
    ];

    public function absence_justification(){
        return $this->hasOne('App\Models\Student\AbsenceJustification');
    }
}

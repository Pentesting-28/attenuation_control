<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceJustification extends Model
{
    use HasFactory;

    protected $fillable = [
    	'status',
    	'student_id',
    	'description',
    ];

    /**
     * Relaciones
     */
    public function student()
    {
    	return $this->belongsTo('App\Models\Student\Student');
    }
}

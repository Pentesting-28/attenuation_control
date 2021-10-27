<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'hour',
    	'status',
    	'student_id',
    ];

    /**
     * Relaciones
     */
    public function student()
    {
    	return $this->belongsTo('App\Models\Student\Student');
    }
}

<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Attendance extends Component
{
	public
		$name,
		$code,
    	$student_id;

    public function render()
    {
        return view('livewire.student.attendance');
    }

    public function clearProperty()
    {
      $this->reset([
        'name',
        'code',
        'student_id',
      ]);
    }
}

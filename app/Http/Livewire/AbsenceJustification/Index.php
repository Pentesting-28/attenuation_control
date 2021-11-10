<?php

namespace App\Http\Livewire\AbsenceJustification;

use Livewire\Component;

use App\Models\Student\Student;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
	use WithPagination;

	public
		$data_student,
		$filter = [
	      'student_name'      => null,
	      'student_last_name' => null,
	      'student_code'      => null
	    ];


    public function render()
    {
    	$absence_justifications = Student::with('absence_justification')
								 ->when($this->filter["student_name"] != null, function ( Builder $query ) {
									$query->where('name', 'LIKE', '%'.$this->filter["student_name"].'%');
								 })
								 ->when($this->filter["student_last_name"] != null, function ( Builder $query ) {
									$query->where('last_name', 'LIKE', '%'.$this->filter["student_last_name"].'%');
								 })
								 ->when($this->filter["student_code"] != null, function ( Builder $query ) {
									$query->where('code', 'LIKE', '%'.$this->filter["student_code"].'%');
								 })
								 ->has('absence_justification')
		                         ->orderBy('created_at', 'ASC')
		                         ->paginate(10);

        return view('livewire.absence-justification.index', compact('absence_justifications'));
    }

    public function show($id)
    {
    	$data = Student::where('id', $id)
		    		   ->with('absence_justification')
		    		   ->first();

    	$this->fill([
    		'data_student' => $data,
    	]);
    }

    public function clearProperty()
    {
    	$this->reset([
    		'data_student',
    	]);
    }
}

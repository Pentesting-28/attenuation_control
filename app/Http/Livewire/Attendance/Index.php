<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;

use App\Models\Student\{Attendance, Student};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;

class Index extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

	public
		$filter = [
	      'student_name'      => null,
	      'student_last_name' => null,
	      'student_code'      => null
	    ];





	       
    public function render()
    {
    	$attendances = Attendance::with('student')
								 ->when($this->filter["student_name"] != null, function ( Builder $query ) {
									$query->whereHas('student', function ( Builder $query ) {
									  $query->where('name', 'LIKE', '%'.$this->filter["student_name"].'%');
									});
								 })
								 ->when($this->filter["student_last_name"] != null, function ( Builder $query ) {
									$query->whereHas('student', function ( Builder $query ) {
									  $query->where('last_name', 'LIKE', '%'.$this->filter["student_last_name"].'%');
									});
								 })
								 ->when($this->filter["student_code"] != null, function ( Builder $query ) {
									$query->whereHas('student', function ( Builder $query ) {
									  $query->where('code', 'LIKE', '%'.$this->filter["student_code"].'%');
									});
								 })
								 ->has('student')
		                         ->orderBy('created_at', 'ASC')
		                         ->paginate(10);

        return view('livewire.attendance.index', compact('attendances'));
    }

    public function generalAttendancExport()
    {
    	return Excel::download(new AttendanceExport(), 'Control-de-asistencias ('.now()->format('d-m-Y').').xlsx');
    }
}

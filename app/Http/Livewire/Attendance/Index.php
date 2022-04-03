<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;

use App\Models\Student\{Attendance, Student};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;
use Carbon\Carbon;

class Index extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

	public
		$filter = [
	      'student_name'      => null,
	      'student_last_name' => null,
	      'student_code'      => null,
		  'student_date'      => null,
	    ];






    public function render()
    {
    	$attendances = Attendance::when($this->filter["student_date"] != null, function ( Builder $query ) {

									$month = Carbon::create($this->filter["student_date"]);

									$query->whereMonth('created_at', $month->format("m"))
										  ->whereYear('created_at',  $month->format("Y"));
								 })
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
								 ->with('student')
								 ->has('student')
		                         ->orderBy('created_at', 'ASC')
		                         ->paginate(10);

        return view('livewire.attendance.index', compact('attendances'));
    }

	public function clearProperty(){
		$this->fill([
            'filter.student_name'      => null,
	      	'filter.student_last_name' => null,
	      	'filter.student_code' 	   => null,
		  	'filter.student_date'      => null,
        ]);
	}

    public function generalAttendancExport()
    {
    	return Excel::download(new AttendanceExport($this->filter["student_date"]), 'Control-de-asistencias ('.now()->format('d-m-Y').').xlsx');
    }
}

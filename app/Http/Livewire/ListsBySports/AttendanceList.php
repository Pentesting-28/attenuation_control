<?php

namespace App\Http\Livewire\ListsBySports;

use Livewire\Component;

use App\Models\Student\{
    Student,
    Sport,
    Attendance as AttendanceModel,
};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceListExport;

class AttendanceList extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

	public
        $id_sport,
        $name_sport,
		$filter = [
	      'student_name'      => null,
	      'student_last_name' => null,
	      'student_code'      => null
	    ];

    public function render()
    {
        $attendances = AttendanceModel::with( 'student','student.sports' )
                                      ->whereHas( 'student.sports', function ( Builder $query ) {
                                        $query->where( 'sports.id', $this->id_sport );
                                      })

                                      ->when( $this->filter["student_name"] != null, function ( Builder $query ) {
                                        $query->whereHas( 'student', function ( Builder $query ) {
                                            $query->where( 'name', 'LIKE', '%'.$this->filter["student_name"].'%' );
                                        });
                                      })
                                      ->when( $this->filter["student_last_name"] != null, function ( Builder $query ) {
                                        $query->whereHas( 'student', function ( Builder $query ) {
                                            $query->where( 'last_name', 'LIKE', '%'.$this->filter["student_last_name"].'%' );
                                        });
                                      })
                                      ->when( $this->filter["student_code"] != null, function ( Builder $query ) {
                                        $query->whereHas( 'student', function ( Builder $query ) {
                                            $query->where( 'code', 'LIKE', '%'.$this->filter["student_code"].'%' );
                                        });
                                      })
                                      ->has('student')
                                      ->has('student.sports')
                                      ->orderBy('created_at', 'ASC')
                                      ->paginate(10);

        return view('livewire.lists-by-sports.attendance-list', compact('attendances'));
    }

    public function mount($sport)
    {
    	if( is_numeric( $sport ))
        {
            $validate_sport = Sport::findOrFail( $sport )->get();

            if( count( $validate_sport ) > 0 )
            {
                $this->fill([
                    'name_sport' => Sport::findOrFail( $sport )->name,
                    'id_sport' => $sport,
                ]);
            }
        }
        else{
            dd('El parametro debe ser numerico');
        }
    }

    public function attendanceListExport()
    {
    	return Excel::download(new AttendanceListExport( $this->id_sport ), 'Control-de-asistencias-'.$this->name_sport.'-('.now()->format('d-m-Y').').xlsx');
    }
}

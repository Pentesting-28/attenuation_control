<?php

namespace App\Http\Livewire\ListsBySports;

use Livewire\Component;

use App\Models\Student\{Student,Sport};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class StudentList extends Component
{
  	use WithPagination;

  	protected $paginationTheme = 'bootstrap';

  	public
  		$id_sport,
  		$filter = [
            'student_name'      => null,
            'student_last_name' => null,
            'student_code'      => null
          ];


    public function render()
    {
        $students = Student::with('sports','attendance')
                            ->whereHas('sports', function ( Builder $query ) {
                              $query->where('sports.id', $this->id_sport);
                            })
                            ->when($this->filter["student_name"] != null, function ( Builder $query ) {
                              $query->where('name', 'LIKE', '%'.$this->filter["student_name"].'%');
                            })
                            ->when($this->filter["student_last_name"] != null, function ( Builder $query ) {
                              $query->where('last_name', 'LIKE', '%'.$this->filter["student_last_name"].'%');
                            })
                            ->when($this->filter["student_code"] != null, function ( Builder $query ) {
                              $query->where('code', 'LIKE', '%'.$this->filter["student_code"].'%');
                            })
                            ->has('sports')
                            ->orderBy('created_at', 'ASC')
                            ->paginate(10);

        return view('livewire.lists-by-sports.student-list', compact('students'));
    }

    public function mount($sport)
    {
      if(is_numeric($sport))
      {
        $validate_sport = Sport::findOrFail($sport)->get();

        if(count($validate_sport) > 0)
        {
          $this->fill([
            'id_sport' => $sport,
          ]);
        }
      }
      else{
        dd('El parametro debe ser numerico');
      }
    }
}

<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Student\{
  Student,
  Sport
};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use App\Traits\UtilTrait;
use DB;

class Index extends Component
{
  	use WithPagination;
    
    use UtilTrait;

    protected $paginationTheme = 'bootstrap';

  	public
    		$name,
    		$last_name,
    		$gender,
    		$code,
        $schedule,
        $status,
        $sport  = [],
        $sports = [],
        $student_id,
        $filter = [
          'student_name'      => null,
          'student_last_name' => null,
          'student_code'      => null
        ];



  	protected $listeners = [
        'mount'
    ];




    public function render()
    {
      $students = Student::when($this->filter["student_name"] != null, function ( Builder $query ) {
                              $query->where('name', 'LIKE', '%'.$this->filter["student_name"].'%');
                           })
                           ->when($this->filter["student_last_name"] != null, function ( Builder $query ) {
                              $query->where('last_name', 'LIKE', '%'.$this->filter["student_last_name"].'%');
                           })
                           ->when($this->filter["student_code"] != null, function ( Builder $query ) {
                              $query->where('code', 'LIKE', '%'.$this->filter["student_code"].'%');
                           })
                           ->orderBy('created_at', 'ASC')
                           ->paginate(10);

      return view('livewire.student.index', compact('students'));
    }




    public function mount()
    {

    	$this->fill([
    		'code'   => $this->generateRandom(6),
        'sports' => Sport::get(['id','name']),
    	]);
    }




    public function modal($action, Student $student)
    {
      $student_sport = Student::where( 'id', $student->id )
                                ->with( 'sports' )
                                ->first();
      $select_sport = [];

      foreach ($student_sport->sports as $sport)
      {
        array_push($select_sport, $sport->id);
      }

      switch ($action) {
        case 'edit':

          $this->fill([
            'name'       => $student->name,
            'last_name'  => $student->last_name,
            'gender'     => $student->gender,
            'code'       => $student->code,
            'student_id' => $student->id,
            'schedule'   => $student->schedule,
            'status'     => $student->status,
            'sport'      => $select_sport,
          ]);

        break;

        case 'destroy':

          $this->fill([
            'student_id' => $student->id,
          ]);

        break;
      }
    }




    public function clearProperty()
    {
      $this->reset([
        'name',
        'last_name',
        'gender',
        'code',
        'schedule',
        'status',
        'sport',
        'student_id',
      ]);

      $this->emit('clearSelet2');

      $this->resetValidation();

      $this->emit('mount');
    }





    public function store()
    {
      $validatedData = $this->validate([
        // 'name'      => 'required|string|min:3|max:255|unique:students',
        'name'      => 'required|string|min:3|max:255',
        'last_name' => 'required|string|min:3|max:255',
        'gender'    => 'required|string',
        'code'      => 'required|string|max:255|unique:students',
        'schedule'  => 'required|string',
        'sport'     => 'required',
        'status'    => 'required|boolean'
      ]);

      $select_id_sport = array_filter($this->sport);

      $this->validatorSport($select_id_sport);

      if(count($select_id_sport) > 0)
      {
        $student = Student::create([
          'name'      => $this->name,
          'last_name' => $this->last_name,
          'gender'    => $this->gender,
          'code'      => $this->code,
          'schedule'  => $this->schedule,
          'status'    => $this->status,
        ]);

        $student->sports()->sync($select_id_sport);

        $this->clearProperty();

        $this->emit('modalHide');

        $this->emit('confirm_create');
      }
    }





    public function update(Student $student)
    {

      $validatedData = $this->validate([
        // 'name'      => "required|string|min:3|max:255|unique:students,name,{$student->id}",
        'name'      => 'required|string|min:3|max:255',
        'last_name' => 'required|string|min:3|max:255',
        'gender'    => 'required|string',
        'code'      => "required|string|max:255|unique:students,code,{$student->id}",
      ]);

      $select_id_sport = array_filter($this->sport);

      $this->validatorSport($select_id_sport);

      if(count($select_id_sport) > 0)
      {
        $student_update = $student->update([
          'name'      => $this->name,
          'last_name' => $this->last_name,
          'gender'    => $this->gender,
          'code'      => $this->code,
          'schedule'  => $this->schedule,
          'status'    => $this->status
        ]);

        $student->sports()->sync($select_id_sport);

        $this->clearProperty();

        $this->emit('modalHide');

        $this->emit('confirm_update');
      }
    }




    public function destroy(Student $student)
    {
      $student->delete();

      $this->clearProperty();

      $this->emit('modalHide');
    }





    public function generateNewCode()
    {
      $this->emit('mount');
    }





    private function validatorSport(array $select_id_sport)
    {
        if(count($select_id_sport) == 0)
        {
            $this->emit('error_validation_sport');
        }
    }
}

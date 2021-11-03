<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Student\Student;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class Index extends Component
{
	use WithPagination;

	public
		$name,
		$last_name,
		$gender,
		$code,
        $schedule,
        $status,
        $sport,
        $student_id,
        $filter = [
          'student_name' => null,
          'student_last_name' => null,
          'student_code' => null
        ];

  protected $paginationTheme = 'bootstrap';



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
    		'code' => $this->generateRandom(6),
    	]);
    }




    public function modal($action, Student $student)
    {

      switch ($action) {
        case 'edit':

          $this->fill([
            'name' => $student->name,
            'last_name' => $student->last_name,
            'gender' => $student->gender,
            'code' => $student->code,
            'student_id' => $student->id,
            'schedule' => $student->schedule,
            'status' => $student->status,
            'sport' => $student->sport,
          ]);

        break;

        case 'destroy':

          $this->fill([
            'student_id'    => $student->id,
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
        'student_id',
      ]);
      
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
        'sport'     => 'required|string',
        'status'    => 'required|boolean'
      ]);

      $student = Student::create([
        'name'      => $this->name,
        'last_name' => $this->last_name,
        'gender'    => $this->gender,
        'code'      => $this->code,
        'schedule'  => $this->schedule,
        'status'    => $this->status,
        'sport'     => $this->sport
      ]);

      $this->clearProperty();

      $this->emit('modalHide');

      $this->emit('confirm_create');
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

      $student_update = $student->update([
        'name'      => $this->name,
        'last_name' => $this->last_name,
        'gender'    => $this->gender,
        'code'      => $this->code,
        'schedule'  => $this->schedule,
        'status'    => $this->status,
        'sport'     => $this->sport
      ]);

      $this->clearProperty();

      $this->emit('modalHide');

      $this->emit('confirm_update');
    }




    public function destroy(Student $student)
    {
      $student->delete();

      $this->clearProperty();

      $this->emit('modalHide');
    }





     /**
     * Generate random token
     */
    public function generateRandom($strength)
    {
	    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $input_length = strlen($permitted_chars);
	    $random_string = '';

	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
	    }

	    return $random_string;
    }

    public function generateNewCode()
    {
      $this->emit('mount');
    }
}

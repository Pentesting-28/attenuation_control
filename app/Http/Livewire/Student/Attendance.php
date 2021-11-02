<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Student\{
    Attendance as AttendanceModel,
    AbsenceJustification,
    Student
};
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class Attendance extends Component
{
	public
		$name,
		$code,
        $band = false,
        $data_student;

    protected $listeners = [
        'clearProperty' => 'clearProperty',
    ];

    public function render()
    {
        $this->data_student = Student::Orwhere('name', $this->name)
                                     ->Orwhere('code', $this->code)
                                     ->first();

        return view('livewire.student.attendance');
    }

    public function clearProperty()
    {
        $this->reset([
            'name',
            'code',
            'band',
            'data_student',
        ]);
    }

    public function entryAlumn()
    {
        $Object = new DateTime();  
        $Object->setTimezone(new DateTimeZone('America/Caracas'));
        $hour = $Object->format("h:i:s a");
        // $DateAndTime = $Object->format("d-m-Y h:i:s a");

        $student = Student::Orwhere('name', $this->name)
                          ->Orwhere('code', $this->code)
                          ->get();

        if($this->name != null || $this->code != null)//si no inserta nada 
        {
            if(count($student->toArray()) > 0)//si exite el alumno
            {
                $absence_justification = AbsenceJustification::where('student_id', $student[0]->id)
                                                  ->where('status', '!=' , false)
                                                  ->latest()
                                                  ->get();

                if(count($absence_justification->toArray()) > 0)
                {
                    dd('pinto bien');
                    $attendance = AttendanceModel::where('student_id', $student[0]->id)
                                                 ->latest()
                                                 ->get();

                    if(count($attendance->toArray()) > 0)//si exite un primer registro
                    {
                        if( Carbon::now()->format('Y-m-d') <= $student[0]->created_at->format('Y-m-d') && $attendance[0]->status == false )
                        {
                            $this->band = true;
                        }
                        else{
                            $this->emit('error_validation_info_entry');
                        }
                    }
                    else{
                        $this->band = true;
                    }
                }
                else{
                    // dd('pinto mal');
                    $this->emit('modalShow');
                }
            }
            else{
                $this->emit('error_validation');
            }
        }
        else{
            $this->emit('error_validation_info');
        }

        if( $this->band == true )
        {
            AttendanceModel::create([
                'hour' => $hour,
                'status' => true,
                'student_id' => $student[0]->id,
            ]);

            $this->emit('confirm_register_entry');

            $this->clearProperty();
        }
    }

    public function exitAlumn()
    {
        $Object = new DateTime();  
        $Object->setTimezone(new DateTimeZone('America/Caracas'));
        $hour = $Object->format("h:i:s a");
        // $DateAndTime = $Object->format("d-m-Y h:i:s a");
        
        $student = Student::Orwhere('name', $this->name)
                         ->Orwhere('code', $this->code)
                          ->get();

        if($this->name != null || $this->code != null)
        {
            if(count($student->toArray()) > 0 )
            {
                $attendance = AttendanceModel::where('student_id', $student[0]->id)->latest()->get();

                if(count($attendance->toArray()) > 0 )
                {
                    if( Carbon::now()->format('Y-m-d') <=  $student[0]->created_at->format('Y-m-d') && $attendance[0]->status == true)
                    {
                        AttendanceModel::create([
                            'hour' => $hour,
                            'status' => false,
                            'student_id' => $student[0]->id,
                        ]);

                        $this->emit('confirm_register_entry');

                        $this->clearProperty();                    
                    }
                    else{
                        $this->emit('error_validation_info_exit');
                    }
                }
                else{
                    $this->emit('error_validation_info_no_register');
                }
            }
            else{
                $this->emit('error_validation');
            }
        }
        else{
            $this->emit('error_validation_info');
        }
    }
}

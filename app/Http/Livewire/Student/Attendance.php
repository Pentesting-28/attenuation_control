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
use Livewire\WithPagination;

class Attendance extends Component
{
    use WithPagination;

	public
		$name,
        $last_name,
		$code,
        $band,
        $description,
        $data_student,
        $data_student_select,
        $student_select,
        $select_status_payment = null,
        $band_table;


    protected $listeners = [
        'clearProperty' => 'clearProperty',
        'validateData'  => 'absenceJustificationValidateData',
    ];


    public function render()
    {
        $this->data_student_select = Student::where( 'id', $this->student_select )
                                            ->first();
        if($this->band_table != true)
        {
            $this->data_student = Student::Orwhere( 'code', $this->code )
                                         ->when($this->last_name != null, function ( Builder $query ) {
                                            $query->Orwhere('last_name', 'LIKE', '%'.$this->last_name.'%');
                                         })
                                         ->get();

            if( count($this->data_student ) > 0 )
            {
                $this->eventHandler('show_table');
            }
        }

        return view( 'livewire.student.attendance' );
    }




    public function selectStudent( Student $student )
    {
        $this->student_select = $student->id;

        $this->last_name = $student->last_name .' '. $student->name;
        $this->code = $student->code;

        $this->band_table = true;

        $this->eventHandler( 'hide_table' );
        $this->eventHandler('show_btn_forms');

        if( $student->status == 0 )
        {
            $this->band = true;
            $this->eventHandler('modalPaymentShow');

        }

    }




    public function eventHandler( $params )
    {
        $this->emit( $params );
    }




    public function clearProperty()
    {
        $this->reset([
            'name',
            'last_name',
            'code',
            'band',
            'band_table',
            'description',
            'data_student',
            'data_student_select',
            'student_select',
            'select_status_payment',
        ]);

        $this->eventHandler('hide_btn_forms');
        $this->eventHandler( 'hide_table' );
    }






    public function entryAlumn()
    {
        $Object = new DateTime();
        $Object->setTimezone( new DateTimeZone('America/Guayaquil') );
        $hour = $Object->format("h:i:s a");
        // $DateAndTime = $Object->format("d-m-Y h:i:s a");

        if( $this->last_name != null || $this->code != null )//si no inserta nada
        {
            if( isset( $this->student_select ) != null )//si exite el alumno
            {
                if( $this->band == true )//si no esta al dia con el pagos.
                {
                    if( $this->select_status_payment != null )//si a seleccionado a no el estus de pago checked del radio frond-end
                    {
                        $this->data_student_select->update( [ 'status' => $this->select_status_payment ] );

                        AttendanceModel::create([
                            'hour'       => $hour,
                            'status'     => true,
                            'student_id' => $this->student_select,
                        ]);

                        $this->eventHandler( 'confirm_register_entry' );

                        $this->eventHandler( 'hide_btn_forms' );

                        $this->clearProperty();

                    }else{
                        $this->emit( 'error_validation_info_no_select_payment' );
                    }
                }
                else{// Si esta al dia con los pagos | campos status = 1
                    AttendanceModel::create([
                        'hour'       => $hour,
                        'status'     => true,
                        'student_id' => $this->student_select,
                    ]);

                    $this->eventHandler( 'confirm_register_entry' );

                    $this->eventHandler( 'hide_btn_forms' );

                    $this->clearProperty();
                }
            }
            else{
                $this->eventHandler( 'error_validation' );
            }
        }
        else{
            $this->emit( 'error_validation_info' );
        }
    }







    public function exitAlumn()
    {
        $Object = new DateTime();
        $Object->setTimezone( new DateTimeZone( 'America/Guayaquil' ) );
        $hour = $Object->format( "h:i:s a" );
        // $DateAndTime = $Object->format("d-m-Y h:i:s a");

        if($this->last_name != null || $this->code != null)
        {
            if( isset( $this->student_select ) != null )//si exite el alumno
            {
                $attendance = AttendanceModel::where( 'student_id', $this->data_student_select->id )->latest()->get();

                if(count($attendance->toArray()) > 0 )
                {
                    AttendanceModel::create([
                        'hour'       => $hour,
                        'status'     => false,
                        'student_id' => $this->data_student_select->id,
                    ]);

                    $this->eventHandler('confirm_register_entry');

                    $this->clearProperty();
                }
                else{
                    $this->eventHandler('error_validation_info_no_register');
                }
            }
            else{
                $this->eventHandler('error_validation');
            }
        }
        else{
            $this->eventHandler('error_validation_info');
        }
    }






    public function absenceJustificationValidateData()
    {
        if($this->last_name != null || $this->code != null)
        {
            if($this->data_student_select != null)
            {
                $this->eventHandler('modalShow');
            }
            else{
               $this->eventHandler('error_validation');
            }
        }
        else{
            $this->eventHandler('error_validation_info');
        }
    }






    public function absenceJustificationStore()
    {
        $validatedData = $this->validate([
            'description' => 'required|string|min:3|max:255',
        ]);

        AbsenceJustification::create([
            'status'      => true,
            'description' => $this->description,
            'student_id'  => $this->data_student_select->id,
        ]);

        $this->clearProperty();

        $this->eventHandler('modalHide');

        $this->eventHandler('hide_btn_forms');

        $this->eventHandler('confirm_register_entry');
    }






    public function statusPaymentUpdate()
    {
        if(isset($this->select_status_payment) != null)
        {
            $status_payment = Student::where('id', $this->student_select)->first();

            if(isset($status_payment) != null)
            {
                $status_payment->update([
                    'status' => (bool)$this->select_status_payment
                ]);

                $this->eventHandler( 'modalPaymentHide' );
            }
            else{
                $this->eventHandler('error_validation');
            }
        }
        else{
            $this->eventHandler('error_validation_info_no_select_payment');
        }
    }
}

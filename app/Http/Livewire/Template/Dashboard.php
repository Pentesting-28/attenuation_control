<?php

namespace App\Http\Livewire\Template;

use Livewire\Component;

use App\Models\Student\{
    Student,
    Attendance,
    AbsenceJustification
};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Dashboard extends Component
{
    public
        $card_count = [
            "students",
            "attendaces",
            "absence_justifications",
            "students_payments"
        ],
        $daily_assistance   = [],
        $monthly_assistance = [];


    public function render()
    {
        return view('livewire.template.dashboard');
    }

    public function mount()
    {
        $this->fill([
            "card_count.students"               => Student::count(),
            "card_count.attendaces"             => Attendance::whereStatus(true)->count(),
            "card_count.absence_justifications" => AbsenceJustification::whereStatus(true)->count(),
            "card_count.students_payments"      => Student::whereStatus(true)->count()
        ]);

        $count_attendance = Student::with('attendance')
                                    ->whereHas( 'attendance', function ( Builder $query ) {
                                        $query->whereDate("created_at", now())
                                              ->whereStatus(true);
                                    })
                                    ->has('attendance')
                                    ->count();

        $count_absence = Student::whereDoesntHave('attendance', function ( Builder $query ) {
                                        $query->whereDate("created_at", now());
                                    })
                                    ->count();

        $this->daily_assistance = [
            [
                "name"  => "Alumnos",
                "count" => $this->card_count["students"]
            ],
            [
                "name"  => "Asistentes",
                "count" => $count_attendance
            ],
            [
                "name"  => "Inasistentes",
                "count" => $count_absence
            ]
        ];


        $year  = Carbon::now()->format('Y');
        $start = Carbon::now()->startofMonth()->format('d');

        // $month = array();

        for ($i=1; $i < 13; $i++) { 

            $fecha_inicial = Carbon::create($start.'-'.$i.'-'.$year);

            $this->monthly_assistance[] = [
                "name"  => ucwords($fecha_inicial->locale('es','UTC')->monthName),
                "count" => Attendance::whereMonth('created_at', $fecha_inicial->format('m'))->count()
            ];

            // array_push(//Insert
            //     $month,// Array
            //     ucwords($fecha_inicial->locale('es')->monthName)
            //     //Traducimos el mes a espa;ol y convetimos la primera letra a mayusculas
            // );
        }
        
        // dd(//Testing
        //     $month,
        //     $this->monthly_assistance,
        //     $this->daily_assistance
        // );
    }
}


// $monthly_assistance = DB::table('attendances')
//                  ->whereMonth('created_at', '03')
//                 //  ->whereRaw('MONTH(created_at) = ?', [03])
//                 //  ->select(DB::raw('created_at'), DB::raw('count(*) as count'))
//                  ->groupBy('created_at')
//                  ->count();

// $monthly_assistance = Attendance::whereMonth('created_at', '03')->count();

// $fecha = Carbon::parse(now());
// $mes = $fecha->format("F");

// $date = Carbon::now()->locale('es');

// $date->locale();            // fr_FR
// "\n";
// $date->format("F");     // il y a 1 seconde
/*
TABLE STUDENT Doesnthave IN ATTENDANCE DATE NOW()

    'id'
    'name'
    'last_name'
    'gender'
    'code'
    'schedule'
    'status'
    'created_at'
    'updated_at'
*/

/*TABLE ATTENDANCE

    'id'
    'hour'
    'status'
    'student_id'
    'created_at'
    'updated_at'

*/

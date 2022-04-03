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

        /**
         * $year Año actual example 2022
         * 
         * $start Primer dia del mes example 01
         * 
         * $i meses example 01
         * 
         * $fecha_inicial Creamos una fecha nueva partiendo de ( $start, $i, $year )
         * 
         * ucwords() Convertimos la primera letra a Mayúscula
         * 
         * $fecha_inicial->locale('es','UTC')->monthName Traducimos el mes al idioma de preferencia
         **/

        $year  = Carbon::now()->format('Y');

        $start = Carbon::now()->startofMonth()->format('d');

        for ($i=1; $i < 13; $i++)
        { 
            $fecha_inicial = Carbon::create( $start.'-'.$i.'-'.$year );

            $this->monthly_assistance[] = [
                "name"  => ucwords($fecha_inicial->locale('es','UTC')->monthName),
                "count" => Attendance::whereMonth('created_at', $fecha_inicial->format('m'))->count()
            ];
        }
    }
}
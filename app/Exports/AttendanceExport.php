<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Student\{Attendance, Student};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class AttendanceExport implements FromView
{

    public function view() : View
    {
        $students = Student::with('attendance','absence_justification')
                           ->orderBy('created_at', 'ASC')
                           ->get();

        $month = $this->showDatesAndDays()["month"];

        $week = $this->showDatesAndDays()["week"];

        $data = [

            "students" => $students,

            "show_dates_and_days" => [
                "month" => $month,
                "week"  => $week
            ],
        ];

        return view('reports.exports.general_attendance', compact('data'));
    }

    public function showDatesAndDays()
    {
        $month = Carbon::now()->startofMonth()->format('m');
        $year  = Carbon::now()->format('Y');

        $start = Carbon::now()->startofMonth()->format('d');
        $end   = Carbon::now()->endOfMonth()->format('d');
        
        $fecha_inicial = Carbon::create($start.'-'.$month.'-'.$year)->subDay();
        
        $array_days_of_the_month = [];
        $array_days_of_the_week  = [];

        for ($i=0; $i < $end; $i++)
        {
            $fecha_nueva_semana = $fecha_inicial->addDay(1)->format('D') ;

            $fecha_nueva = $fecha_inicial->addDay(0)->format('d') ;

            if($fecha_nueva_semana !== 'Sat' && $fecha_nueva_semana !== 'Sun')
            {
                array_push($array_days_of_the_month, $fecha_nueva);
                array_push($array_days_of_the_week,  $this->getWeekdays($fecha_nueva_semana));
            }
        }

        return [
            "month" => $array_days_of_the_month,
            "week"  => $array_days_of_the_week
        ];
    }

    public function getWeekdays($data)
    {
        switch ($data) {
            case 'Mon':
                $weekday = "L";
            break;
            case 'Tue':
                $weekday = "M";
            break;
            case 'Wed':
                $weekday = "M";
            break;
            case 'Thu':
                $weekday = "J";
            break;
            case 'Fri':
                $weekday = "V";
            break;
        }

        return $weekday;
    }
}

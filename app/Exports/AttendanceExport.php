<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Student\Student;
use Carbon\Carbon;

class AttendanceExport implements FromView
{

    public function view() : View
    {
        $students = Student::with('attendance','absence_justification')
                           ->orderBy('created_at', 'ASC')
                           ->get();

        $month = $this->showDatesAndDays()["month"];

        $week = $this->showDatesAndDays()["week"];

        $days_of_the_month_format = $this->showDatesAndDays()["days_of_the_month_format"];

        $data = [
            "students" => $students,
            "show_dates_and_days" => [
                "month" => $month,
                "week"  => $week
            ],
            "days_of_the_month_format" => $days_of_the_month_format
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
        $array_days_of_the_month_format = [];

        for ($i=0; $i < $end; $i++)
        {
            $fecha_nueva_semana = $fecha_inicial->addDay(1)->format('D') ;

            $fecha_nueva = $fecha_inicial->addDay(0)->format('d') ;

            $daily_of_attendance = $fecha_inicial->addDay(0)->format('Y-m-d') ;

            if($fecha_nueva_semana !== 'Sat' && $fecha_nueva_semana !== 'Sun')
            {
                array_push($array_days_of_the_month, $fecha_nueva);
                array_push($array_days_of_the_week,  $this->getWeekdays($fecha_nueva_semana));
                array_push($array_days_of_the_month_format, $daily_of_attendance);
            }
        }

        return [
            "month" => $array_days_of_the_month,
            "week"  => $array_days_of_the_week,
            "days_of_the_month_format" => $array_days_of_the_month_format,
        ];
    }




    public function getWeekdays($data)
    {
        switch ($data)
        {
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

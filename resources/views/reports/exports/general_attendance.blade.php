@php
  // if( count( $data["show_dates_and_days"]["month"] ) > 0)
  // {
  //   $width_th = (8 + count( $data["show_dates_and_days"]["month"]) )/2;
  // }
@endphp

<table>
  <tbody>
     <tr>
       <td colspan="5"style="background-color: white;">
       </td>
       <td colspan="24"style="background-color: white;">

        <b>"HERMANOS ENDERICA SALGADO"</b>

       </td>
      </tr>
      <tr>
       <td colspan="5"style="background-color: white;">
       </td>
       <td colspan="24"style="background-color: white;">

         <b>REGISTRO DE ASISTENCIA: {{ \Carbon\Carbon::now()->startofMonth()->format('Y-m-d') }}</b>

       </td>
      </tr>
      <tr>
       <td colspan="8"style="background-color: yellow;">
       </td>
       <td colspan="21"style="background-color: yellow;">

          <b>MAÑANA</b>

       </td>
     </tr>
  </tbody>

  <thead>
     <tr>
       <th rowspan="2" style="text-align: center;" width="60%">NRO.</th>

       <th rowspan="2" style="text-align: center;" width="280%">NOMBRE DEL ESTUDIANTE</th>

       <th rowspan="2" style="text-align: center;">ESTADO</th>

       <th rowspan="2" style="text-align: center;">CÓDIGO</th>

       <th rowspan="2" style="text-align: center;" width="290%">OBSERVACIONES HORARIO</th>

       @if( count( $data["show_dates_and_days"]["month"] ) > 0)
         @for($i = 0; $i < count( $data["show_dates_and_days"]["month"] ); $i++)

          <th style="text-align: center;">{{ $data["show_dates_and_days"]["month"][$i] }}</th>

         @endfor
       @endif

       <th rowspan="2" style="text-align: center;">PAGO</th>

       <th rowspan="2" style="text-align: center;" width="280%">OBSERVACIONES</th>

     </tr>
  </thead>
  <tbody>
      @for ($i = -1; $i < count($data["students"]); $i++)
        <tr>

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i != -1)

            <td style="background-color: #d0cecf; text-align: center;">{{ $data["students"][$i]->id }}</td>

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">{{ $data["students"][$i]->name }} {{ $data["students"][$i]->last_name }}</td>

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">{{ ($data["students"][$i]->status == true ? 'P' :'') }}</td>

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">{{ $data["students"][$i]->code }}</td>

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">{{ 'N/A' }}</td>

          @endif

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i == -1)

            @for($j = 0; $j < count( $data["show_dates_and_days"]["week"] ); $j++)

            <td width="40%" style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$j], $j) }}; text-align: center;">{{ $data["show_dates_and_days"]["week"][$j] }}</td>

            @endfor

          @else

            {{-- @for($k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++) --}}


                 {{-- foreach($data["students"][$i]->attendance as $student_attendance)
                 { --}}
                    @if (count($data["students"][$i]->attendance) > 0)

                      @php
                        $array_attendance_all = [];
                      @endphp

                      @foreach ($data["students"][$i]->attendance as $attendance)

                        @php
                            array_push($array_attendance_all,$attendance->created_at->format('Y-m-d'));
                        @endphp

                      @endforeach

                      @php
                        $data1 = array_values(array_unique($array_attendance_all));
                      @endphp

                        {{-- @php
                            $attendance = 'X';
                        @endphp
                        @for ($k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++)
                        <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }}; text-align: center;">{{ $attendance }}</td>
                        @endfor --}}
                        @php
                            $array_item = [];
                        @endphp
                      @for ($k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++)

                        @for ($h=0; $h < count($data1); $h++)

                            {{-- $attendance = attendanceValidate( $attendance, $data["days_of_the_month_format"][$k] ); --}}
                            @if( $data1[$h] == $data["days_of_the_month_format"][$k] )
                                @php
                                    array_push($array_item, $k);
                                @endphp
                                <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }}; text-align: center;">{{ 'X' }}</td>
                             {{-- @else --}}
                                {{--@php
                                    $attendance = 'n';
                                @endphp --}}


                            @endif
                                {{-- <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }}; text-align: center;">{{ '' }}</td> --}}

                            {{-- <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }}; text-align: center;">{{ $attendance }}</td> --}}

                        @endfor

                        {{-- @for ($w = 0; $w < count( $data["show_dates_and_days"]["week"] ); $w++)

                            @if (!in_array($w, $array_item))
                                <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$w], $w) }}; text-align: center;">{{ 'n' }}</td>
                            @endif

                        @endfor --}}
                      @endfor



                    @else
                        @php
                            $attendance = '';
                        @endphp
                        @for ($k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++)
                            <td style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }}; text-align: center;">{{ $attendance }}</td>
                        @endfor
                    @endif
                 {{-- } --}}

                 {{-- $array_attendance_all = []; --}}

                 {{-- foreach ($students[0]->attendance as $attendance) --}}
                 {{-- { --}}
                     {{-- array_push($array_attendance_all,$attendance->created_at->format('Y-m-d')); --}}
                 {{-- } --}}

                 {{-- $data1 = array_values(array_unique($array_attendance_all)); --}}

            {{-- @endfor --}}

          @endif

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i != -1)

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">{{ 'N/A' }}</td>

            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;"><center>{{ strip_tags((!empty($data["students"][$i]->absence_justification->description) ? $data["students"][$i]->absence_justification->description : 'X')) }}</center></td>

          @endif
       </tr>
      @endfor
  </tbody>
</table>

@php

  function tdColorTable($data, $indice)
  {
    switch (true)
    {
      case $data == '01':
        $color = "#a8cf8d";
      break;
      case $data >= '02' && $data <= '08':
        $color = "#bdd6ee";
      break;
      case $data >= '09' && $data <= '15':
        $color = "#ffe596";
      break;
      case $data >= '16' && $data <= '22':
        $color = "#fbe3d5";
      break;
      case $data >= '23':
        $color = "#f2b084";
      break;
    }

    return $color;
  }

  function colorParImpar($indice)
  {
    if( ($indice+1)%2==0 )
    {
        $color = "#d0cecf";
    }else{
        $color = "";
    }

    return $color;
  }

//   function attendanceValidate($student_attendance, $days_of_the_month)
//   {
//     if($student_attendance->created_at->format('Y-m-d') == $days_of_the_month )
//     {
//         $attendance = 'X';
//     }
//     else{
//         $attendance = 'I';
//     }

//     return $attendance;
//   }
@endphp


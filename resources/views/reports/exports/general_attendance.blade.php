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





  {{-------------  ENSAMBLANDO LOS ENCABEZADO DE LA TABLA  -----------------}}
  <thead>
     <tr>
       <th rowspan="2" style="text-align: center;" width="60%">NRO.</th>

       <th rowspan="2" style="text-align: center;" width="280%">NOMBRE DEL ESTUDIANTE</th>

       <th rowspan="2" style="text-align: center;">ESTADO</th>

       <th rowspan="2" style="text-align: center;">CÓDIGO</th>

       <th rowspan="2" style="text-align: center;" width="290%">OBSERVACIONES HORARIO</th>

       @if( count( $data["show_dates_and_days"]["month"] ) > 0 )

        @for( $i = 0; $i < count( $data["show_dates_and_days"]["month"] ); $i++ )

            {{-- DIAS DEL MES. --}}
            <th style="text-align: center;">{{ $data["show_dates_and_days"]["month"][$i] }}</th>

        @endfor

       @endif

       <th rowspan="2" style="text-align: center;">PAGO</th>

       <th rowspan="2" style="text-align: center;" width="280%">OBSERVACIONES</th>

     </tr>
  </thead>
  {{-------------------------------------------------------------------------------}}





  {{-------------  ENSAMBLANDO LOS DATOS CORRESPONDIENTE A LOS ENCABEZADO DE LA TABLA  -----------------}}
  <tbody>
      @for ( $i = -1; $i < count( $data["students"] ); $i++ )
        <tr>

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i != -1 )

            {{-- NRO. --}}
            <td style="background-color: #d0cecf; text-align: center;">
                {{ $data["students"][$i]->id }}
            </td>

            {{-- NOMBRE DEL ESTUDIANTE --}}
            <td style="background-color: {{ colorParImpar( $i ) }}; text-align: center;">
                {{ $data["students"][$i]->name }} {{ $data["students"][$i]->last_name }}
            </td>

            {{-- ESTADO --}}
            <td style="background-color: {{ colorParImpar( $i ) }}; text-align: center;">

                {{-- paymentStatusValidation --}}
                {{ paymentStatusValidation( $data["students"][$i]->status ) }}
            </td>

            {{-- CÓDIGO --}}
            <td style="background-color: {{ colorParImpar( $i ) }}; text-align: center;">
                {{ $data["students"][$i]->code }}
            </td>

            {{-- OBSERVACIONES HORARIO --}}
            <td style="background-color: {{ colorParImpar( $i ) }}; text-align: center;">
                {{ 'N/A' }}
            </td>

          @endif

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i == -1 )

            @for( $j = 0; $j < count( $data["show_dates_and_days"]["week"] ); $j++ )

            {{-- DIAS DE LA SEMANA SEGUN EL MES. --}}
            <td width="40%" style="background-color: {{ tdColorTable( $data["show_dates_and_days"]["month"][$j], $j ) }}; text-align: center;">
                {{ $data["show_dates_and_days"]["week"][$j] }}
            </td>

            @endfor

          @else
            {{-------------  ASISTENCIAS DEL ESTUDIANTE POR DIAS DE LA SEMANA. -----------------}}
            @if ( count( $data["students"][$i]->attendance ) > 0 )

                @php
                    $array_attendance_all = [];
                @endphp

                @foreach ( $data["students"][$i]->attendance as $attendance )

                    @php
                        array_push( $array_attendance_all, $attendance->created_at->format('Y-m-d') );
                    @endphp

                @endforeach

                @php
                    $array_attendance_total = array_values( array_unique( $array_attendance_all ) );
                @endphp

                @for ( $k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++ )

                    <td style="background-color: {{ tdColorTable( $data["show_dates_and_days"]["month"][$k], $k ) }}; text-align: center;">

                        @if( count($data["students"][$i]->absence_justification) > 0)

                            @foreach($data["students"][$i]->absence_justification as $students_absence_justification)

                                {{------------- VALIDAMOS SI LAS FECHAS SON IGUALES  -----------------}}
                                {{ absencejustificationValidate( $students_absence_justification->created_at->format('Y-m-d'), $data["days_of_the_month_format"][$k] ) }}

                            @endforeach

                        @endif

                        @for ( $h=0; $h < count( $array_attendance_total ); $h++ )

                            {{-- VALIDACION DE ASISTENCIAS --}}
                            {{ attendanceValidate( $array_attendance_total[$h], $data["days_of_the_month_format"][$k] ) }}

                        @endfor

                    </td>

                @endfor
                {{-------------------------------------------------------------------------------}}
            @else
                {{-------------  SI EL ESTUDIANTE NO TIENE REGISTRO DE ASISTENCIAS CONFIGURAMOS  -----------------}}
                @for ( $k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++ )

                    <td style="background-color: {{ tdColorTable( $data["show_dates_and_days"]["month"][$k], $k ) }}; text-align: center;">

                        {{------------- VALIDAMOS SI EL SIENES INASISTENCIAS JUSTIFICADAS  -----------------}}
                        @if( count($data["students"][$i]->absence_justification) > 0)

                            @foreach($data["students"][$i]->absence_justification as $students_absence_justification)

                            {{------------- VALIDAMOS SI LAS FECHAS SON IGUALES  -----------------}}
                            {{ absencejustificationValidate( $students_absence_justification->created_at->format('Y-m-d'), $data["days_of_the_month_format"][$k] ) }}

                            @endforeach

                        @endif
                    </td>

                @endfor
                {{-------------------------------------------------------------------------------}}
            @endif
          @endif

          {{-------------  CONTINUAMOS ENSAMBLANDO LOS DATOS CORRESPONDIENTE AL RESTO DE LOS ENCABEZADO DE LA TABLA  -----------------}}
          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i != -1 )

            {{-- PAGO --}}
            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">
                {{ 'N/A' }}
            </td>

            {{-- OBSERVACIONES --}}
            <td style="background-color: {{ colorParImpar($i) }}; text-align: center;">

                {{-- VALIDAMOS SI EXITEN INASISTENCIAS JUSTIFICADAS --}}
                <center>
                {{ strip_tags( ( !empty( $data["students"][$i]->absence_justification->description ) ? $data["students"][$i]->absence_justification->description : 'X' ) ) }}
                </center>

            </td>
          @endif
       </tr>
      @endfor
  </tbody>
  {{----------------------------------------------------------------------------------------------------}}
</table>

@php

    /*-- FUNCION PARA COLOREAR LOS CAMPOS DE LOS DIAS DE LA SEMANA --*/
    function tdColorTable( $data, $indice )
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


    /*-- FUNCION PARA COLOREAR LAS FILAS DE LA TABLA --*/
    function colorParImpar( $indice )
    {
        if( ( $indice+1 ) %2==0 )
        {
            $color = "#d0cecf";
        }else{
            $color = "";
        }

        return $color;
    }


    /*-- FUNCION PARA VALIDAR EL ESTUS DE PAGO --*/
    function paymentStatusValidation( $status )
    {
        if( $status == true )
        {
            $resul = 'P';
        }else{
            $resul = '';
        }

        return $resul;
    }


    /*-- FUNCION PARA LAS ASISTENCIAS HE INASISTENCIAS EN EL MES CURSANTE --*/
    function attendanceValidate( $array_attendance_total, $days_of_the_month_format )
    {
        if( $array_attendance_total == $days_of_the_month_format )
        {
            return $attendance = 'X';
        }
    }


    /*-- FUNCION PARA VALIDAR INASISTENCIAS JUSTIFICADAS EN EL MES CURSANTE --*/
    function absencejustificationValidate( $date_absence_justification, $days_of_the_month_format )
    {
        if( $date_absence_justification == $days_of_the_month_format )
        {
            return $attendance = 'J';
        }
    }

@endphp


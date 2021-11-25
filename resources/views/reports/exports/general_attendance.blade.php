
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
       <th align="left" width="60%">NRO.</th>
       <th align="left" width="280%">NOMBRE DEL ESTUDIANTE</th>
       <th align="center">ESTADO</th>
       <th align="left">CÓDIGO</th>
       <th align="left" width="290%">OBSERVACIONES HORARIO</th>

       @if( count( $data["show_dates_and_days"]["month"] ) > 0)
         @for($i = 0; $i < count( $data["show_dates_and_days"]["month"] ); $i++)

       <th align="left">{{ $data["show_dates_and_days"]["month"][$i] }}</th>

         @endfor
       @endif

       <th align="left">PAGO</th>
       <th align="left" width="280%">OBSERVACIONES</th>
     </tr>
  </thead>
  <tbody>
      @for ($i = 0; $i < count($data["students"]); $i++)
        <tr>
          <td align="left" style="background-color: #d0cecf;">{{ $data["students"][$i]->id }}</td>
          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ $data["students"][$i]->name }} {{ $data["students"][$i]->last_name }}</td>
          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ ($data["students"][$i]->status == true ? 'P' :'') }}</td>
          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ $data["students"][$i]->code }}</td>
          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ 'N/A' }}</td>

          @if( count( $data["show_dates_and_days"]["week"] ) > 0 && $i == 0)
            
            @for($j = 0; $j < count( $data["show_dates_and_days"]["week"] ); $j++)
              
          <td align="left" width="40%" style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$j], $j) }};">{{ $data["show_dates_and_days"]["week"][$j] }}</td>

            @endfor

          @else
          
            @for($k = 0; $k < count( $data["show_dates_and_days"]["week"] ); $k++)

            <td align="left" style="background-color: {{ tdColorTable($data["show_dates_and_days"]["month"][$k], $k) }};"></td>
            @endfor

          @endif

          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ 'N/A' }}</td>
          <td align="left" style="background-color: {{ colorParImpar($i) }};">{{ strip_tags((!empty($data["students"][$i]->absence_justification->description) ? $data["students"][$i]->absence_justification->description : '')) }}</td>
        </tr>
      @endfor
  </tbody>
</table>

@php

  function tdColorTable($data, $indice)
  {
    switch (true) {
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

@endphp
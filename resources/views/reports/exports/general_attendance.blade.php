{{-- <center> --}}
{{-- <style type="text/css">
  h3{
    text-align: center;
  }
</style> --}}
<!-- Horizontal alignment -->

{{-- <h3><b>REGISTRO DE ASISTENCIA: OCTUBRE 2021</b></h3>
<h2 style="background-color: yellow;"><b>MAÑANA</b></h2><br>
<th>NOMBRE DEL ESTUDIANTE</th><td></td><td></td> --}}
    {{-- <td align="right">Big title</td> --}}

    <!--  Vertical alignment -->
    {{-- <td valign="middle">Bold cell</td> --}}

    <!-- Rowspan -->
    {{-- <td rowspan="3">Bold cell</td> --}}

    {{-- Colspan --}}
    {{-- <td colspan="6">Italic cell</td> --}}

    <!-- Width -->
    {{-- <td width="100">Cell with width of 100</td> --}}

    <!-- Height -->
    {{-- <td height="100">Cell with height of 100</td> --}}
{{-- </center> --}}
<table>
  <tbody>
     <tr>
       <td colspan="8"style="background-color: white;">
         
       </td>
       <td colspan="10"style="background-color: white;">
        <b>"HERMANOS ENDERICA SALGADO"</b>
       </td>
      </tr>

      <tr>
       <td colspan="8"style="background-color: white;">
         
       </td>

       <td colspan="10"style="background-color: white;">
         <b>REGISTRO DE ASISTENCIA: OCTUBRE 2021</b>
       </td>
      </tr>

      <tr>
       <td colspan="9"style="background-color: yellow;">
         
       </td>
       <td colspan="9"style="background-color: yellow;">
          <b>MAÑANA</b>
       </td>
     </tr>
  </tbody>
</table>

<table>
  <thead>
     <tr>  
       <th>NRO.</th>
       <th>NOMBRE DEL ESTUDIANTE</th><td></td><td></td>
       <th>ESTADO</th>
       <th>RECURSO</th>
       <th>OBSERVACIONES HORARIO</th><td></td><td></td>
       <th>PAGO</th>
       <th>OBSERVACIONES</th>
     </tr>
  </thead>
  <tbody>
      @foreach ($attendances as $student)
       <tr>
        <td align="left">{{ $student->id }}</td>
        <td>{{ $student->name }} {{ $student->last_name }}</td>
        <td></td>
        <td>{{ $student->status == true ? 'P':'' }}</td>
        <td>{{ $student->code }}<td>
        <td>N/A</td><td></td><td></td>
        <td>Si</td>
        @php
          if (!empty($student->absence_justification->description))
          {
            $justification_description = $student->absence_justification->description;
          }
          else{
            $justification_description = '';
          }
        @endphp
        <td>{{ strip_tags($justification_description) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

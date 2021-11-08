{{-- <center> --}}

<h3><b>"HERMANOS ENDERICA SALGADO"</b></h3>
<h3><b>REGISTRO DE ASISTENCIA: OCTUBRE 2021</b></h3>
<h2 style="background-color: yellow;"><b>MAÑANA</b></h2>
<!-- Horizontal alignment -->
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
  <thead>
     <tr>  
       <th style="background-color: #A5A2A2">NRO.</th>
       <th style="background-color: #A5A2A2">NOMBRE DEL ESTUDIANTE</th>
       <th style="background-color: #A5A2A2">ESTADO</th>
       <th style="background-color: #A5A2A2">RECURSO</th>
       <th style="background-color: #A5A2A2">OBSERVACIONES HORARIO</th>
       <th style="background-color: #A5A2A2">PAGO</th>
     </tr>
  </thead>
  <tbody>
{{--       @foreach ($bitacoras as $bitacora)
       <tr>
        <td>{{ $bitacora->id}}</td>
        <td>{{ $bitacora->fecha }}</td>
        @php($proveedor = App\Models\Proveedor::findOrNew($bitacora->proveedor_id)->nombre)
        <td>{{ $proveedor }}</td>
        @php($proveedor = App\Models\Proveedor::findOrNew($bitacora->proveedor_id)->credito)
        <td>{{ $proveedor }}</td>
      </tr>
    @endforeach --}}
  </tbody>
</table>

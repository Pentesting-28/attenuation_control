<div id="content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                <div class="card-body">

                    <div class="row align-items-end">
                        <div class="col-lg-8 col-md-8">
                            <h4>Listado de Asistencias</h4>
                        </div>

                    </div>

                    <div class="row py-4">
                        <div class="col-md-4">
                            @if( count($attendances) > 0 )
                                <a title="Generar Reporte" wire:click="attendanceListExport()">
                                    <button class="btn  btn-success" style="color: white;"><i class="fas fa-lg fa-file-excel"></i>Generar Reporte</button>
                                </a>
                                <div wire:loading wire:target="attendanceListExport">
                                    Exportando ........
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="btn-toolbar justify-content-between float-right" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <input title="Buscar por Nombre" wire:model="filter.student_name" type="text" class="form-control mx-1" name="student_name" id="student_name" placeholder="Nombre">
                                        <input title="Buscar por Apellido" wire:model="filter.student_last_name" type="text" class="form-control mx-1" name="student_last_name" id="student_last_name" placeholder="Apellido">
                                        <input title="Buscar por Codigo" wire:model="filter.student_code" type="text" class="form-control mx-1" name="student_code" id="student_code" placeholder="Codigo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive py-3">
                        <table class="table" width="100%" cellspacing="0">
                              <thead class="text-center">
                                <tr>
                                  <th scope="col">Id</th>
                                  <th >Nombre</th>
                                  <th >Apellido</th>
                                  <th >Genero</th>
                                  <th >Codigo</th>
                                  <th >Status</th>
                                  <th >Hora</th>
                                  <th >Fecha</th>
                                  <th >Deporte</th>
                                </tr>
                              </thead>
                              @foreach($attendances as $attendance)
                              <tbody class="text-center">
                                <tr>
                                  <th>{{ $attendance->id }}</th>
                                  <td>{{ $attendance->student->name }}</td>
                                  <td>{{ $attendance->student->last_name }}</td>
                                  <td>{{ $attendance->student->gender }}</td>
                                  <td>{{ $attendance->student->code }}</td>
                                  @if($attendance->status == true)
                                      <td style="background-color: #28a745; color: white;"><label><em><b>Entrada.</b></em></label></td>
                                  @else
                                      <td style="background-color: #dc3545; color: white;"><label><em><b>Salida</b></em></label></td>
                                  @endif
                                  <td>{{ $attendance->hour }}</td>
                                  <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                                  <td>{{ $name_sport }}</td>
                                  {{-- @foreach ($attendance->student->sports as $sport)
                                      @if($sport->id == $id_sport)

                                      @endif
                                  @endforeach --}}
                                </tr>
                              </tbody>
                              @endforeach
                        </table>
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
            @if($attendances->count() == 0)
                <div class="card">
                    <div class="card-body text-center">
                        No tiene asistencias registradas.
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>

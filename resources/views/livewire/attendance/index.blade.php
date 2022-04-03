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
                        <div class="col-md-9 ml-auto">
                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                <div class="btn-toolbar justify-content-between " role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <img src="{{ asset('/images/calendar-datepicker.svg') }}" class="iconoCalendario">
                                            <input title="Buscar por Nombre"   wire:model="filter.student_name" type="text" class="form-control mx-1" name="student_name" id="student_name" placeholder="Nombre">
                                            <input title="Buscar por Apellido" wire:model="filter.student_last_name" type="text" class="form-control mx-1" name="student_last_name" id="student_last_name" placeholder="Apellido">
                                            <input title="Buscar por Código"   wire:model="filter.student_code" type="text" class="form-control mx-1" name="student_code" id="student_code" placeholder="Código">
                                            <input title="Buscar por Fecha"    wire:model="filter.student_date" type="text" id="datePickerInvoices" readonly="readonly" class="form-control pointer datePickerInvoices mx-1">
                                        </div>
                                    </div>
                                </div>
                                <button title="Limpiar" type="button" wire:click.prevent="clearProperty()" class="grow_box grow_box_dark"><i class="fas fa-lg fa-sync-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    @if( count($attendances) > 0 )
                        <div class="row">
                            <div class="col-md-12">
                                <a title="Generar Reporte" wire:click="generalAttendancExport()">
                                    <button class="grow_box grow_box_green btn-sm mx-1 pointer"><i class="fas fa-lg fa-file-excel"></i> Generar Reporte</button>
                                </a>
                                <div wire:loading wire:target="generalAttendancExport">
                                    Exportando ........
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive py-3">
                        <table class="table" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th >Nombre</th>
                                    <th >Apellido</th>
                                    <th >Género</th>
                                    <th >Código</th>
                                    <th >Status</th>
                                    <th >Hora</th>
                                    <th >Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <th>{{ $attendance->id }}</th>
                                        <td>{{ $attendance->student->name }}</td>
                                        <td>{{ $attendance->student->last_name }}</td>
                                        <td>{{ $attendance->student->gender }}</td>
                                        <td>{{ $attendance->student->code }}</td>
                                            @if($attendance->status == true)
                                                <td style="background-color: #02a000; color: white;"><label><em><b>Entrada.</b></em></label></td>
                                            @else
                                                <td style="background-color: #dc3545; color: white;"><label><em><b>Salida</b></em></label></td>
                                            @endif
                                        <td>{{ $attendance->hour }}</td>
                                        <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
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
<script>

    window.fh = function(selectedDates)
    {
        @this.set('filter.student_date', selectedDates);
    }

</script> 

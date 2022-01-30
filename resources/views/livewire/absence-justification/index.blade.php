<div id="content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="card mb-4">
                {{-- <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div> --}}
                <div class="card-body">
                @include('livewire.absence-justification.show')
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h4>Listado de Inasistencias Justificadas</h4>
                    </div>

                    {{-- <div class="col-lg-4 col-md-4 justify-content-between float-right">
                        <a title="Registrar Usuario" data-toggle="modal" data-target="#createModal" class="btn btn-secondary float-right" style="background: #6c63ff; border-radius: 5px;"><i class="fas fa-address-card"></i></a>
                    </div> --}}
                    {{-- <a title="Editar Usuario" data-toggle="modal" data-target="#updateModal" wire:click="generalAttendancExport()">
                        <button class="btn pt-0" style="background: white;"><i class="fas fa-edit" style="font-size: 20px;"></i></button>
                    </a> --}}
                </div>
                <div class="btn-toolbar justify-content-between float-right py-4" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="input-group">
                    <div class="input-group-prepend">
                          <input title="Buscar por Nombre" wire:model="filter.student_name" type="text" class="form-control mx-1" name="student_name" id="student_name" placeholder="Nombre">
                          <input title="Buscar por Apellido" wire:model="filter.student_last_name" type="text" class="form-control mx-1" name="student_last_name" id="student_last_name" placeholder="Apellido">
                          <input title="Buscar por Codigo" wire:model="filter.student_code" type="text" class="form-control mx-1" name="student_code" id="student_code" placeholder="Codigo">
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
                                  <th >Fecha</th>
                                  <th class="text-center">Acción</th>
                                </tr>
                              </thead>
                              @foreach($absence_justifications as $absence_justification)
                              <tbody class="text-center">
                                <tr>
                                  <th>{{ $absence_justification->id }}</th>
                                  <td>{{ $absence_justification->student->name }}</td>
                                  <td>{{ $absence_justification->student->last_name }}</td>
                                  <td>{{ $absence_justification->student->gender }}</td>
                                  <td>{{ $absence_justification->student->code }}</td>
                                  <td>{{ $absence_justification->created_at->format('Y-m-d') }}</td>

                                  <td class="text-center">
		                            <a title="Editar Deporte" data-toggle="modal" data-target="#showModal" wire:click="show({{ $absence_justification->id }})">
                                        <button class="btn pt-0" style="background: white;"><i class="fas fa-eye" style="font-size: 20px;"></i></button>
                                    </a>
                                  </td>

                                </tr>
                              </tbody>
                              @endforeach
                        </table>
                        {{ $absence_justifications->links() }}
                    </div>
                </div>
            </div>
            @if($absence_justifications->count() == 0)
                <div class="card">
                    <div class="card-body text-center">
                        No tiene inasistencias justificadas registradas.
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>

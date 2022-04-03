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

                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h4>Listado de Alumnos</h4>
                    </div>
                </div>

                <div class="btn-toolbar justify-content-between float-right py-4" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="input-group">
                    <div class="input-group-prepend">
                          <input title="Buscar por Nombre" wire:model="filter.student_name" type="text" class="form-control mx-1" name="student_name" id="student_name" placeholder="Nombre">
                          <input title="Buscar por Apellido" wire:model="filter.student_last_name" type="text" class="form-control mx-1" name="student_last_name" id="student_last_name" placeholder="Apellido">
                          <input title="Buscar por Código" wire:model="filter.student_code" type="text" class="form-control mx-1" name="student_code" id="student_code" placeholder="Código">
                    </div>
                  </div>
                </div>


                    <div class="table-responsive py-3">
                        <table class="table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th scope="col">Id</th>
                                  <th >Nombre</th>
                                  <th >Apellido</th>
                                  <th >Género</th>
                                  <th >Código</th>
                                  <th >Deporte</th>

                                </tr>
                              </thead>
                              @foreach($students as $student)
                              <tbody>
                                <tr>
                                  <th>{{ $student->id }}</th>
                                  <td>{{ $student->name }}</td>
                                  <td>{{ $student->last_name }}</td>
                                  <td>{{ $student->gender }}</td>
                                  <td>{{ $student->code }}</td>
                                  @foreach ($student->sports as $sport)
                                      @if($sport->id == $id_sport)
                                          <td>{{ $sport->name }}</td>
                                      @endif
                                  @endforeach
                                </tr>
                              </tbody>
                              @endforeach
                        </table>
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
            @if($students->count() == 0)
                <div class="card">
                    <div class="card-body text-center">
                        No tiene alumnos registrados.
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>
</script>


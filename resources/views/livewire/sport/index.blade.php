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
                @include('livewire.sport.destroy')
                @include('livewire.sport.create')
                @include('livewire.sport.edit')


                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <h4>Listado de Deportes</h4>
                    </div>

                    <div class="col-lg-4 col-md-4 justify-content-between float-right">
                        <a title="Registrar Deporte" data-toggle="modal" data-target="#createModal" class="btn btn-secondary float-right" style="background: #6c63ff; border-radius: 5px;"><i class="fas fa-address-card"></i></a>
                    </div>
                </div>

                <div class="btn-toolbar justify-content-between float-right py-4" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="input-group">
                    <div class="input-group-prepend">
                          <input title="Buscar por Nombre" wire:model="filter.sport_name" type="text" class="form-control mx-1" name="sport_name" id="sport_name" placeholder="Nombre">
                    </div>
                  </div>
                </div>


                    <div class="table-responsive py-3">
                        <table class="table" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th scope="col">Id</th>
                                  <th >Nombre</th>
                                  <th class="text-center">Accición</th>
                                </tr>
                              </thead>
                              @foreach($sports as $sport)
                              <tbody>
                                <tr>
                                  <th>{{ $sport->id }}</th>
                                  <td>{{ $sport->name }}</td>

                                  <td class="text-center">
                                    <a title="Editar Deporte" data-toggle="modal" data-target="#updateModal" wire:click="modal('edit',{{ $sport->id }})">
                                        <button class="btn pt-0" style="background: white;"><i class="fas fa-edit" style="font-size: 20px;"></i></button>
                                    </a>
                                
                                    <button title="Eliminar Deporte" type="button" class="btn pt-0" data-toggle="modal" data-target="#destroyModal" wire:click="modal('destroy',{{ $sport->id }})"
                                            class="btn btn-danger text-white mr-2 text-capitalize"
                                            style="background: white">
                                            <i class="fas fa-trash-alt" style="font-size: 20px; color: red"></i>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                              @endforeach
                        </table>
                        {{ $sports->links() }}
                    </div>
                </div>
            </div>
            @if($sports->count() == 0)
                <div class="card">
                    <div class="card-body text-center">
                        No tiene deportes registrados.
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>

<script type="text/javascript">

document.addEventListener('livewire:load', () => {
    @this.on('confirm_create', () => {
        successAlertCreate();
    });

    @this.on('confirm_update', () => {
        successAlertUpdate();
    });
});

</script>
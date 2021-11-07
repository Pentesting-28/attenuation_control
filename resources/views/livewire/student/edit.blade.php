<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alumnos | Editar Alumnos</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button> --}}
            </div>
           <div class="modal-body">
                <div class="container">
          				<form wire:submit.prevent="update({{ $student_id }})" method="POST">
          					<div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom01">Nombre</label>
                          <input wire:model.defer="name" type="text" name="name" class="form-control" id="validationCustom01"  placeholder="Nombre">
                          @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom02">Apellido</label>
                          <input wire:model.defer="last_name" type="text" class="form-control" id="validationCustom02"  placeholder="Apellido">
                          @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustomUsername">Género</label>
                          <div class="input-group">
                            <select wire:model.defer="gender" class="custom-select" >
                                <option  selected value="">Seleccione género</option>

    	                            <option value="Masculino">Masculino</option>
                                  <option value="Femenino">Femenino</option>
                                  <option value="Otros">Otros</option>

                            </select>
                          </div>
                            @error('gender') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3" >
                            <label for="validationCustom03">Codigo</label>
                            <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo" disabled>
                            @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustomUsername2">Pagó</label>
                            <div class="input-group">
                              <select wire:model.defer="status" class="custom-select">

                                  <option selected >Seleccione</option>
                                  <option value="{{ 1 }}">Si</option>
                                  <option value="{{ 0 }}">No</option>

                              </select>
                            </div>
                              @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
                          </div>

                          <div class="col-md-6 mb-3" >
                              <label for="validationCustom03">Horario</label>
                              <input wire:model.defer="schedule" type="time" class="form-control" id="validationCustom03"  placeholder="Horarios">
                              @error('schedule') <span class="error text-danger">{{ $message }}</span>@enderror
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 mb-3">

                          <label for="validationCustomUsername2">Tipo de deporte</label>
                          <div class="input-group" wire:ignore>
                            <select class="js-example-basic-multiple-edit" wire:model="sport" name="sport[]" multiple="multiple" style="width: 100%">
                                @foreach ($sports as $index => $sport)
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                @endforeach

                            </select>
                          </div>

                            @error('sport') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                         <button type="button" wire:click.prevent="generateNewCode()"class="btn btn-sm text-white float-right" style="background-color: #6c63ff;"  title="Generar nuevo codigo">Generar nuevo codigo</button>
                        </div>

                      </div>

                      <div class="modal-footer">
                         <button type="button" wire:click.prevent="clearProperty()"class="btn btn-sm btn-secondary" data-dismiss="modal" title="Cancelar Registro">Volver</button>
                         <button type="submit" class="btn btn-sm btn-success" title="Guardar Registro">Aceptar</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    document.addEventListener('livewire:load', () => {
       @this.on('modalHide', () => {
            $("#updateModal").modal("hide");
        });
    });

</script>

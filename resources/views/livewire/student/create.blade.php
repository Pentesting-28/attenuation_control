<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="createModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alumnos | Agregar Alumnos</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button> --}}
            </div>
           <div class="modal-body">
                <div class="container">
          				<form wire:submit.prevent="store()" method="POST">
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
                            <label for="validationCustom02">Codigo</label>
                            <input wire:model="code" type="text" class="form-control" id="validationCustom02"  placeholder="Codigo" disabled>
                            @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustomUsername2">Tipo de deporte</label>
                          <div class="input-group">
                            <select wire:model.defer="sport" class="custom-select">

                                <option  selected value="">Seleccione deporte</option>

                                <option value="Natación">Natacion</option>
                                <option value="Triatlon">Triatlon</option>
                                <option value="Ballet">Ballet</option>
                                <option value="Defensa Personal">Defensa Personal</option>
                                <option value="Gimnasio">Gimnasio</option>

                            </select>
                          </div>
                            @error('sport') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6 mb-3" >
                            <label for="validationCustom03">Horario</label>
                            <input wire:model.defer="schedule" type="time" class="form-control" id="validationCustom03"  placeholder="Horarios">
                            @error('schedule') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      <fieldset class="form-group row">
                        <label for="validationCustom03">Pagó</label>
                        <div class="col-sm-10">
                          <div class="form-check">
                            <input class="form-check-input" wire:model.defer="status" type="radio" name="gridRadios" id="gridRadios1" value={{ 1 }} checked>
                            <label class="form-check-label" for="gridRadios1">
                              Si
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" wire:model.defer="status" type="radio" name="gridRadios" id="gridRadios2" value={{ 0 }}>
                            <label class="form-check-label" for="gridRadios2">
                              No
                            </label>
                          </div>
                          @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </fieldset>
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
            $("#createModal").modal("hide");
        });
    });

</script>

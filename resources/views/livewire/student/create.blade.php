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
                            <label for="validationCustom03">Codigo</label>
                            <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo" disabled>
                            @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
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
                          <label for="validationCustomUsername">Tipo de deporte</label>
                          <div class="input-group">
                            <select wire:model.defer="schedule" class="custom-select" >
                                <option  selected value="">Seleccione deporte</option>

                                  <option value="Esgrima">Esgrima</option>
                                  <option value="Futbol">Futbol</option>
                                  <option value="Natación">Natación</option>
                                  <option value="Otros">Otros</option>

                            </select>
                          </div>
                            @error('schedule') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6 mb-3" >
                            <label for="validationCustom03">Horario</label>
                            <input wire:model="schedule" type="time" class="form-control" id="validationCustom03"  placeholder="Horarios">
                            @error('schedule') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      <label for="validationCustomUsername">Pago</label>
                      
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          {{-- <label for="validationCustomUsername">Pago</label> --}}
                          {{-- <div class="col-md-3 mb-3" wire:key="customControlInline1"> --}}
                              <div class="custom-control custom-checkbox my-1 mr-sm-2" >
                                  <input type="checkbox" wire:model.defer="status" class="custom-control-input" id="customControlInline1">
                                  <label class="custom-control-label" for="customControlInline1">Si</label>
                              </div>
                                {{-- @error('poll') <span class="error text-danger">{{ $message }}</span>@enderror --}}
                          {{-- </div> --}}
                            @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          {{-- <label for="validationCustomUsername">Pago</label> --}}
                          {{-- <div class="col-md-3 mb-3" wire:key="customControlInline2"> --}}
                              <div class="custom-control custom-checkbox my-1 mr-sm-2  mb-3" >
                                  <input type="checkbox" wire:model.defer="status" class="custom-control-input" id="customControlInline2">
                                  <label class="custom-control-label" for="customControlInline2">No</label>
                              </div>
                                {{-- @error('poll') <span class="error text-danger">{{ $message }}</span>@enderror --}}
                          {{-- </div> --}}
                            @error('status') <span class="error text-danger">{{ $message }}</span>@enderror
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
            $("#createModal").modal("hide");
        });
    });

</script>

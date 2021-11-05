<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="createModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deportes | Agregar Deporte</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button> --}}
            </div>
           <div class="modal-body">
                <div class="container">
          				<form wire:submit.prevent="store()" method="POST">
          					{{-- <div class="form-row"> --}}
                        <div class="col-md-12 mb-3">
                          <label for="validationCustom01">Nombre</label>
                          <input wire:model.defer="name" type="text" name="name" class="form-control" id="validationCustom01"  placeholder="Nombre">
                          @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>
                        
                      {{-- </div> --}}
                      
                      <div class="modal-footer"></div>
                      <div class="col-md-12 mb-3 text-center">
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
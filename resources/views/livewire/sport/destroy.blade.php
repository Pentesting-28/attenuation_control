<div wire:ignore.self class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <img src="{{ asset('/images/eliminar.jpg') }}" alt="notify" style="width: 350px; margin-left: auto; margin-right:auto">
        <div class="text-center mt-3">
          <h4 class="font-weight-bold">
            Está seguro que desea eliminarlo ?
          </h4>
          <h4>
            No podrá revertir ni cambiar esto.
          </h4>
        </div>
      </div>

      <div class="modal-footer justify-center">
        <button type="button" wire:click.prevent="clearProperty()"class="btn btn-sm btn-secondary" data-dismiss="modal">Volver</button>
        <button type="button" wire:click.prevent="destroy({{ $sport_id }})" class="btn btn-sm btn-success" >Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    document.addEventListener('livewire:load', () => {
       @this.on('modalHide', () => {
            $("#destroyModal").modal("hide");
        });
    });

</script>
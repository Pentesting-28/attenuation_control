<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="paymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #111;">
                <h5 class="modal-title text text-white" id="exampleModalLabel">Alumnos | Estatus de pago.</h5>
            </div>
           <div class="modal-body">
                <div class="container">
                    <form wire:submit.prevent="statusPaymentUpdate()" method="POST">
                        <div class="text-center">
                            <div class="py-1">
                                <label for="validationCustom04">Pago</label>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" wire:model.defer="select_status_payment" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">SI</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" wire:model.defer="select_status_payment" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                                        <label class="form-check-label" for="inlineRadio2">NO</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" wire:click.prevent="clearProperty()"class="grow_box grow_box_dark btn-sm" data-dismiss="modal" title="Cancelar Registro">Volver</button>
                                <button type="submit" class="grow_box grow_box_green btn-sm" title="Guardar Registro">Aceptar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    document.addEventListener('livewire:load', () => {
       @this.on('modalPaymentShow', () => {
            $("#paymentModal").modal("show");
        });
    });

    document.addEventListener('livewire:load', () => {
       @this.on('modalPaymentHide', () => {
            $("#paymentModal").modal("hide");
        });
    });
</script>

<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="absenceModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #111;">
                <h5 class="modal-title text text-white" id="exampleModalLabel">Alumnos | Justificar inasistencia.</h5>
            </div>
           <div class="modal-body">
                <div class="container">
                    <div class="col-md-12 " align="center">
                        @if ($data_student_select != null)
                            <h4>{{ $data_student_select->name }} {{ $data_student_select->last_name }}</h4>
                        @endif
                    </div>
                    <form wire:submit.prevent="absenceJustificationStore()" method="POST">
                        <div class="col-md-12 mb-3" wire:ignore>
                        <label for="validationCustomUsername">Descripción</label>
                        <textarea class="form-control" wire:model="description" id="description" rows="5" style="resize: none;"></textarea>
                        </div>
                        <div>
                            @error('description') <span class="error text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="clearProperty()"class="grow_box grow_box_dark btn-sm" data-dismiss="modal" title="Cancelar Registro">Volver</button>
                            <button type="submit" class="grow_box grow_box_green btn-sm" title="Guardar Registro">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    document.addEventListener('livewire:load', () => {
       @this.on('modalShow', () => {
            $("#absenceModal").modal("show");
        });
    });

    document.addEventListener('livewire:load', () => {
       @this.on('modalHide', () => {
            $("#absenceModal").modal("hide");
        });
    });
</script>

<script src="https://cdn.tiny.cloud/1/t6azg0zybtcuxa22la4mfcrrs9jc153k89z0u3jk3bno1oig/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
  tinymce.init({
        selector: "#description",
        height: (window.innerHeight - 420),
        plugins: 'autoresize',
      autoresize_bottom_margin: 100,
        // height : "100",
        branding: false,
        // forced_root_block: false,
        language: "es"  ,
        setup: function (editor) {

            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
                @this.set('description', editor.getContent());
            });
        },
    });
</script>

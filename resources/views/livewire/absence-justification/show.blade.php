<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="showModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inasistencias | Justificación.</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    @if ($data_student != null)
          				<div class="col-md-12 " align="center">
                            <h4 >{{ $data_student->student->name }} {{ $data_student->student->last_name }}</h4>
                        </div>
                        <div>
                            <div class="col-md-12">
                                <label for="validationCustom01"><b>Descripción</b></label>
                                <p class="text-justify">
                                    {{ strip_tags( $data_student->description ) }}
                                </p>
                            </div>
                        </div>
                    @endif
                    <div class="modal-footer"></div>
                    <div class="col-md-12 mb-3 text-center">
                       <button type="button" wire:click.prevent="clearProperty()"class="btn btn-sm btn-secondary" data-dismiss="modal" title="Volver">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

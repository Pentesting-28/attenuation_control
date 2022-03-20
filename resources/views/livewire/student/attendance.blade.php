<div>
    <main class="py-4">
        <div class="container">
            @include('livewire.student.justification_for_absence')
            @include('livewire.student.form_payment')
    		<div class="card card_attendance mb-1 pt-1">
				<div class="text-center">
					<img class="btAltLogo" src="{{ asset('images/centrohes2.png') }}" id="logo2" alt="Hermanos Enderica Salgado">
				</div>
                <div class="card-body" >
                    <div class="col-md-12 text-center">

                        @if ($data_student_select != null)
                            <h4 >{{ $data_student_select->last_name }} {{ $data_student_select->name }}</h4>
                        @endif

                    </div>
                    <div wire:ignore>
                        <ul class="nav nav-tabs" id="myTab" role="tablist" >
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="form-entry" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Entrada</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="form-exit" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Salida</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent" >
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="form-entry" >
                                <div class="container pt-4">
                                    <form wire:submit.prevent="entryAlumn()" method="POST">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01">Datos personales</label>
                                                <input wire:model="last_name" type="text" name="last_name" id="last_name" class="form-control" id="validationCustom01"  placeholder="Apellido y Nombre">
                                                @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6" >
                                                <label for="validationCustom03">Código</label>
                                                <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo">
                                                @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="btn-clear-up" class="grow_box grow_box_green btn-sm" title="Limpiar" style="display:none;">Limpiar</button>
                                            <button type="button" id="btn-justify-absence" wire:click="$emit('validateData')" class="grow_box grow_box_dark btn-sm" title="Justificar Inasistencia"  style="display:none;">Justificar Inasistencia</button>
                                            <button type="submit" id="btn-register" class="grow_box grow_box_green btn-sm" title="Guardar Registro" style="display:none;">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="form-exit">
                                <div class="container pt-4">
                                    <form wire:submit.prevent="exitAlumn()" method="POST">
                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01">Datos personales</label>
                                                <input wire:model="last_name" type="text" name="last_name" id="last_name" class="form-control" id="validationCustom01"  placeholder="Apellido y Nombre">
                                                @error('last_name') <span class="error text-danger">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-3" >
                                                <label for="validationCustom03">Codigo</label>
                                                <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo" >
                                                @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" id="btn-clear-up-exit"  class="grow_box grow_box_dark btn-sm" title="Limpiar" style="display:none;">Limpiar</button>
                                            <button type="submit" id="btn-register-exit" class="grow_box grow_box_green btn-sm" title="Guardar Registro" style="display:none;">Registrar</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    	    </div>

            <br>

            <div class="card mb-4" id="student-selection-chart" style="background-color: #e9ecef; display:none;">
                <div class="card-body">
                    <div class="table-responsive py-3">
                        <table class="table" width="100%" cellspacing="0">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">Id</th>
                                <th >Nombre</th>
                                <th >Apellido</th>
                                <th >Genero</th>
                                <th >Selección</th>
                            </tr>
                            </thead>
                                @foreach($data_student as $student)
                                    <tbody class="text-center">
                                        <tr>
                                            <th>{{ $student->id }}</th>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td class="text-center">
                                                <a title="Seleccionar estudiante" wire:click="selectStudent( {{ $student->id }} )" >
                                                    <button class="grow_box grow_box_green btn pt-1" style=""><i class="far fa-hand-pointer" style="font-size: 24px;"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
	    </div>
    </main>
</div>

<script type="text/javascript">

	var a1 = document.getElementById("form-entry");

        a1.addEventListener("click", function()
        {
            Livewire.emit('clearProperty');
        });

    var a2 = document.getElementById("form-exit");

        a2.addEventListener("click", function()
        {
            Livewire.emit('clearProperty');

        });

    var a3 = document.getElementById("btn-clear-up");

        a3.addEventListener("click", function()
        {
            Livewire.emit('clearProperty');

        });

    var a4 = document.getElementById("btn-clear-up-exit");

        a4.addEventListener("click", function()
        {
            Livewire.emit('clearProperty');

        });

    document.addEventListener('livewire:load', () => {

        @this.on('confirm_register_entry', () => {
            successAlertRegisterEntry();
        });

        @this.on('error_validation', () => {
            errorsAlertStudent();
        });

        @this.on('error_validation_info', () => {
            errorsAlertStudentInfo();
        });

        @this.on('error_validation_info_entry', () => {
            errorsAlertStudentInfoEntry();
        });

        @this.on('error_validation_info_exit', () => {
            errorsAlertStudentInfoExit();
        });

        @this.on('error_validation_info_no_register', () => {
            errorsAlertStudentInfoNotRegister();
        });

        @this.on('error_validation_info_no_select_payment', () => {
            errorsAlertStudentInfoNotSelectPayment();
        });

        @this.on('hide_table', () => {

            $("#student-selection-chart").hide();

        });

        @this.on('show_table', () => {

            $("#student-selection-chart").show();

        });

        @this.on('show_btn_forms', () => {

            $("#btn-register").show();
            $("#btn-justify-absence").show();
            $("#btn-clear-up").show();
            $("#btn-register-exit").show();
            $("#btn-clear-up-exit").show();

        });

        @this.on('hide_btn_forms', () => {

            $("#btn-register").hide();
            $("#btn-justify-absence").hide();
            $("#btn-clear-up").hide();
            $("#btn-register-exit").hide();
            $("#btn-clear-up-exit").hide();

        });

        //   @this.on('show_payment', () => {

        //     document.getElementById('inlineRadio1').disabled = false;
        //     document.getElementById('inlineRadio2').disabled = false;

        //   });

        //   @this.on('hide_payment', () => {

        //     document.getElementById('inlineRadio1').disabled = true;
        //     document.getElementById('inlineRadio1').checked  = false;

        //     document.getElementById('inlineRadio2').disabled = true;
        //     document.getElementById('inlineRadio2').checked  = false;

        //   });
    });

</script>

<div>
    <main class="py-4">
	<div class="container">
		@include('livewire.student.justification_for_absence')
    		<div class="card mb-1 pt-1" style="background-color: #e9ecef;">
				<div class="text-center">
					<img class="btAltLogo" src="{{ asset('images/centrohes2.png') }}" id="logo2" alt="Hermanos Enderica Salgado">
				</div>
    		<div class="card-body" >
    			<div class="col-md-12 " align="center">

                  @if ($data_student != null)

                    <h4 >{{ $data_student->name }} {{ $data_student->last_name }}</h4>

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
		                          <label for="validationCustom01">Nombre</label>
		                          <input wire:model="name" type="text" name="name" class="form-control" id="validationCustom01"  placeholder="Nombre">
		                          @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
		                        </div>

		                        <div class="col-md-6 mb-3" >
		                            <label for="validationCustom03">Codigo</label>
		                            <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo">
		                            @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
		                        </div>
		                      </div>
		                      <div class="modal-footer">
		                         <button type="submit" class="btn btn-sm btn-success" title="Guardar Registro">Aceptar</button>
		                      </div>
		                    </form>
	                	</div>

					  </div>
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="form-exit">
					  	<div class="container pt-4">
	          				<form wire:submit.prevent="exitAlumn()" method="POST">
		      					<div class="form-row">
		                        <div class="col-md-6 mb-3">
		                          <label for="validationCustom01">Nombre</label>
		                          <input wire:model="name" type="text" name="name" class="form-control" id="validationCustom01"  placeholder="Nombre">
		                          @error('name') <span class="error text-danger">{{ $message }}</span>@enderror
		                        </div>

		                        <div class="col-md-6 mb-3" >
		                            <label for="validationCustom03">Codigo</label>
		                            <input wire:model="code" type="text" class="form-control" id="validationCustom03"  placeholder="Codigo" >
		                            @error('code') <span class="error text-danger">{{ $message }}</span>@enderror
		                        </div>
		                      </div>
		                      <div class="modal-footer">
		                         <button type="submit" class="btn btn-sm btn-success" title="Guardar Registro">Aceptar</button>
		                      </div>
		                    </form>
	                	</div>
					  </div>
					</div>
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

document.addEventListener('livewire:load', () => {
   
    // Livewire.hook('message.processed', (message, component) => {

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

    // })
});

</script>
<div>
    <main class="py-4">
	<div class="container">
    	<div class="card mb-4">
    		<div class="card-body">
		    	<ul class="nav nav-tabs text-center" id="myTab" role="tablist" wire:ignore>
				  <li class="nav-item" role="presentation">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" wire:click="clearProperty()" role="tab" aria-controls="home" aria-selected="true">Entrada</a>
				  </li>
				  <li class="nav-item" role="presentation">
				    <a class="nav-link" id="profile-tab" data-toggle="tab" wire:click="clearProperty()" role="tab" aria-controls="profile" aria-selected="false">Salida</a>
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

				  	<div class="container pt-4">
          				<form wire:submit.prevent="entryAlunm()" method="POST">
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
				  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				  	<div class="container pt-4">
          				<form wire:submit.prevent="exitAlunm()" method="POST">
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
    </main>
</div>

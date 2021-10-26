require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Swal from "sweetalert2";

window.successAlertCreate = function (){
    Swal.fire('Creado con éxito!', '', 'success');
}

window.successAlertUpdate = function (){
    Swal.fire('Actualizado con éxito!', '', 'success');
}

window.errorsAlertStudent = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'error',
	  title: 'Datos invalidos',
	  showConfirmButton: false,
	  timer: 2300
	});
}
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
	  title: 'Datos invalidos.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

window.errorsAlertStudentInfo = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'info',
	  title: 'Debe llenar al menos un campo.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

window.errorsAlertStudentInfoEntry = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'info',
	  title: 'Ya fue registrada su entrada.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

window.errorsAlertStudentInfoExit = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'info',
	  title: 'Ya fue registrada su salida.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

window.errorsAlertStudentInfoNotRegister = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'warning',
	  title: 'No ha sido registrado el dia de hoy.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

window.successAlertRegisterEntry = function (){
    Swal.fire('Registrado con éxito!', '', 'success');
}

window.errorsAlertSelectSport = function () {
	Swal.fire({
	  position: 'top-end',
	  icon: 'info',
	  title: 'Seleccione al menos un deporte.',
	  showConfirmButton: false,
	  timer: 2300
	});
}

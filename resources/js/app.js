require('./bootstrap');

import Alpine from 'alpinejs';

import AirDatepicker from 'air-datepicker'
import 'air-datepicker/air-datepicker.css'

import {createPopper} from '@popperjs/core';
import anime from 'animejs';

import Swal from "sweetalert2";

window.Alpine = Alpine;

Alpine.start();

window.successAlertCreate = function() {
    Swal.fire('Creado con éxito!', '', 'success');
}

window.successAlertUpdate = function() {
    Swal.fire('Actualizado con éxito!', '', 'success');
}

window.errorsAlertStudent = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Datos invalidos.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.errorsAlertStudentInfo = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'Debe llenar al menos un campo.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.errorsAlertStudentInfoEntry = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'Ya fue registrada su entrada.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.errorsAlertStudentInfoExit = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'Ya fue registrada su salida.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.errorsAlertStudentInfoNotRegister = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'No ha sido registrado el dia de hoy.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.successAlertRegisterEntry = function() {
    Swal.fire('Registrado con éxito!', '', 'success');
}

window.errorsAlertSelectSport = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'Seleccione al menos un deporte.',
        showConfirmButton: false,
        timer: 2300
    });
}

window.errorsAlertStudentInfoNotSelectPayment = function() {
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: 'Seleccione si esta al dia con sus pagos.',
        showConfirmButton: false,
        timer: 2350
    });
}

document.addEventListener("DOMContentLoaded", () => {
    
    let FORMAT_DATEPICKER='yyyy-MM-dd';

    new AirDatepicker("#datePickerInvoices",{
        dateFormat: FORMAT_DATEPICKER,
        view: 'months',
        minView: 'months',
        locale: {
            monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            today: 'Hoy',
            clear: 'Limpiar',
            dateFormat: FORMAT_DATEPICKER,
            firstDay: 1
        },
        position({$datepicker, $target, $pointer, isViewChange, done}) {
            let popper = createPopper($target, $datepicker, {
                placement: 'bottom',
                onFirstUpdate: state => {
                    !isViewChange && anime.remove($datepicker);

                    $datepicker.style.transformOrigin = 'center top';

                    !isViewChange && anime({
                        targets: $datepicker,
                        opacity: [0, 1],
                        rotateX: [-90, 0],
                        easing: 'spring(1.3, 80, 5, 0)',
                    })

                },
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 10]
                        }
                    },
                    {
                        name: 'arrow',
                        options: {
                            element: $pointer,
                        }
                    },
                    {
                        name: 'computeStyles',
                        options: {
                            gpuAcceleration: false,
                        },
                    },
                ]
            });
            return () => {
                anime({
                    targets: $datepicker,
                    opacity: 0,
                    rotateX: -90,
                    duration: 300,
                    easing: 'easeOutCubic'
                }).finished.then(() => {
                    popper.destroy();
                    done();
                })
            }
        },
        showOtherMonths: false,
        showOtherYears: false,
        selectOtherMonths: false,
        selectOtherYears: false,
        autoClose: true,
        classes: "dp-date-render",
        buttons: 'clear',
        onSelect: function onSelect(selectedDates) {
            //console.log(selectedDates.formattedDate);
            fh(selectedDates.formattedDate);
        }
    });
});
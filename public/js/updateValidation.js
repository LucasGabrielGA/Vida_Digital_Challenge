/* Función de Boostrap la validación de datos en los inputs de mis formularios de modificación */
function updateValidateData() {
    'use strict'

    var forms = document.querySelectorAll('.update-needs-validation'); //Guardo los elementos que tengan el string indicado.

    
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
}
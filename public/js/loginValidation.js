/* Función de Boostrap la validación de datos en los inputs de mis formularios en Login */
function validateData() {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation'); //Guardo los elementos que tengan el string indicado.

    
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
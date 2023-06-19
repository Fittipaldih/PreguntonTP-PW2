
document.addEventListener("DOMContentLoaded", function() {
    //class name devuelve un array
    var editElements = document.querySelectorAll(".editQuestion");
    var modal=new bootstrap.Modal(document.getElementById("editModal"));

    //recorro array
    editElements.forEach(function(button) {
        button.addEventListener("click", function() {
            // Obtener la fila correspondiente en la tabla
            var row = button.closest("tr");

            // Obtener los valores de los campos de la fila
            var id = (row.querySelector("td:nth-child(1)").textContent).replace("# ", "");
            var descripcion = row.querySelector("td:nth-child(2)").textContent;
            var opcionA = row.querySelector("td:nth-child(3)").textContent;
            var opcionB = row.querySelector("td:nth-child(4)").textContent;
            var opcionC= row.querySelector("td:nth-child(5)").textContent;
            var opcionD= row.querySelector("td:nth-child(6)").textContent;
            var respuestaCorrecta = row.querySelector("td:nth-child(7)").textContent;

            // Rellenar los campos de entrada del modal con los datos de la fila
            var idInput = document.querySelector("#editModal input[name='id']");
            var descripcionInput = document.querySelector("#editModal input[name='descripcion']");
            var opcionAInput = document.querySelector("#editModal input[name='opcionA']");
            var opcionBInput = document.querySelector("#editModal input[name='opcionB']");
            var opcionCInput = document.querySelector("#editModal input[name='opcionC']");
            var opcionDInput = document.querySelector("#editModal input[name='opcionD']");
            var respuestaCorrectaInput = document.querySelector("#editModal input[name='respuestaCorrecta']");
            idInput.value = id;
            descripcionInput.value = descripcion;
            opcionAInput.value = opcionA;
            opcionBInput.value=opcionB;
            opcionCInput.value=opcionC;
            opcionDInput.value=opcionD;
            respuestaCorrectaInput.value=respuestaCorrecta;

            modal.show();
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var deleteElements = document.getElementsByClassName("deleteQuestion");
    var modal=new bootstrap.Modal(document.getElementById("deleteModal"));

    for (var i = 0; i < deleteElements.length; i++) {
        deleteElements[i].addEventListener("click", function () {
            modal.show();
        });
    }
});
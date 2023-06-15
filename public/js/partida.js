function cargarAjax() {
    // Llama a la función de AJAX nuevamente
    $.ajax({
        url: 'http://localhost/partida/renderQuestionData',
        method: 'GET',
        dataType: 'json',
        success: function (question) {
            $('#questionDescripcion').text(question.descripcion);
            $('#opciona').text(question.opcionA);
            $('#opcionb').text(question.opcionB);
            $('#opcionc').text(question.opcionC);
            $('#opciond').text(question.opcionD);
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}

function selected(value) {
    console.log(value);
    $.ajax({
        url: 'http://localhost/partida/checkAnswer',
        method: 'POST',
        data: {'optionSelected': value},
        dataType: 'json'
    }).done(function (response) {
        if (response.success) {
           /* $('#userCorrects').text(response.userCorrects);
            $('#opcion' + value).removeClass('btn-primary').addClass('btn-success');*/
            cargarAjax();
        } else {
            window.location.href = "lobby";
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}

$(document).ready(function () {
    cargarAjax();
});

/*
     window.onload = function()  {
         $.ajax({
             url: 'http://localhost/partida/renderQuestionData',
             method: 'GET',
             dataType: 'json',
             success: function (question) {
                 $('#questionDescripcion').text(question.descripcion);
                 $('#opciona').text(question.opcionA);
                 $('#opcionb').text(question.opcionB);
                 $('#opcionc').text(question.opcionC);
                 $('#opciond').text(question.opcionD);

                 console.log(question);
             },
             error: function (xhr, status, error) {
                 // Maneja los errores aquí
                 console.log(error);
             }
         });
     }

    var i = 0;
    window.onload = function() {
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("myBar");
            var width = 1;
            var id = setInterval(frame, 108);
            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                    console.log("asd");
                    document.getElementById("opciona").click();
                } else {
                    width++;
                    elem.style.width = width + "%";

                }
            }
        }
    }
     */
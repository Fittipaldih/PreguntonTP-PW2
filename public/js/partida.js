$(document).ready(function() {
    cargarAjax();
});


let progressInterval = setInterval(animateProgressBar, 100);
const progressBar = document.getElementById("myProgressBar");
const duration = 10010;
const finalWidth = 100;
const incrementWidth = (finalWidth / duration) * 100;
let currentWidth = 0;

function animateProgressBar() {
    currentWidth += incrementWidth;
    progressBar.style.width = `${currentWidth}%`;
    if (currentWidth >= finalWidth) {
        clearInterval(progressInterval);
    }
}

function resetProgressBar() {
    clearInterval(progressInterval);
    currentWidth = 0;
    progressInterval = setInterval(animateProgressBar, 100);
}

function cargarAjax() {
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
        data: { 'optionSelected': value },
        dataType: 'json'
    }).done(function(response) {
        if (response.success) {
            cargarAjax();
            resetProgressBar();
        } else {
            window.location.href = "lobby";
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}
document.addEventListener("DOMContentLoaded", function() {
    var opciona = document.getElementById("opciona");
    var opcionb = document.getElementById("opcionb");
    var opcionc = document.getElementById("opcionc");
    var opciond = document.getElementById("opciond");

    opciona.addEventListener("click", function() {
        selected(opciona.value);
    });
    opcionb.addEventListener("click", function() {
        selected(opcionb.value);
    });
    opcionc.addEventListener("click", function() {
        selected(opcionc.value);
    });
    opciond.addEventListener("click", function() {
        selected(opciond.value);
    });
});

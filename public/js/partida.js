$(document).ready(function() {
    cargarAjax();
});

let progressInterval;
const progressBar = document.getElementById("myProgressBar");
const cronometroElement = document.getElementById("cronometro");
const duration = 10000;
const finalWidth = 100;
const incrementWidth = (finalWidth / duration) * 100;
let currentWidth = 0;
let startTime;

function animateProgressBar() {
    currentWidth += incrementWidth;
    progressBar.style.width = `${currentWidth}%`;

    if (!startTime) {
        startTime = Date.now();
    }

    const elapsedTime = Date.now() - startTime;
    const remainingTime = duration - elapsedTime;
    const formattedTime = formatTime(remainingTime);
    cronometroElement.textContent = formattedTime;

    if (currentWidth >= finalWidth || remainingTime <= 0) {
        clearInterval(progressInterval);
        window.location.href = "/lobby";
    }
}

function formatTime(time) {
    const seconds = Math.ceil(time / 1000);
    return seconds.toString();
}

function resetProgressBar() {
    clearInterval(progressInterval);
    currentWidth = 0;
    startTime = null;
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
            resetProgressBar();
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

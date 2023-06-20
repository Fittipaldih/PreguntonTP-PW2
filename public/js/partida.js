$(document).ready(function () {
    cargarAjax();
});
let progressInterval;
const progressBar = document.getElementById("myProgressBar");
const cronometroElement = document.getElementById("cronometro");
const duration = 11000;
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
    const adjustedSeconds = Math.max(seconds - 1, 0);
    return adjustedSeconds.toString();
}
function cargarAjax() {
    $.ajax({
        url: 'http://localhost/partida/renderQuestionData',
        method: 'GET',
        dataType: 'json',
        success: function (question) {
            resetProgressBar();
            setDataQuestion(question);
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}
function resetProgressBar() {
    clearInterval(progressInterval);
    currentWidth = 0;
    startTime = null;
    progressInterval = setInterval(animateProgressBar, 100);
}
function setDataQuestion(question) {
    $('#questionCategory').text(question.catDescripcion);
    $('#questionDescripcion').text(question.descripcion);
    $('#opciona').text(question.opcionA);
    $('#opcionb').text(question.opcionB);
    $('#opcionc').text(question.opcionC);
    $('#opciond').text(question.opcionD);
    $('#idQuestionHidden').val(question.id);
    setContainerColor(question);
}
function setContainerColor(question) {
    var categoria = question.id_categoria;
    switch (categoria) {
        case '1':
            $('#contPartida').css('background-color', '#58f75d');
            break;
        case '2':
            $('#contPartida').css('background-color', '#f7a058');
            break;
        case '3':
            $('#contPartida').css('background-color', '#f75858');
            break;
        case '4':
            $('#contPartida').css('background-color', '#ad58f7');
            break;
        case '5':
            $('#contPartida').css('background-color', '#f7ef58');
            break;
        default:
            $('#contPartida').css('background-color', '#646464');
            break;
    }
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
            cargarAjax();
        } else {
            window.location.href = "lobby";
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}
document.addEventListener("DOMContentLoaded", function () {
    var opciona = document.getElementById("opciona");
    var opcionb = document.getElementById("opcionb");
    var opcionc = document.getElementById("opcionc");
    var opciond = document.getElementById("opciond");

    opciona.addEventListener("click", function () {
        opciona.classList.add("btn-dark");
        opcionb.disabled = true;
        opcionc.disabled = true;
        opciond.disabled = true;
        setTimeout(function () {
            selected(opciona.value);
            opciona.classList.remove("btn-dark" +
                "");
            opcionb.disabled = false;
            opcionc.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opcionb.addEventListener("click", function () {
        opcionb.classList.add("btn-dark" +
            "");
        opciona.disabled = true;
        opcionc.disabled = true;
        opciond.disabled = true;
        setTimeout(function () {
            selected(opcionb.value);
            opcionb.classList.remove("btn-dark" +
                "");
            opciona.disabled = false;
            opcionc.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opcionc.addEventListener("click", function () {
        opcionc.classList.add("btn-dark" +
            "");
        opciona.disabled = true;
        opcionb.disabled = true;
        opciond.disabled = true;
        setTimeout(function () {
            selected(opcionc.value);
            opcionc.classList.remove("btn-dark" +
                "");
            opciona.disabled = false;
            opcionb.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opciond.addEventListener("click", function () {
        opciond.classList.add("btn-dark" +
            "");
        opciona.disabled = true;
        opcionb.disabled = true;
        opcionc.disabled = true;
        setTimeout(function () {
            selected(opciond.value);
            opciond.classList.remove("btn-dark" +
                "");
            opciona.disabled = false;
            opcionb.disabled = false;
            opcionc.disabled = false;
        }, 500);
    });
});

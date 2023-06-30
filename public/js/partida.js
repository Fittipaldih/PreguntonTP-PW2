let progressInterval;
const progressBar = document.getElementById("myProgressBar");
const cronometroElement = document.getElementById("cronometro");
let duration = 11000;
const finalWidth = 100;
let incrementWidth = (finalWidth / duration) * 100;
let currentWidth = 0;
let startTime;
let countCorrect = -1;
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
            submitOption(opciona.value);
            opciona.classList.remove("btn-dark" + "");
            opcionb.disabled = false;
            opcionc.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opcionb.addEventListener("click", function () {
        opcionb.classList.add("btn-dark" + "");
        opciona.disabled = true;
        opcionc.disabled = true;
        opciond.disabled = true;
        setTimeout(function () {
            submitOption(opcionb.value);
            opcionb.classList.remove("btn-dark" + "");
            opciona.disabled = false;
            opcionc.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opcionc.addEventListener("click", function () {
        opcionc.classList.add("btn-dark" + "");
        opciona.disabled = true;
        opcionb.disabled = true;
        opciond.disabled = true;
        setTimeout(function () {
            submitOption(opcionc.value);
            opcionc.classList.remove("btn-dark" + "");
            opciona.disabled = false;
            opcionb.disabled = false;
            opciond.disabled = false;
        }, 500);
    });
    opciond.addEventListener("click", function () {
        opciond.classList.add("btn-dark" + "");
        opciona.disabled = true;
        opcionb.disabled = true;
        opcionc.disabled = true;
        setTimeout(function () {
            submitOption(opciond.value);
            opciond.classList.remove("btn-dark" + "");
            opciona.disabled = false;
            opcionb.disabled = false;
            opcionc.disabled = false;
        }, 500);
    });
});
$(document).ready(function () {
    let remainingTime;
    if (sessionStorage.getItem('gameStarted')) {
        // La partida ya ha comenzado, restaurar el estado actual
        countCorrect = parseInt(sessionStorage.getItem('countCorrect'));
        setQuestionData(JSON.parse(sessionStorage.getItem('currentQuestion')), countCorrect);
        currentWidth = parseInt(sessionStorage.getItem('currentWidth'));
        remainingTime = parseInt(sessionStorage.getItem('remainingTime'));
        if (currentWidth < finalWidth && remainingTime > 0) {
            resetProgressBar(remainingTime); // Establecer el tiempo restante antes de iniciar la animación
        }
    } else {
        loadNewQuestion();
    }
});
function loadNewQuestion() {
    $.ajax({
        url: 'http://localhost/partida/getQuestionData',
        method: 'GET',
        data: {countCorrect: countCorrect},
        dataType: 'json',
        success: function (question) {
            countCorrect++;
            setQuestionData(question, countCorrect);
            resetProgressBar(11000);
            sessionStorage.setItem('gameStarted', true);
            sessionStorage.setItem('countCorrect', countCorrect);
            sessionStorage.setItem('currentQuestion', JSON.stringify(question));
            sessionStorage.setItem('currentWidth', currentWidth);
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}
function submitOption(value) {
    console.log(value);
    $.ajax({
        url: 'http://localhost/partida/checkAnswer',
        method: 'POST',
        data: {'optionSelected': value},
        dataType: 'json'
    }).done(function (response) {
        if (response.success) {
            loadNewQuestion();
        } else {
            sessionStorage.clear();
            window.location.href = "lobby";
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}
function setQuestionData(question, count) {
    $('#questionCategory').text(question.catDescripcion);
    $('#questionDescripcion').text(question.descripcion);
    $('#opciona').text(question.opcionA);
    $('#opcionb').text(question.opcionB);
    $('#opcionc').text(question.opcionC);
    $('#opciond').text(question.opcionD);
    $('#userCorrects').text("Cantidad de respuestas correctas: " + count);
    $('#idQuestionHidden').val(question.id);
    setContainerColor(question);
}
function setContainerColor(question) {
    const categoria = question.id_categoria;
    switch (categoria) {
        case '1':
            $('#contPartida').css('background-color', '#58f75d');
            break;
        case '2':
            $('#contPartida').css('background-color', '#f7a058');
            break;
        case '3':
            $('#contPartida').css('background-color', '#f758a8');
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
function resetProgressBar(remainingTime) {
    clearInterval(progressInterval);
    currentWidth = 0;
    startTime = null;
    duration = remainingTime; // Establecer la duración de la animación al tiempo restante
    incrementWidth = (finalWidth / duration) * 100; // Recalcular el incremento de ancho
    progressInterval = setInterval(animateProgressBar, 100);
}
function animateProgressBar() {
    currentWidth += incrementWidth;
    progressBar.style.width = `${currentWidth}%`;
    if (!startTime) {
        startTime = Date.now();
    }
    const elapsedTime = Date.now() - startTime;
    const remainingTime = duration - elapsedTime;
    cronometroElement.textContent = formatTime(remainingTime);
    updateProgressBarColors(remainingTime);

    if (currentWidth >= finalWidth || remainingTime <= 0) {
        clearInterval(progressInterval);
    }
    sessionStorage.setItem('remainingTime', remainingTime.toString());
}
function updateProgressBarColors(remainingTime) {
    if (remainingTime < 6000 && remainingTime > 3000) {
        setProgressBarColors('#FF9C02', '#FF9C02');
    } else if (remainingTime < 3000 && remainingTime > 1000) {
        setProgressBarColors('#FF0000', '#FF0000');
    } else if (remainingTime < 1000) {
        setProgressBarColors('#880000', '#880015');
    } else {
        setProgressBarColors('', '');
    }
}
function setProgressBarColors(cronometroColor, progressBarColor) {
    cronometroElement.style.setProperty('color', cronometroColor, 'important');
    progressBar.style.setProperty('background-color', progressBarColor, 'important');
}
function formatTime(time) {
    const seconds = Math.ceil(time / 1000);
    const adjustedSeconds = Math.max(seconds - 1, 0);
    return adjustedSeconds.toString();
}
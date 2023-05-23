<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP Final</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<header>
    <?php
    include_once("partial/header.php");
    ?>
</header>

<!-- Modal Comenzar -->
<div class="modal" id="comenzar">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Comenzemos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            aca va algo
            </div>

            <!-- Modal footer -->
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cerrar</button>
                <a href="index.php" class="btn btn-primary">Y ahora?</a>
            </div>

        </div>
    </div>
</div>

<main class="py-5">
    <div class="container px-lg-5 p-4 bg-light rounded-3 text-center">
        <div class="m-4 m-lg-5">
            <h1 class="display-5 fw-bold">¿Qué esperás para jugar?</h1>
            <p class="fs-4">¡Divertite con el juego de trivia más interesante!</p>
            <p class="fs-5">Respondé todas las preguntas para subir en el ranking y desafiar a tus amigos.</p>

            <a class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#comenzar" href="javascript:void(0)">Comenzar</a>
        </div>
    </div>
</main>

<footer class="py-5 bg-dark footer fixed-bottom">
    <?php
    include_once("partial/footer.php");
    ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>


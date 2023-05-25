<!DOC<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lobby</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<header>
    <?php
    include_once("partial/header.mustache");
    ?>
</header>
<main class="py-5">
    <div class="container px-lg-5 p-4 bg-light rounded-3">
            <div>
                <img src="../public/imagenes/perfil.jpg" width="50px" class="rounded mx-auto d-block">
            </div>
        <h1 class="text-center display-5 fw-bold">¿Cuál de los siguientes planetas del sistema solar es
            conocido como "el planeta rojo"</h1>
        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <button class="btn btn-primary btn-lg">A)Mercurio</button>
            <button class="btn btn-primary btn-lg">B)Venus</button>
            <button class="btn btn-primary btn-lg">C)Marte</button>
            <button class="btn btn-primary btn-lg">D)Júpiter</button>
            <p class="text-center">Cantidad de Respuestas Correctas: 10</p>
        </div>
    </div>
</main>
<footer class="py-5 bg-dark footer">
    <?php
    include_once("partial/footer.mustache");
    ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

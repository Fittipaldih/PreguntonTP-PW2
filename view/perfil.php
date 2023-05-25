<!DOCTYPE html>
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
        <img src="../public/imagenes/perfil.jpg" width="200px" class="rounded mx-auto d-block">
        <h1 class="text-center display-3 fw-bold">Fitti</h1>
        <h2 class="text-center">Tu puntaje actual: 132</h2>
        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <img src="../public/imagenes/pais.png" width="30px">
            <p>La Matanza</p>
        </div>
        <div class="mx-auto">
            <h3>Partidas jugadas</h3>
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th>Partida:</th>
                    <th>Resultado:</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Partida 1</td>
                    <td>Resultado 1</td>
                </tr>
                <tr>
                    <td>Partida 2</td>
                    <td>Resultado 2</td>
                </tr>
                <tr>
                    <td>Partida 3</td>
                    <td>Resultado 3</td>
                </tr>
                </tbody>
            </table>
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

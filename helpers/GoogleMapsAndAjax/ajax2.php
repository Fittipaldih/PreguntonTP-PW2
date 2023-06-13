<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script>
        function muestraLocalidad(provincia) {
            var parametros = {
                "provincia" : provincia
            };
            $.ajax({
                data:  parametros,
                url:   'load_localidad2.php',
                type:  'post',
                beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    $("#resultado").html(response);
                }
            });
        }
    </script>

</head>

<body>

<form>
    <select name="provincia" onchange="muestraLocalidad(this.value)">

        <?php
        $connect = mysqli_connect("localhost", "root", "V2t08xjm!", "pf");
        $output = array();
        $query = "SELECT idProvincia,descripcionProvincia FROM provincia group by idProvincia,descripcionProvincia";
        $result = mysqli_query($connect, $query);
        while($fila = mysqli_fetch_array($result))
        {
            echo "<option value='" . $fila["idProvincia"] . "'>" . $fila["descripcionProvincia"] . "</option>";
        }
        ?>
    </select>
</form>
<br>
<div id="resultado"></div>

</body>
</html>
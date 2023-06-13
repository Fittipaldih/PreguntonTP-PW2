<!DOCTYPE html>
<html>
<head>
    <script>
        function muestraLocalidad(provincia) {
            if (provincia=="") {
                document.getElementById("resultado").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest) {
                xmlhttp=new XMLHttpRequest();
            } else {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("resultado").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","load_localidad.php?provincia="+provincia,true);
            xmlhttp.send();
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
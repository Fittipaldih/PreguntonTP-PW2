 <?php  
 $connect = mysqli_connect("localhost", "root", "", "pf");

 $query = "SELECT idLocalidad,descripcionLocalidad FROM provincia WHERE idProvincia=".$_POST["provincia"];
 $result = mysqli_query($connect, $query);
 echo "<select name='localidad'>";
 while($fila = mysqli_fetch_array($result))
 {  
      echo "<option value='" . $fila["idLocalidad"].  "'>" . $fila["descripcionLocalidad"] . "</option>";
 }
 echo "</select>";
 ?>
 <?php  
 $connect = mysqli_connect("localhost", "root", "", "pf");

 $query = "SELECT idLocalidad,descripcionLocalidad FROM provincia WHERE idProvincia=".$_GET["provincia"];
 $result = mysqli_query($connect, $query);
 echo "<table border=1>";
 while($fila = mysqli_fetch_array($result))
 {  
 	  echo "<tr>";
      echo "<td>" . $fila["idLocalidad"].  "</td><td>" . $fila["descripcionLocalidad"] . "</td>";
      echo "<td><input type=button value=Modificar onclick=modificar("  . $fila["idLocalidad"]. ")></td><td><input type=button value=Borrar onclick=borrar("  . $fila["idLocalidad"]. ")></td>";
      echo "</tr>";
 }
 echo "</table>";
 ?>



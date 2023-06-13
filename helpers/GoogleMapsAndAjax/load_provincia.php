 <?php  
 $connect = mysqli_connect("localhost", "root", "", "pf");
 $output = array();  
 $query = "SELECT idProvincia,descripcionProvincia FROM provincia group by idProvincia,descripcionProvincia";  
 $result = mysqli_query($connect, $query);  
 while($row = mysqli_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
echo json_encode($output);
 ?>
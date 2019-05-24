<?php
  $server='localhost';
  $username='id9498726_aircontrol';
  $password='aircontrol';
  $database = 'id9498726_aircontrol';


  // Conectando, seleccionando la base de datos
  $link = mysqli_connect($server, $username, $password)
  or die('No se pudo conectar: ' . mysqli_error());
  mysqli_select_db($link,$database) or die('No se pudo seleccionar la base de datos');
?>


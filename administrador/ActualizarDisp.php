<?php
require("../public/database.php");

$id = $_REQUEST["id"];
$estado = $_REQUEST["estado"];
$mode = $_REQUEST["mode"];
$fan = $_REQUEST["fan"];
$sleep = $_REQUEST["sleep"];
$temp = $_REQUEST["temp"];
$turbo = $_REQUEST["turbo"];

$updatedis = "UPDATE Dispositivo SET T_aire='$temp',Estado='$estado',
              Mode='$mode',Fan='$fan',Sleep='$sleep',Turbo='$turbo' WHERE Nro_serie='$id'";
mysqli_query($link,$updatedis) or die('Consulta fallida: ' . mysqli_error());

?>
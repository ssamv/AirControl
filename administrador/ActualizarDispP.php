<?php
require("../public/database.php");

$id_piso = $_REQUEST["id_piso"];
$elemento = $_REQUEST["elemento"];
$valor_elemento = $_REQUEST["valor_elemento"];    

$selectdis = "SELECT d.Nro_serie 
              FROM Dispositivo d LEFT JOIN Sala s ON d.id_sala=s.id_sala 
              WHERE s.id_piso='$id_piso'";
$consultadis = mysqli_query($link,$selectdis) or die('Consulta mala: '.mysqli_error());

while ($fila = mysqli_fetch_array($consultadis)){
    $nro_dis=$fila['Nro_serie'];

    $updatedis = "UPDATE Dispositivo SET $elemento='$valor_elemento' WHERE Nro_serie='$nro_dis'";
    mysqli_query($link,$updatedis) or die('Consulta fallida: '.mysqli_error());
    
}
?>
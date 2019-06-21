<?php
require("../public/database.php");

$id_edificio = $_REQUEST["id_edificio"];
$elemento = $_REQUEST["elemento"];
$valor_elemento = $_REQUEST["valor_elemento"];    

$selectdis = "SELECT d.Nro_serie 
              FROM Dispositivo d LEFT JOIN Sala s ON d.id_sala=s.id_sala LEFT JOIN Piso p ON s.id_piso=p.id_piso 
              WHERE p.id_edificio='$id_edificio'";
$consultadis = mysqli_query($link,$selectdis) or die('Consulta mala: '.mysqli_error());

while ($fila = mysqli_fetch_array($consultadis)){
    $nro_dis=$fila['Nro_serie'];

    $updatedis = "UPDATE Dispositivo SET $elemento='$valor_elemento' WHERE Nro_serie='$nro_dis'";
    mysqli_query($link,$updatedis) or die('Consulta fallida: '.mysqli_error());
    
}
?>
<?php
	session_start();
	//$t_aire = se podra definir la temperatura del conjunto de dispositivos
	//$estado = se podra definir el estado del dispositivo
	//$piso = se indicará el piso que se necesita actualizar
	//$edif = se indicara el edificio que se actualizará
	function ActualizarEnConjunto($piso,$edif,$t_aire,$estado){

		require("database.php");

		$selectdis = "SELECT d.Nro_serie, d.id_sala, s.id_piso, p.id_edificio, d.T_aire, d.Estado FROM dispositivo d LEFT JOIN sala s ON d.id_sala=s.id_sala LEFT JOIN piso p ON s.id_piso=p.id_piso WHERE s.id_piso='$piso' AND p.id_edificio='$edif'";
		$consultadis = mysqli_query($link,$selectdis) or die('Consulta mala: '.mysqli_error());


		while ($fila = mysqli_fetch_row($consultadis)){

			//printf("%s %s %s %s %s %s\n", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
			//echo "<br>";

			$updatedis = "UPDATE dispositivo SET T_aire='$t_aire', Estado='$estado' WHERE Nro_serie='$fila[0]'";

			mysqli_query($link,$updatedis);

			/*if(mysqli_query($link,$updatedis)){
				echo "Actualizacion hecha<br>";
			}else{
				echo "Actualizacion fallida<br>";
			}*/

		}

		/*$selectdis = "SELECT d.Nro_serie, d.id_sala, s.id_piso, p.id_edificio, d.T_aire, d.Estado FROM dispositivo d LEFT JOIN sala s ON d.id_sala=s.id_sala LEFT JOIN piso p ON s.id_piso=p.id_piso WHERE s.id_piso='$piso' AND p.id_edificio='$edif'";
		$consultadis = mysqli_query($link,$selectdis) or die('Consulta mala: '.mysqli_error());

		while ($fila = mysqli_fetch_row($consultadis)){
			printf("%s %s %s %s %s %s\n", $fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5]);
			echo "<br>";
		}*/
		
	}

	//echo ActualizarEnConjunto(1,1,22,0); 
?>
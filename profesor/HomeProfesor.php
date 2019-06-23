<?php
	session_start();
	require("../public/database.php");

	if(is_null($_POST['id_sala'])){
  }
  else{
    $idsala=$_POST['id_sala'];
    $desc_sala=$_POST['sala'];
    $consulta_dispositivos= "SELECT * FROM Dispositivo WHERE id_sala ='$idsala'";
    $dispositivos= mysqli_query($link,$consulta_dispositivos) or die('Consulta fallida: ' . mysqli_error());
    unset($_POST['id_sala']);
    echo "<script language='javascript'>window.location='#popup'</script>";
  }

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" href="" type="image/png" />
	<title>Aircontrol</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<!--ARCHIVOS CSS-------------------------------------------------------------------------------------------->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="HomeProfesor.css">
        <link rel="stylesheet" href="../public/flexboxgrid.min.css">

	<!--ARCHIVOS 
	JS--------------------------------------------------------------------------------------------->
        <script type="text/javascript" src="HomeProfesor.js"></script>
        <script src="../public/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
	<!--HEADER--------------------------------------------------------------------------------------------->
    <header class="row">
      <div class="centrar-v col-xs-7">
        <img src="../img/usuario.png" text-align="center" width="75px"  alt="No se pudo cargar la imagen">

    <!--IDENTIFICAR PROFESOR-->
        <?php
          function NombreProfesor($resultado){
          	if($resultado!=NULL){
          	  echo $resultado['Nombre']." ".$resultado['A_paterno']." ".$resultado['A_materno'];  	
          	}
          }
          $user=$_SESSION['user_inside'];
          $consulta_profe=mysqli_query($link,"SELECT * FROM usuario WHERE Rut='$user'");
          NombreProfesor(mysqli_fetch_array($consulta_profe));
          //echo $_SESSION['user_inside']; 
        ?>   
      </div>

      <div class="col-xs-5" width="75px" style="text-align:right;">
        <a href="../public/cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a> 
      </div>
    </header>

  <!--SECTION--------------------------------------------------------------------------------------------->  
	<section class="centrar row">

		<!--IDENTIFICAR ASIGNATURA-->  
	  <?php
	    require("../public/database.php");
     	date_default_timezone_set("Chile/Continental");
	    $user=$_SESSION['user_inside'];
	    $dia=date("N");
      $hora=date("H").":".date("i").":".date("s");
	    $hora_c="10:01:00";
	    $consulta_asig=mysqli_query($link,"SELECT * FROM asignatura WHERE rut_prof='$user' AND dia=3 AND hora_inicio<='$hora_c' AND hora_termino>='$hora_c'");
	    $result_asig=mysqli_fetch_array($consulta_asig);
	  ?>

	  <div class="col-xs-10" style="background-color: rgb(255,183,25);">
  	  <h1>Aire Acondicionado</h1>
  	  <h2><?php echo $result_asig['nom_asig']; ?>
  	</div>

		<?php
			/*OBTENIENDO EL CONTENIDO */
	  	$json_file = file_get_contents("http://api.openweathermap.org/data/2.5/weather?id=3871336&APPID=e4c06d9b2a5131bc59c95a42fb15dcd4");
   	  $vars = json_decode($json_file);
			/* ASIGNANDO LOS VALORES */
      $cond = $vars->main;
	  	$temp_c = $cond->temp - 273.15;
  	  $temp_f = 1.8 * ($cond->temp - 273.15) + 32;

	  	$temp_sala="";
	  	function temp_sala($temp,$tempc){
  	    if($temp="temp"){
    	  	$o = round($tempc,1, PHP_ROUND_HALF_ODD);
    	  	$d = rand($o-2 , $o+2);
  	  	}
      	return $d;
			}



			/* IDENTIFICAR SALA */ 
			$id_sala_asig=$result_asig['id_sala'];
  	  $consulta_sala=mysqli_query($link,"SELECT * FROM sala WHERE id_sala='$id_sala_asig'");
		
	  
		  $result_sala=mysqli_fetch_array($consulta_sala);
      $temp_sala=temp_sala("temp",$temp_c);
      $id_sala=$result_sala['id_sala'];
      $consulta_dispositivo= "SELECT * FROM Dispositivo WHERE id_sala ='$id_sala'";
      $dispositivo= mysqli_query($link,$consulta_dispositivo) or die('Consulta fallida: ' . mysqli_error());
	
		?>

				<div class="centrar col-xs-9 col-md-6 col-lg-4">
          <form method="post" id="datos-sala">
            <input type="hidden" name="id_sala" value="<?php echo $result_sala['id_sala']; ?>">
            <input type="hidden" name="sala" value="<?php echo $result_sala['descripcion']; ?>">
            <input type="submit" class="btn btn-outline-info centrar" style="width: 100%; height: 100%;" id="ver_dispositivos" name="ver_dispositivos" value="<?php 
            while ($dis=mysqli_fetch_array($dispositivo)){ 
              echo $result_sala['descripcion']; echo " "; echo $temp_sala;?>°C">
            <input type="hidden" id="estado_dis" name="estado_dis" value="<?php echo $dis['Estado']; ?>">
          </form>
        </div>
    <?php
    	}
    	echo "<script>mostrar_estado_salas();</script>";
		?>

    <div id="popup" class="overlay">
      <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4" id="popupBody">
        <div class="row">

          <div class="col-xs-12">
            <span class="btn btn-danger topright" onclick="actualizar_disp();">&times;</span>
            <h2>Sala: <?php echo $desc_sala;?></h2>
          </div>

          <?php
            while ($fila_d=mysqli_fetch_array($dispositivos)){
          ?>

          <div id="pantalla-disp" class="caja-dispositivo centrar diflex col-xs-12">
            <div class="row">
              <div class="centrar col-xs-12">
                <a>N° de Serie del Dispositivo: <?php echo $fila_d['Nro_serie'];?></a>
              </div>                  
              <div class="centrar col-xs-12">
                <a>Temperatura del Dispositivo: </a>
                <a id="text_temp"></a>
                <a>°C</a>
              </div>
              <div class="centrar col-xs-12">
                <input type="range" id="temp" value="<?php echo $fila_d['T_aire']; ?>" min="0" max="28" 
                   autocomplete="off" step="1" onmousemove="input_temp()">
              </div>
            </div>
          </div>

          <form method="post" id="dispositivo">
      
            <input type="hidden" id="id" value="<?php echo $fila_d['Nro_serie']; ?>">
            <input type="hidden" id="in_mode" value="<?php echo $fila_d['Mode']; ?>">
            <input type="hidden" id="in_fan" value="<?php echo $fila_d['Fan']; ?>">

            <div class="diflex centrar col-xs-6">
              <div class="col-auto my-1">
                <label class="mr-sm-2">Modo Temperatura:</label>
                <select class="custom-select mr-sm-2" id="mode">
                  <option value="manual">Manual</option>
                  <option value="automatico">Automatico</option>
                </select>
              </div>
            </div>

            <div class="diflex centrar col-xs-6">
              <div class="col-auto my-1">
                <label class="mr-sm-2">Velocidad Ventilador:</label>
                <select class="custom-select mr-sm-2" id="fan">
                  <option value="alto">Alta</option>
                  <option value="medio">Media</option>
                  <option value="bajo">Baja</option>
                </select>
              </div>
            </div>

            <div id="botones" class="btn-group-toggle" data-toggle="buttons">
              <label id="boton-sleep" class="btn btn-outline-primary">
                <input type="checkbox" id="sleep" value="<?php echo $fila_d['Sleep']; ?>" autocomplete="off">Sleep
              </label>
              <label id="boton-turbo" class="btn btn-outline-primary">
                <input type="checkbox" id="turbo" value="<?php echo $fila_d['Turbo']; ?>" autocomplete="off">Turbo
              </label>
              <label id="boton-estado" class="btn btn-outline-danger">
                <input type="checkbox" id="estado" value="<?php echo $fila_d['Estado']; ?>" autocomplete="off">ON/OFF
              </label>  
            </div>      
      
          </form>
        </div>

        <?php 
          } 
          echo "<script>mostrar_estados_dis();</script>";
        ?>

        <!--FUNCION EVENTOS CLICKS EN BOTONES--------------------------------------------------------------------------------------------->
        <script>
          $(document).ready(function(){
            $("#boton-sleep").click(function(){
              if(document.getElementById("sleep").value == "0"){
                document.getElementById("sleep").value = "1";
              }
              else{
                document.getElementById("sleep").value = "0";
              }
            });

            $("#boton-turbo").click(function(){
              if(document.getElementById("turbo").value == "0"){
                document.getElementById("turbo").value = "1";
              }
              else{
                document.getElementById("turbo").value = "0";
              }
            });

            $("#boton-estado").click(function(){
              if(document.getElementById("estado").value == "0"){
                document.getElementById("estado").value = "1";
              }
              else{
                document.getElementById("estado").value = "0";
              }
            });
          });
        </script>

      </div>
    </div>

		
  	</section>
</body>
</html>
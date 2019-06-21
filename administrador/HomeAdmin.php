<?php
session_start();
require("../public/database.php");

if(empty($_SESSION['user_inside'])){
  echo "<script language='javascript'>window.location='/index.php'</script>";
}
else{
  $user=$_SESSION['user_inside'];
  $consulta_inicio= "SELECT * FROM Usuario WHERE Rut ='$user'";
  $resultado= mysqli_query($link,$consulta_inicio) or die('Consulta fallida: ' . mysqli_error());
  $usuario = mysqli_fetch_array($resultado);
}

?>

<!DOCTYPE html>
<html lang="es">

  <head>
		<link rel="shortcut icon" href="" type="image/png" />
		<title>AirControl</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">

	<!--ARCHIVOS CSS-------------------------------------------------------------------------------------------->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="HomeAdmin.css">
        <link rel="stylesheet" href="../public/flexboxgrid.min.css">

	<!--ARCHIVOS JS--------------------------------------------------------------------------------------------->
        <script type="text/javascript" src="HomeAdmin.js"></script>
        <script src="../public/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </head>

<body>
  <!--HEADER--------------------------------------------------------------------------------------------->
    <header class="row">
      <div class="centrar-v col-xs-7">
        <img src="../img/usuario.png" text-align="center" width="75px"  alt="No se pudo cargar la imagen">
        <?php echo $usuario['Nombre']." ".$usuario['A_paterno']." ".$usuario['A_materno']; ?>   
      </div>

      <div class="col-xs-5" width="75px" style="text-align:right;">
        <a href="../public/cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a> 
      </div>
    </header>

  <!--SECTION--------------------------------------------------------------------------------------------->  
<section class="centrar row">

  <div class="col-xs-11">
  <h1>Panel de control del aire acondicionado de DUOC UC</h1> 
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


/*--EDIFICIOS--------------------------------------------------------------------------------------------->*/
$consultaE= "SELECT * FROM Edificio";
$edificios= mysqli_query($link,$consultaE) or die('Consulta fallida: ' . mysqli_error());
while ($fila_e=mysqli_fetch_array($edificios)){
?>


  <article class="centrar edificio col-xs-11">
   <h2>Torre <?php echo $fila_e['descripcion']; ?></h2>
   <form id="datos-edificio<?php echo $fila_e['id_edif']; ?>" method="POST">
      <input type="hidden" id="id_edificio" name="id_edificio" value="<?php echo $fila_e['id_edif']; ?>">    
      <input type="hidden" id="edificio" name="edificio" value="<?php echo $fila_e['descripcion']; ?>">

      <input type="button" id="boton_control_e" class="btn btn-outline-primary" 
             value="Control Total" onclick="control_total_e(this.form);">

    </form>
   <div class="row">

<!--PISOS--------------------------------------------------------------------------------------------->
<?php
$idedificio= $fila_e['id_edif'];
$consulta= "SELECT * FROM Piso WHERE id_edificio ='$idedificio'";
$pisos= mysqli_query($link,$consulta) or die('Consulta fallida: ' . mysqli_error());
while ($fila=mysqli_fetch_array($pisos)){
?>

  <div class="piso centrar col-xs-12 col-md-6 col-lg-4">
    <div class="row">
      <div class="centrar col-xs-12">
        <h3>Piso N°<?php echo $fila['descripcion']; ?></h3>
        <form id="datos-piso<?php echo $fila['id_piso']; ?>" method="POST">
          <input type="hidden" id="id_piso" name="id_piso" value="<?php echo $fila['id_piso']; ?>">
          <input type="hidden" id="p_edificio" name="p_edificio" value="<?php echo $fila_e['descripcion']; ?>">    
          <input type="hidden" id="piso" name="piso" value="<?php echo $fila['descripcion']; ?>">
          <input type="button" id="boton_control_p" class="btn btn-outline-primary" 
                value="Control Total" onclick="control_total_p(this.form);">
       </form>
      </div>

<!--SALAS--------------------------------------------------------------------------------------------->
<?php
$idpiso= $fila['id_piso'];
$consulta_salas= "SELECT * FROM Sala WHERE id_piso ='$idpiso'";
$salas= mysqli_query($link,$consulta_salas) or die('Consulta fallida: ' . mysqli_error());

while ($fila_s=mysqli_fetch_array($salas)){
  $temp_sala=temp_sala("temp",$temp_c);
  $id_sala= $fila_s['id_sala'];
  $consulta_dispositivo= "SELECT * FROM Dispositivo WHERE id_sala ='$id_sala'";
  $dispositivo= mysqli_query($link,$consulta_dispositivo) or die('Consulta fallida: ' . mysqli_error());
  
?>

  <div class="sala centrar col-xs-3">
    <form id="datos-sala<?php echo $fila_s['id_sala']; ?>" method="POST">

      <input type="hidden" id="id_sala" name="id_sala" value="<?php echo $fila_s['id_sala']; ?>">
      <input type="hidden" id="sala" name="sala" value="<?php echo $fila_s['descripcion']; ?>">
      <input type="hidden" id="temp_sala" name="temp_sala" value="<?php echo $temp_sala ?>">
      <input type="hidden" id="e_dis" name="e_dis" value="<?php echo $fila_e['descripcion']; ?>">
      <input type="hidden" id="p_dis" name="p_dis" value="<?php echo $fila['descripcion']; ?>">

      <input type="button" id="boton_mostrar_disp<?php echo $fila_s['id_sala']; ?>" class="btn btn-outline-info"
      value="<?php echo $fila_s['descripcion']; echo "&nbsp;"; echo $temp_sala;?>°C" onclick="mostrar_disp(this.form);">
      
      <?php while ($dis=mysqli_fetch_array($dispositivo)){?>
      <input type="hidden" id="estado_dis<?php echo $fila_s['id_sala']; ?>" name="estado_dis" value="<?php echo $dis['Estado']; ?>">
      <?php } ?>

    </form>
  </div>
  
<?php 
$id_s=$fila_s['id_sala'];
$estado_dis="estado_dis$id_s";
$boton_sala="#boton_mostrar_disp$id_s";
echo "<script>mostrar_estado_salas('".$estado_dis."','".$boton_sala."');</script>";
} 

?>

    </div>
  </div>
<?php } ?>
    </div>
  </article>
<?php } ?>

<!--POPUP DISPOSITIVO--------------------------------------------------------------------------------------------->
  <div id="popup" class="overlay">       </div>

    </section>
	
	  <footer>
       Equipo Dinamufin
	  </footer>
 </body>	

 <script>

</script>

</html>
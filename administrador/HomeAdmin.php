<?php
session_start();
require("../public/database.php");

if(isset($_POST['ver_dispositivos'])){
  $idsala=$_POST['id_sala'];
  $desc_sala=$_POST['sala'];
  $consulta_dispositivos= "SELECT * FROM Dispositivo WHERE id_sala ='$idsala'";
  $dispositivos= mysqli_query($link,$consulta_dispositivos) or die('Consulta fallida: ' . mysqli_error());
  echo "<script language='javascript'>window.location='#popup'</script>";
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
  </head>
  
  <body>
    <header class="row">
      <div class="centrar-v col-xs-7">
        <img src="../img/usuario.png" text-align="center" width="75px"  alt="No se pudo cargar la imagen">
        <?php echo $_SESSION['user_inside']; ?>   
      </div>

      <div class="col-xs-5" width="75px" style="text-align:right;">
        <a href="../public/cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a> 
      </div>
    </header>

    
<section class="centrar row">

  <div class="centrar col-xs-11">
  <h1> Dispositivos de Aire Acondicionado </h1> 
  </div>

<?php
$consultaE= "SELECT * FROM Edificio";
$edificios= mysqli_query($link,$consultaE) or die('Consulta fallida: ' . mysqli_error());
while ($fila_e=mysqli_fetch_array($edificios)){
?>

  <article class="centrar col-xs-11">
   <h2> <?php echo "Torre "; echo $fila_e['descripcion']; ?> </h2>
   <div class="row">

<?php
$idedificio= $fila_e['id_edif'];
$consulta= "SELECT * FROM Piso WHERE id_edificio ='$idedificio'";
$pisos= mysqli_query($link,$consulta) or die('Consulta fallida: ' . mysqli_error());
while ($fila=mysqli_fetch_array($pisos)){
?>

  <div class="piso centrar col-xs-12 col-md-6 col-lg-4">
    <div class="row">
      <div class="centrar col-xs-12">
        <h3>Piso N°<?php echo $fila['descripcion']; ?> </h3>
      </div>

<?php
$idpiso= $fila['id_piso'];
$consulta_salas= "SELECT * FROM Sala WHERE id_piso ='$idpiso'";
$salas= mysqli_query($link,$consulta_salas) or die('Consulta fallida: ' . mysqli_error());
while ($fila_s=mysqli_fetch_array($salas)){
?>

  <div class="sala centrar col-xs-3">
    <form method="post" id="datos-sala">
      <input type="hidden" name="id_sala" value="<?php echo $fila_s['id_sala']; ?>">
      <input type="hidden" name="sala" value="<?php echo $fila_s['descripcion']; ?>">
      <input type="submit" class="btn btn-primary" name="ver_dispositivos" value="<?php echo $fila_s['descripcion']; ?>"> 
    </form>
  </div>

<?php } ?>
    </div>
  </div>
<?php } ?>
    </div>
  </article>
<?php } ?>

  <div id="popup" class="overlay">
    <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4" id="popupBody">
      <h2>Sala: <?php echo $desc_sala;?></h2>
      <a id="cerrar" href="#">&times;</a>
      <div class="row">

<?php
while ($fila_d=mysqli_fetch_array($dispositivos)){
?>
    
    <div class="centrar diflex row">
      <div class="caja-dispositivo centrar diflex col-xs-12">
          <h5 text-align="center">N° de Serie del Dispositivo: <?php echo $fila_d['Nro_serie'];?></h5>
      </div>
      <form method="post" id="dispositivo">
        <div class="diflex centrar col-xs-6">
          <input type="submit" class="btn btn-primary" name="boton-mode" value="Mode"> 
        </div>
        <div class="diflex centrar col-xs-6">
          <input type="submit" class="btn btn-primary" name="boton-fan" value="Fan"> 
        </div>
        <div class="diflex centrar col-xs-6">
          <input type="submit" class="btn btn-primary" name="boton-sleep" value="Sleep"> 
        </div>
        <div class="diflex centrar col-xs-6">
          <input type="submit" class="btn btn-primary" name="boton-turbo" value="Turbo"> 
        </div>
        <div class="diflex centrar col-xs-12">
          <input type="submit" class="btn btn-danger" name="boton-estado" value="ON/OFF"> 
        </div>         
      </form>
    </div>

<?php } ?>

      </div>
    </div>
  </div>

    </section>
	
	  <footer>

	  </footer>
 </body>	

</html>
<?php
session_start();
require("database.php");

if(isset($_POST['ver_dispositivo'])){
  $idsala=$_POST['id_sala'];
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
        <link rel="stylesheet" href="flexboxgrid.min.css">

	<!--ARCHIVOS JS--------------------------------------------------------------------------------------------->
        <script type="text/javascript" src="HomeAdmin.js"></script>
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  </head>

  <body>
    <header class="row">
      <div class="col-xs-10">
        <img src="usuario.png" text-align="center" width="75px"  alt="No se pudo cargar la imagen">
        <?php echo $_SESSION['user_inside']; ?>   
      </div>
      <div class="center col-xs-2">
        <a href="cerrar_sesion.php" class="btn btn-light">Cerrar Sesion</a> 
      </div>
    </header>

    
<section class="row">

  <div style="padding-left: 5%;">
  <h1> Dispositivos de Aire Acondicionado </h1> 
  </div>

<!--Mostrar edificios del recinto--------------------------------------------------------------------->

<?php
$consultaE= "SELECT * FROM Edificio";
$edificios= mysqli_query($link,$consultaE) or die('Consulta fallida: ' . mysqli_error());
while ($fila_e=mysqli_fetch_array($edificios)){
?>

  <article class="centrar col-xs-12">
  <h2> <?php echo "Torre "; echo $fila_e['descripcion']; ?> </h2>

<!--Mostrar pisos de cada edificio--------------------------------------------------------------------->

<?php
$idedificio= $fila_e['id_edif'];
$consulta= "SELECT * FROM Piso WHERE id_edificio ='$idedificio'";
$pisos= mysqli_query($link,$consulta) or die('Consulta fallida: ' . mysqli_error());
while ($fila=mysqli_fetch_array($pisos)){
?>

  <div class="piso centrar col-xs-12 col-sm-6 col-lg-4">
  <div class="row">
    <div class="centrar col-xs-12">
      <h3> <?php echo $fila['descripcion']; ?> </h3>
    </div>

<!--Mostrar salas de cada piso--------------------------------------------------------------------->

<?php
$idpiso= $fila['id_piso'];
$consulta_salas= "SELECT * FROM Sala WHERE id_piso ='$idpiso'";
$salas= mysqli_query($link,$consulta_salas) or die('Consulta fallida: ' . mysqli_error());
while ($fila_s=mysqli_fetch_array($salas)){
?>

  <div class="sala col-xs-3">
    <form method="post" action="HomeAdmin.php">
      <input type="hidden" name="id_sala" value="<?php echo $fila_s['descripcion']; ?>">
      <input type="submit" class="btn btn-primary" name="ver_dispositivo" value="<?php echo $fila_s['descripcion']; ?>"> 
    </form> 
  </div>

<?php } ?>
</div>
</div>
<?php } ?>
</article>
<?php } ?>

  <div id="popup" class="overlay">
    <div id="popupBody">
        <h2><?php echo $idsala;?></h2>
        <a id="cerrar" href="#">&times;</a>
        <div class="popupContent">
        
        </div>
    </div>
  </div>

    </section>
	
	  <footer>

	  </footer>
 </body>	

</html>
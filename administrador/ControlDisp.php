<?php 
require("../public/database.php");

  $id_sala=$_REQUEST["id_sala"];
  $sala=$_REQUEST["sala"];
  $temp_sala=$_REQUEST["temp_sala"];
  $e_dis=$_REQUEST["e_dis"];
  $p_dis=$_REQUEST["p_dis"];

  $estado_dis="estado_dis$id_sala";
  $boton_sala="#boton_mostrar_disp$id_sala";

  $consulta_dispositivos= "SELECT * FROM Dispositivo WHERE id_sala ='$id_sala'";
  $dispositivos= mysqli_query($link,$consulta_dispositivos) or die('Consulta fallida: ' . mysqli_error());
  
  while ($fila_d=mysqli_fetch_array($dispositivos)){

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

  <div class="col-xs-10" id="popupBody">
    <div class="row">
    <button type="button" class="close topright" data-dismiss="modal" aria-label="Close" 
                onclick="actualizar_disp('<?php echo $estado_dis;?>','<?php echo $boton_sala;?>');">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="col-xs-12">
        <p><h6>Torre <?php echo $e_dis; ?>/ Piso N°<?php echo $p_dis; ?></h6></p>
        <h2>Sala: <?php echo $sala; ?></h2>
      </div>

      <div id="pantalla-disp" class="caja-dispositivo centrar diflex col-xs-12">
        <div class="row">
          <div class="centrar col-xs-12">
            <a>N° de Serie del Dispositivo: <?php echo $fila_d['Nro_serie'];?></a>
          </div>
          <div class="centrar col-xs-12">
            <a>Temperatura ambiental de la Sala: <?php echo $temp_sala; ?>°C</a>
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

      <form method="POST" id="dispositivo">
      
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
  </div>

<?php 
} 
?>



  </body>
  </html>


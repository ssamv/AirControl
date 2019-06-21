<?php 
require("../public/database.php");

  $id_piso=$_REQUEST["id_piso"];
  $piso=$_REQUEST["piso"];
  $edificio=$_REQUEST["edificio"];

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

  <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4" id="popupBody">
    <div class="row centrar">

      <div class="col-xs-12">
        <span class="btn btn-danger topright" onclick="salir_popup_y_act();">&times;</span>
        <p><h6>Torre <?php echo $edificio; ?></h6></p>
        <p><h3>Piso <?php echo $piso; ?></h3></p>
      </div>    

      <form id="T_aire">
        <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
        <div class="centrar col-xs-12">
            <a>Temperatura del Dispositivo: </a>
            <a id="text_temp"></a>
            <a>°C</a>
        </div>
        <div class="centrar col-xs-12">
          <input type="range" id="temp" value="20" min="0" max="28" 
                 autocomplete="off" step="1" onmousemove="input_temp()">
        </div>
        <div class="centrar col-xs-12">
            <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
        </div>
      </form>
      
      <form id="Mode">
      <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
        <div class="diflex centrar col-xs-12 elemento_pop">
          <div class="col-auto my-1">
            <label class="mr-sm-2">Modo Temperatura:</label>
            <select class="custom-select mr-sm-2" id="valor">
              <option selected value="manual">Manual</option>
              <option value="automatico">Automatico</option>
            </select>
          </div>
        </div>
        <div class="centrar col-xs-12">
        <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
        </div>
      </form>

      <form id="Fan">
      <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
        <div class="diflex centrar col-xs-12 elemento_pop">
          <div class="col-auto my-1">
            <label class="mr-sm-2">Velocidad Ventilador:</label>
            <select class="custom-select mr-sm-2" id="valor">
              <option value="alto">Alta</option>
              <option selected value="medio">Media</option>
              <option value="bajo">Baja</option>
            </select>
          </div>
        </div>
        <div class="centrar col-xs-12">
        <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
        </div>
      </form>
      
      <div class="centrar col-xs-4 elemento_pop">
      <form id="Sleep"> 
      <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
          <input type="button" id="boton-sleep" class="btn btn-outline-primary" data-toggle="buttons" 
                 onclick="cambiar_valor(this.form);" value="Sleep">
          <input type="hidden" id="valor" value="0">
          <div class="centrar col-xs-12">
          <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
        </div>
      </form>
      </div>
      
      <div class="centrar col-xs-4 elemento_pop">
      <form id="Turbo">
      <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
          <input type="button" id="boton-turbo" class="btn btn-outline-primary" data-toggle="buttons" 
                 onclick="cambiar_valor(this.form);" value="Turbo">
          <input type="hidden" id="valor" value="0">
          <div class="centrar col-xs-12">
          <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
          </div>
      </form>
      </div>
      
      <div class="centrar col-xs-4 elemento_pop">
      <form id="Estado">
      <input type="hidden" id="id_piso" value="<?php echo $id_piso;?>">
          <input type="button" id="boton-estado" class="btn btn-outline-danger " data-toggle="buttons" 
                 onclick="cambiar_valor(this.form);" value="ON/OFF">
            <input type="hidden" id="valor" value="0">
          <div class="centrar col-xs-12">
          <input type="button" class="btn btn-success" onclick="actualizar_disp_p(this.form);" value="Aplicar">
          </div> 
      </form>
      </div>

    </div>
  </div>

<?php 
?>



  </body>
  </html>
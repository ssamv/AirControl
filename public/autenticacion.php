<?php
session_start();
require("database.php");
$user= $_POST['usuario'];
$pswd= $_POST['password'];
$consulta_inicio= "SELECT * FROM Usuario WHERE Rut ='$user' AND Contraseña = '$pswd'";
$resultado= mysqli_query($link,$consulta_inicio) or die('Consulta fallida: ' . mysqli_error());
$existe= mysqli_num_rows($resultado);

  if($existe == 1){
    $usuario = mysqli_fetch_array($resultado);
    $_SESSION['user_inside'] = $user;
    $tipo_user=$usuario['Tipo_usuario'];
    if($tipo_user=="administrador"){
      echo "<script language='javascript'>window.location='/administrador/HomeAdmin.php'</script>";
    } 
    else{
      echo "<script language='javascript'>window.location='/administrador/ControlDisp.php'</script>";
    }

  }
  else {
    echo "<script language='javascript'>alert('Usuario y/o Contraseña erroneos, intente nuevamente');</script>";   
    echo "<script language='javascript'>window.location='/index.php'</script>";
  }
?>
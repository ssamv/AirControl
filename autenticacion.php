<?php
session_start();
require("database.php");
$user= $_POST['usuario'];
$pswd= $_POST['password'];
$consulta_inicio= "SELECT * FROM Admin WHERE nom_usuario ='$user' AND contraseña = '$pswd'";
$resultado= mysqli_query($link,$consulta_inicio) or die('Consulta fallida: ' . mysqli_error());
$existe= mysqli_num_rows($resultado);
  if($existe == 1){
    $_SESSION['user_inside'] = $user;
    echo "<script language='javascript'>window.location='HomeAdmin.php'</script>";
   }
  else {
    echo "<script language='javascript'>alert('Usuario y/o Contraseña erroneos, intente nuevamente');</script>";   
    echo "<script language='javascript'>window.location='index.php'</script>";
  }
?>

<?php
session_start();
require("database.php");
$user= $_POST['usuario'];
$pswd= $_POST['password'];
$consulta_inicio= "SELECT * FROM Admin WHERE nom_usuario ='$user' AND contraseña = '$pswd'";
$resultado= mysqli_query($link,$consulta_inicio) or die('Consulta fallida: ' . mysqli_error());
$existe= mysqli_num_rows($resultado);
  if($existe == 1){
    $_SESSION['user_inside'] = $user;
    echo "<script language='javascript'>window.location='HomeAdmin.php'</script>";
   }
  else {
    echo "<script language='javascript'>alert('Usuario y/o Contraseña erroneos, intente nuevamente');</script>";   
    echo "<script language='javascript'>window.location='index.php'</script>";
  }
?>

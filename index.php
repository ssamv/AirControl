<?php
session_start();
if(isset($_SESSION['user_inside'])){
  echo "<script language='javascript'>window.location='/administrador/HomeAdmin.php'</script>";
}
else{
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
  </head>

  <body>
      <header>
      </header>
    <h1>Air Control</h1>
    <h2>Login</h2>
      <form action="/public/autenticacion.php" method="post">
        <input type="number" name="usuario" id="usaurio" placeholder= "Ingrese su Rut sin puntos ni guión (12345678)" min="1000000" max="99999999">
        <input type="password" name="password" id="password" placeholder="Ingrese su Contraseña">
        <input type="submit" value="Ingresar">
      </form>

  </body>
</html>

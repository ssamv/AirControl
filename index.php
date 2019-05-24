<?php
session_start();
if(isset($_SESSION['user_inside'])){
  echo "<script language='javascript'>window.location='HomeAdmin.php'</script>";
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
    <link rel="stylesheet" href="style.css"><!--Agregue esto-->
  </head>

  <body>
      <header>
      </header>
    <h1>Air Control</h1> <!--Agregue esto-->
    <h2>Login</h2>
      <form action="autenticacion.php" method="post">
        <input type="text" name="usuario" id="usaurio" placeholder= "Enter your user">
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="submit" value="Send">
      </form>

  </body>
</html>

<?php
session_start();
unset($_SESSION['user_inside']);
echo "<script language='javascript'>window.location='index.php'</script>";
?>
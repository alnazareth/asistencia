<?php 
//para validar cerrar sesion 
session_name("validar");
session_start();
session_unset();
session_destroy();
Header('Location:../vista/inicio.php');
?>

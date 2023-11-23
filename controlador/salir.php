<?php
//crea el objeto conxion
	include("../modelo/conexion.php");
	$obj_con= new conectar();
	$con = $obj_con->con();
//Crear objeto usuario*/
	include("../modelo/sesion.php");
	$obj_us= new usuario();
	$validar=$obj_us->salir();
?>
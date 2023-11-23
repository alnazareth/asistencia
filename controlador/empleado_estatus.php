<?php
//atarapa la s variables que viene del formulario 
	$cedula=$_POST['cedula'];
	$estatu=$_POST['estatu'];
	include("../modelo/empleado.php");
	$obj=new empleado();//crea el obejeto empleado 
	$res=$obj->estatus($cedula,$estatu);//hace referencia al metodo estatus 
	if($res==1)//si es igual a 1 entonces:
	{
		echo"<script>alert('Estatus Cambiado');window.location='../vista/empleado_consultar.php';</script>";
	}
	else if($res==2)//si es igual a 2 entonces:
	{
		echo"<script>alert('Error al Cambiar el Estatus');window.location='../vista/empleado_consultar.php';</script>";
	}
?>
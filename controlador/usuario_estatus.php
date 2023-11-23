<?php
//atrapa las variables 
	$id=$_POST['id'];
	$estatu=$_POST['estatu'];
//crea el objeto usuario
	include("../modelo/usuario.php");
	$obj=new usuario();
	$res=$obj->estatus($id,$estatu);//hace referencia al metodo estatus 
	if($res==1)// si es igual a 1 entonces:
	{
		echo"<script>alert('Estatus Cambiado');window.location='../vista/usuario_consultar.php';</script>";
	}
	else if($res==2)//si es igual a 2 entonces:
	{
		echo"<script>alert('Error al Cambiar el Estatus');window.location='../vista/usuario_consultar.php';</script>";
	}
?>
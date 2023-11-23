<?php
//atrapa las variables que vienen de la vista permiso_registrar
	$cedula=$_POST['cedula'];
	$ini=$_POST['ini'];
	$fin=$_POST['fin'];
	include("../modelo/permiso.php");//crea el objeto permiso
	$obj=new permiso();
	$res=$obj->registrar($cedula,$ini,$fin);
	if($res==1)//si es igual a 1 imprime 
	{
		echo"<script>alert('Registro Exitoso');window.location='../vista/principal.php';</script>";
	}
	elseif($res==2){//si es igual a 2 imprime 
		echo"<script>alert('Error al registrar');window.location='../vista/permiso_registrar.php';</script>";
	}
	elseif($res==3){//si es igual a 3 imprime 
		echo"<script>alert('Cedla del personal no existe/ Verifique...');window.location='../vista/permiso_registrar.php';</script>";
	}
?>
<?php
//atrapa las variables  que vienen de la vista empleado_registrar
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$cedula=$_POST['cedula'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$dire=$_POST['dire'];
	$cargo=$_POST['cargo'];
	$estado=$_POST['estado'];
	$sexo=$_POST['sexo'];

	include("../modelo/empleado.php");
	$obj=new empleado();//crea el objeto empleado
	$res=$obj->registrar($nombre,$apellido,$cedula,$correo,$telefono,$cargo,$dire,$estado,$sexo);//hace referencia al metodo registrar
	if($res==1)// si es igual a 1 entonces:
	{
		echo"<script>alert('Registro Exitoso');window.location='../vista/principal.php';</script>";
	}
	else if($res==2)// si es igual a 2 entonces:
	{
		echo"<script>alert('Error al registrar');window.location='../vista/empleado_registrar.php';</script>";
	}
	else if($res==3)// si es igual a 3 entonces:
	{
		echo"<script>alert('Cedula del empleado ya registrada, Verifique');window.location='../vista/empleado_registrar.php';</script>";
	}
?>

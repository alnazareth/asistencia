<?php
//atrapa las variables que vienen de la vista usuario_registrar 
	$cedula=$_POST['cedula'];
	$usu=$_POST['usu'];
	$pass=$_POST['pass'];
	$nivel=$_POST['nivel'];
	$pregunta=$_POST['pregunta'];
	$respuesta=$_POST['respuesta'];
//crea el objeto usuario
	include("../modelo/usuario.php");
	$obj=new usuario();
	$res=$obj->registrar($cedula,$usu,$pass,$nivel,$pregunta,$respuesta);//hace referencia al metodo registrar 
	if($res==1)// si es igual a 1 entonces 
	{
		echo"<script>alert('Registro Exitoso');window.location='../vista/principal.php';</script>";
	}
	else if($res==2)//si es igual a 2 entonces
	{
		echo"<script>alert('Error al registrar');window.location='../vista/usuario_registrar.php';</script>";
	}
	else if($res==3)//si es igual a 3 entonces:
	{
		echo"<script>alert('Usuario ya registrado, Verifique');window.location='../vista/usuario_registrar.php';</script>";
	}
	else if($res==4)//si es igual a 4 entonces:
	{
		echo"<script>alert('Esta persona ya tiene un usuario registrado.');window.location='../vista/usuario_registrar.php';</script>";
	}
	else if($res==5)//si es igual a 5 entonces:
	{
		echo"<script>alert('Empleado no registrado. Verifique...');window.location='../vista/usuario_registrar.php';</script>";
	}
?>

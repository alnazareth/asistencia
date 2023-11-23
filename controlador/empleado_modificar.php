<?php
	if(isset($_POST['boton']))//si cumple la condicion entonces:
	{
			//atarapa las variables  que viene de la vista empleado modificar 
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$cedula=$_POST['cedula'];
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];
		$dire=$_POST['dire'];
		$cargo=$_POST['cargo'];
		$estado=$_POST['estado'];
		$sexo=$_POST['sexo'];
		$oculto=$_POST['oculto'];
		include("../modelo/empleado.php");
		$obj=new empleado();//crea el objeto empleado 
		$res=$obj->modificar($nombre,$apellido,$cedula,$correo,$telefono,$cargo,$dire,$estado,$sexo,$oculto);//hace referencia al metodo modificar 
		if($res==1)// si es igual a 1 entonces:
		{
			echo"<script>alert('Modificacion Exitosa');window.location='../vista/empleado_consultar.php';</script>";
		}
		else if($res==2)// si es igual a 2 entonces:
		{
			echo"<script>alert('Error al modificar');window.location='../vista/empleado_consultar.php';</script>";
		}
		else if($res==3)// si es igual a 3 entonces:
		{
			echo"<script>alert('Cedula del empleado ya registrada, Verifique');window.location='../vista/empleado_consultar.php';</script>";
		}
	}
	else//si no entonces:
	{
		$cedula=$_POST['cedula'];//atarpa el valor 
		include("../modelo/empleado.php");
		$obj=new empleado();//crea el objeto empleado
		$res=$obj->ver($cedula);//hace referencia al metodo ver	
	}
	
?>
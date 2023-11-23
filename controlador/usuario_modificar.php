<?php
//si se cumple la condicion entonces: 
	if(isset($_POST['boton']))
	{
		$pass=$_POST['pass'];
		$nivel=$_POST['nivel'];
		$id=$_POST['id'];
//crea el objeto usuario
		include("../modelo/usuario.php");
		$obj=new usuario();
		$res=$obj->modificar($pass,$nivel,$id);//hace referencia al metodo modificar
		if($res==1)//si es igual a 1 entonces:
		{
			echo"<script>alert('Modificacion Exitosa');window.location='../vista/usuario_consultar.php';</script>";
		}
		else if($res==2)//si es igual a 2 entonces:
		{
			echo"<script>alert('Error al modificar');window.location='../vista/usuario_consultar.php';</script>";
		}
	}
	else//si no entonces:
	{
		$id=$_POST['id'];
			//crea el objeto usuario
		include("../modelo/usuario.php");
		$obj=new usuario();
		$res=$obj->ver($id);	// hace referencia al metodo ver 
	}
	
?>
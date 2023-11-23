<?php
//crea el objeto horario
	include("../modelo/horario.php");
	$obj=new horario();
	if(isset($_POST['boton']))//si cumple la condicion entonces:
	{
		$entra_ma=$_POST['entra_ma'];
		$sali_ma=$_POST['sali_ma'];
		$entra_ta=$_POST['entra_ta'];
		$sali_ta=$_POST['sali_ta'];
		$res=$obj->modificar($entra_ma,$sali_ma,$entra_ta,$sali_ta);//hace referencia al metodo modificar
		if($res==1)//si es igual a 1 imprime
		{
			echo"<script>alert('Modificacion Exitosa');window.location='../vista/horario_consultar.php';</script>";
		}
		else if($res==2)//si es igual a 2 imprime 
		{
			echo"<script>alert('Error al Modifocar');window.location='../vista/horario_consultar.php';</script>";
		}
	}
	else//si no hace referencia al metodo mostrar
	{
		$res=$obj->mostrar();
	}
?>
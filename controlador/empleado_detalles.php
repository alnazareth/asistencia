<?php
	$cedula=$_POST['cedula'];//atrapa la variable 
	include("../modelo/empleado.php");
	$obj=new empleado();//crea el objeto empleado 
	$res=$obj->ver($cedula);//hace referencia al metodo ver 
?>
<?php
	$cedula=$_POST['cedula'];
	include("../modelo/empleado.php");
	$obj=new empleado();//crea el objeto empleado 
	$res=$obj->ver($cedula);//hace referencia al metodo ver 
	if($res==3)//si es igual a 3 entonces:
		echo"";
	else
	{
		$dato=pg_fetch_array($res);//cuenta el numero de filas que arrojo la ejecucion y lo pocisiona segun el arreglo
		echo "".$dato[2]." ".$dato[3]."";
	}
?>
<?php
//crea el objeto empleado 
	include("../modelo/empleado.php");
	$obj=new empleado();
	$res=$obj->mostrar();//hace referencia al  metodo mostrar 
?>
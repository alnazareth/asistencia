<?php
//crea el objeto horario
	include("../modelo/horario.php");
	$obj=new horario();
	$res=$obj->mostrar();//hace referencia al metodo mostrar 
?>
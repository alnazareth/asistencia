<?php
//crea el objeto permiso
	include("../modelo/permiso.php");
	$obj=new permiso();
	$res=$obj->mostrar();//hace referencia al metodo mostrar
?>
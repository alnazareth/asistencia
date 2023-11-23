<?php
//crea el objeto usuario
	include("../modelo/usuario.php");
	$obj=new usuario();
	$res=$obj->mostrar();//hace referencia al metodo mostrar
?>
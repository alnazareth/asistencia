<?php
	include("../modelo/asistencia.php");//incluye la clase asistencia
	include("../modelo/empleado.php");//incluye la clase empleado
	include("../modelo/permiso.php");//incluye la clase permiso

	$obj=new empleado();//crea el objeto empleado 
	$res=$obj->activos();//hace referencia al metodo activos 

	$per=new permiso();//crea el objeto permiso

	$obje=new asistencia();//crea el objeto asistencia
?>
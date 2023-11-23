<?php
//Clase Conectar: para conectar con la base de datos..
class Conectar
{
	function con(){
	$conexion=pg_connect("host='localhost' user='postgres' password='1234' dbname='asistencia'");
	if(!$conexion)//si nonecta presentara la siguiente alerta
		echo "<script type='text/javascript'> alert(' Error de Conexión.. Contacte a su Gestor de Base de datos. ')</script>";
		return $conexion;
	}	
}
?>

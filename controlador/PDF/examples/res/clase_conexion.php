<?php
//Clase Conectar: para conectar con la base de datos..
@session_start();
class conectar
{
	function con(){
	$conexion=pg_connect("host='localhost' user='postgres' password='mionotuyo' dbname='unea'");
	if(!$conexion)
		echo "<script type='text/javascript'> alert(' Error de Conexión.. Contacte a su Gestor de Base de datos. ')</script>";
		return $conexion;
	}
}
?>

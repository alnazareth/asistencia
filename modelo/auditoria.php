<?php
	class auditoria
	{
		static function registrar($accion)
		{
			@session_start();
			date_default_timezone_set('America/Caracas');
			//Se guarda los datos de la persona que va a salir , la hora y fecha.
			$id=$_SESSION['id'];
			$fecha=date("d/m/Y");
			$hora=@date('H', time());
			$minutos=@date('i', time());
			$meri='AM';
			if($hora>12)
			{
				$meri='PM';
				$hora=$hora-12;
			}
			$htotal=$hora.":".$minutos." ".$meri;
			$sql="INSERT INTO auditoria VALUES (default,'$fecha','$htotal','$accion','$id')";
			$ejecutar=pg_query($sql);
		}
	}
?>
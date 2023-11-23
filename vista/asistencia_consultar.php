<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Consultar Asistencia</title>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
	</head>
	<body>
		<div id='general'>
			<?php
				session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="asistencia";
					include("banner.php");
					include("menu.php");
					include("../controlador/asistencia_consultar.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='tablas' align='center'>
						<h2>Registro de Asistencia</h2>
						<table border='1' align='center'>
							<tr>
								<th colspan='3'>Personal</th><th colspan='2'>Mañana</th><th colspan='2'>Tarde</th>
							</tr>
							<tr>
								<th>Nombre</th><th>Apellido</th><th>Cedula</th><th>Entrada</th><th>Salida</th><th>Entrada</th><th>Salida</th>
							</tr>";
							$con=pg_num_rows($res);
							if($con>0)
								while($dato=pg_fetch_array($res))
								{
									$permiso=$per->buscar($dato[1]);
									$per_con=pg_num_rows($permiso);
									if($per_con<1)
									{
										$respuesta=$obje->asis($dato[0]);
										$dato_asis=pg_fetch_array($respuesta);
									}

									echo"<tr><td>".$dato[2]."</td><td>".$dato[3]."</td><td>".$dato[1]."</td>";
									if($per_con<1)
									{
										echo"<td>";
											if($dato_asis[2]=="" OR $dato_asis[2]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[2]; if($dato_asis[2]>="12:00"){echo" PM";}else{echo" AM";}}
										echo"</td><td>";
											if($dato_asis[3]=="" OR $dato_asis[3]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[3]; if($dato_asis[3]>="12:00"){echo" PM";}else{echo" AM";} }
										echo"</td><td>";
										if($dato_asis[4]=="" OR $dato_asis[4]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[4]." PM";}
										echo"</td><td>";
											if($dato_asis[5]=="" OR $dato_asis[5]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[5]." PM";}
										echo"</td>";
									}
									else
									{
										echo"<td colspan='4' align='center'> De Permiso</td>";
									}
								}
							else
								echo"<td colspan='7' align='center'> Nada Registrado</td>";
						echo"</table>
					</div>
					";
				}
				else
				{
					header("location:../");
				}
			?>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Consultar Horario</title>
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
					$posi="horario";
					include("banner.php");
					include("menu.php");
					include("../controlador/horario_consultar.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='tablas' align='center'>
						<h2>Horario de Trabajo</h2>
						<table border='1' align='center'>
							<tr>
								<th colspan='2'>Mañana</th><th colspan='2'>Tarde</th><th rowspan='2'>Opción</th>
							</tr>
							<tr>
								<th>Entrada</th><th>Salida</th><th>Entrada</th><th>Salida</th>
							</tr>";
							$con=pg_num_rows($res);
							if($con>0)
							{
								$dato=pg_fetch_array($res);

								echo"<tr><td>".$dato[1]." AM</td><td>".$dato[2]." AM</td><td>".$dato[3]." PM</td><td>".$dato[4]." PM</td>
								<td align='center'><form method='post' action='horario_modificar.php'><input type=image src='img/iconos/settings-gears.png' width='24' height='22' value='Mod' title='Modificar'><input type='hidden' name='id' value='".$dato[0]."'></form></td>
								</tr>";
							}
							else
							{
								echo"<td colspan='4' align='center'> Nada Registrado</td>";
							}

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
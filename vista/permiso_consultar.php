<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Consultar Permisos</TITLE>
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
					$posi="permiso";
					include("banner.php");
					include("menu.php");
					include("../controlador/permiso_consultar.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='tablas' align='center'>
						<h2>Personal de Permiso</h2>
						<table border='1' align='center'>
							<tr>
								<th>Nombre</th><th>Apellido</th><th>Cédula</th><th>Inicio</th><th>Final</th>
							</tr>";
							$con=pg_num_rows($res);
							if($con>0)
								while($dato=pg_fetch_array($res))
								{
									echo"<tr><td>".$dato[6]."</td><td>".$dato[7]."</td><td>".$dato[5]."</td><td>".$dato[2]."</td><td>".$dato[3]."</td>";
								}
							else
								echo"<td colspan='5' align='center'> Nada Registrado</td>";
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
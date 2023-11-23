<!DOCTYPE html>
<html>
        <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Consultar Empleados</TITLE>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="../vista/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
	</head>
	<body>
		<div id='general'>
			<?php
				session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="empleado";
					include("banner.php");
					include("menu.php");
					include("../controlador/empleado_consultar.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='tablas' align='center'>
						<h2 style='text-align:center;'>Listado del Personal</h2>
						<table border='1' align='center' class='table'>
							<tr>
								<th>Nombre</th><th>Apellido</th><th>Cédula</th><th>Cargo</th><th>Estatus</th><th colspan='3'>Opción</th>
							</tr>";
							$con=pg_num_rows($res);
							if($con>0)
								while($dato=pg_fetch_array($res))
								{
									echo"<tr><td>".$dato[2]."</td><td>".$dato[3]."</td><td>".$dato[1]."</td><td>".$dato[9]."</td><td>".ucwords($dato[10])."</td>
									<td><form method='post' action='empleado_detalles.php'><center><button style='background:transparent;border:none;' title='ver'><span class='glyphicon glyphicon-eye-open'></span><input type='hidden' name='cedula' value='".$dato[1]."'><button></form></td>
									<td>";
										if($dato[10]=="activo"){echo"<form method='post' onsubmit='return confirm(\"¿Desea Continuar?\")' action='../controlador/empleado_estatus.php'>&nbsp&nbsp <center><input type=image src='img/iconos/locked-padlock.png' width='25' height='25' value='Blo style='margin-top:-20px;' title='bloquear''><input type='hidden' name='estatu' value='bloqueado'></center><input type='hidden' name='cedula' value='".$dato[1]."'></form>";}
										else{echo"<form method='post' onSubmit='return confirm(\"¿Desea Continuar?\")' action='../controlador/empleado_estatus.php'><center><input type=image src='img/iconos/unlocked-padlock-black-security-symbol (2).png' width='25' height='25'  value='Act' title='activar'><input type='hidden' name='estatu' value='activo'></center><input type='hidden' name='cedula' value='".$dato[1]."'></form>";}
									echo"</td>
									</td><td><form method='post' action='empleado_modificar.php'><center><input type=image src='img/iconos/settings-gears.png' width='24' height='22' value='Mod' title='Modificar'><input type='hidden' name='cedula' value='".$dato[1]."'></form></td></tr>";
								}
							else
								echo"<td colspan='6' align='center'> Sin resultado</td>";
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
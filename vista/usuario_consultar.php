<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Consultar Usuario</title>

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
					$posi="usuario";
					include("banner.php");
					include("menu.php");
					include("../controlador/usuario_consultar.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='tablas' align='center'>
						<h2>Usuarios Registrado</h2>
						<table border='1' align='center'>
							<tr>
								<th>Nombre</th><th>Apellido</th><th>Cédula</th><th>Usuario</th><th>Nivel</th><th colspan='2'>Opción</th>
							</tr>";
							$con=pg_num_rows($res);
							if($con>0)
								while($dato=pg_fetch_array($res))
								{
									echo"<tr><td>".$dato[2]."</td><td>".$dato[3]."</td><td>".$dato[1]."</td><td>".$dato[14]."</td><td>".ucwords($dato[16])."</td>
									<td align='center'>";
										if($dato[19]=="Activo"){echo"<form method='post' onSubmit='return confirm(\"¿Desea Continuar?\")' action='../controlador/usuario_estatus.php'><center><input type=image src='img/iconos/locked-padlock.png' width='25' height='25' value='Blo' title='bloquear' ><input type='hidden' name='estatu' value='bloquado'><input type='hidden' name='id' value='".$dato[12]."'></form>";}
										else{echo"<form method='post' onSubmit='return confirm(\"¿Desea Continuar?\")' action='../controlador/usuario_estatus.php'><center><input type=image src='img/iconos/unlocked-padlock-black-security-symbol (2).png' width='23' height='23' value='Act' title='activar' ><input type='hidden' name='estatu' value='Activo'><input type='hidden' name='id' value='".$dato[12]."'></form>";}
									echo"</td>
									<td align='center'> <form method='post' action='usuario_modificar.php'><center><input type=image src='img/iconos/settings-gears.png' width='24' height='22' value='Mod' title='Modificar'><input type='hidden' name='id' value='".$dato[12]."'></form></td>
									";
								}
							else
								echo"<td colspan='6' align='center'> Nada Registrado</td>";
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
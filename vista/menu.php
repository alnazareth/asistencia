<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<style type="text/css">
			body{
				background: url(img/mobil.png);
				background-repeat: no-repeat;
				background-size: 100% 100%;
			}
		</style>
	</head>
	<body>
	<div class="sidebar">
		<h2>Menu</h2>
		<ul>
		<li><a href="principal.php"><span class="glyphicon glyphicon-home"> Inicio</span></a></li>
		<li><a href="#"><span class="glyphicon glyphicon-briefcase"></span> Empleado</a>
		<ul>
					<li ><a href="empleado_registrar.php"><span class="glyphicon glyphicon glyphicon-pencil"></span> Registrar</a></li>
					<li ><a href="empleado_consultar.php"><span class="glyphicon glyphicon-list-alt"></span> Consultar</a></li>
		</ul></li>
		<li><a href="#"><span class="glyphicon glyphicon-tag"></span> Permiso</a>
		<ul>
					<li ><a href="permiso_registrar.php"><span class="glyphicon glyphicon glyphicon-pencil"></span> Registrar</a></li>
					<li ><a href="permiso_consultar.php"><span class="glyphicon glyphicon-list-alt"></span> Consultar</a></li>
		</ul>
		</li>
		<li><a href="#"><span class="glyphicon glyphicon-ok"></span> Asistencia</a>
		<ul>
					<li ><a href="../vista/asistencia_registrar.php"><span class="glyphicon glyphicon glyphicon-pencil"></span> Registrar</a></li>
					<li ><a href="../vista/asistencia_consultar.php"><span class="glyphicon glyphicon-list-alt"></span> Consultar</a></li>
		</ul>
		</li>
		<li><a href="horario_consultar.php"><span class="glyphicon glyphicon-time"></span> Horario</a></li>
		<?php
				if($_SESSION['tipo_usua']=="administrador")
				{
					echo'
					<li>
						<a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp&nbspUsuario</a>
						<ul>
							<li ><a href="../vista/usuario_registrar.php"><span class="glyphicon glyphicon glyphicon-pencil"></span> Registrar</a></li>
							<li ><a href="../vista/usuario_consultar.php"><span class="glyphicon glyphicon-list-alt"></span> Consultar</a></li>
						</ul>
					</li>';
				}
				else
				{
					echo'<li><a href="manual/Manual usuario.pdf" target="_blank"><span class="glyphicon glyphicon-info-sign"></span> Ayuda</a></li>';
				}
			?>
		<li><a href="#"><span class="glyphicon glyphicon-file"></span> Reporte</a>
		<ul>
						<li ><a href="../controlador/PDF/examples/usuario.php" target="_blank">Usuario</a></li>
						<li ><a href="../controlador/PDF/examples/personal.php" target="_blank">Personal</a></li>
						<li ><a href="../controlador/PDF/examples/permiso.php" target="_blank">Permiso</a></li>
						<li ><a href="../controlador/PDF/examples/asistencia.php" target="_blank">Asistencia</a></li>
						<li ><a href="../controlador/PDF/examples/inasistencia.php" target="_blank">Inasistencia</a></li>
						<?php
							if($_SESSION['tipo_usua']=="administrador")
							{
								echo'<li ><a href="../controlador/PDF/examples/sesion.php" target="_blank">Sesion</a></li>
								<li ><a href="../controlador/PDF/examples/auditoria.php" target="_blank">Auditoria</a></li>';
							}
						?>
					</ul>
		</li>
		<li><a href="../controlador/salir.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesion</a></li>
		</ul>
	</div>

	</body>
</html>


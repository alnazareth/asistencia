<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script src="../controlador/reloj.js" language="javascript" type="text/javascript"></script>
		<style type="text/css">
			body{
				background: url(img/mobil.png);
				background-repeat: no-repeat;
				background-size: 100% 100%;
			}

		@font-face {
                font-family: "uente";
                src: url(fonts/Philosopher-BoldItalic.ttf) format("truetype");
            }
			#letra1{
                font-family: "uente";
                -webkit-text-stroke: 2px rgb(15, 15, 155);
                z-index: 1;
			}
			#img{
				margin-left: 60%;
				width: 10%;
			}
			.rel{
				margin-right: 5%;
				border-radius: 0%;
				transform: rotate(0deg);
			}
		</style>
	</head>
	<body>
		<div id='banner'>
			<img class="rel" src="img/hora.jpg" width="150" height="100" style="margin-left: -76.5%;margin-top: 4%;">
			<span id='letra1'>
				Control
				de
				&nbsp;Asistencia<br>
			</span>
			<img id='img' src="img/descarga.jpg">
		</div>
		<div id='informacion' align='center'>
			<div class='hora' align='center'>
				<script>reloj()</script>
				<?php
					date_default_timezone_set('America/Caracas');
					$fecha=date("d/m/Y");
					echo"<div id='fecha'>$fecha</div>";
				?>
			</div>
			<div class='fecha' align='center'>
				<br>
			</div>
			<div class='centro' align='center'>
				<?php
					if(isset($posi))
					{
						if($posi=="principal")
							echo"BIENVENIDO";
						if($posi=="empleado")
							echo"Gestionar Empleado";
						if($posi=="permiso")
							echo"Gestionar Permiso";
						if($posi=="horario")
							echo"Gestionar Horario";
						if($posi=="asistencia")
							echo"Gestionar Asistencia";
						if($posi=="usuario")
							echo"Gestionar Usuario";
					}
				?>
			</div>
			<div class='usuario' align='right'>
				<?php
					if(isset($_SESSION['activa']))
					{
						if($_SESSION['tipo_usua']!="administrador")
							echo"&nbsp&nbsp Usuario<br>";

						else
							echo"Administrador <a href='manual/Manual administrador.pdf' target='_blank' style='color: white;'><span class='glyphicon glyphicon-question-sign'></a><br>";

						echo $_SESSION['usuario'];
						echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
					}
				?>
			</div>
		</div>
	</body>
</html>
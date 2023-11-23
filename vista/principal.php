<!DOCTYPE html>
<html>
        <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<title>SISTEMA</title>
	<head>
		<meta charset='UTF-8'>
		<title>Pagina Principal</title>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
		<style type="text/css">
			body{
				background: url(img/mobil.png);
				background-repeat: no-repeat;
				background-size: 100% 100%;
			}
		</style>
	</head>
	<body>
		<div id='general'>
			<?php
				session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="principal";
					include("banner.php");
					include("menu.php");
					echo"<div id='separador'>
						&nbsp;
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

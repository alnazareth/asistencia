<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Modificar Horario</title>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
    <script type="text/javascript">
function solo_numeros(evt)
{
	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;
	var caract = new Array('1','2','3','4','5','6','7','8','9','0',':');
	var ban = false;
	for(var w=0;w<caract.length;w++){if (caract[w] == String.fromCharCode(key) || key == 8 || key == 0){ban = true;break;}}

	if (ban == true){return true;}else{return false;}
}

    </script>

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
					include("../controlador/horario_modificar.php");
					$dato=pg_fetch_array($res);
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='horario_modificar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Modificar Horario</h2></td>
								</tr>
								<tr>
									<td colspan='6' align='center'><h2>Mañana</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Entrada</label></td>
									<td><input value='".$dato[1]."' name='entra_ma' placeholder='Ejemplo: 10:00' class='input' maxlength='8' onKeyPress='return solo_numeros(event)' type='text' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Salida</label></td>
									<td><input value='".$dato[2]."' name='sali_ma' placeholder='Ejemplo: 10:00' class='input'  type='text' maxlength='8' onKeyPress='return solo_numeros(event)' required></td>
								</tr>
								<tr>
									<td colspan='6' align='center'><h2>Tarde</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Entrada</label></td>
									<td><input value='".$dato[3]."' name='entra_ta' placeholder='Ejemplo: 10:00' class='input'  type='text' maxlength='8' onKeyPress='return solo_numeros(event)' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Salida</label></td>
									<td><input value='".$dato[4]."' name='sali_ta' placeholder='Ejemplo: 10:00' class='input'  type='text' maxlength='8' onKeyPress='return solo_numeros(event)' required></td>
								</tr>
								<tr>
									<td colspan='6' align='center'>
										<input type='Submit' class='input2' value='Modificar' name='boton'>
									</td>
								</tr>
							</table>
						</form>
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
<!DOCTYPE html>
<html>
 <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Registrar Asistencia</title>

	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
		<script type="text/javascript">
			function solo_numeros2(evt)
{

	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;
	var caract = new Array('1','2','3','4','5','6','7','8','9','0');
	var ban = false;
	for(var w=0;w<caract.length;w++){if (caract[w] == String.fromCharCode(key) || key == 8 || key == 0){ban = true;break;}}

	if (ban == true){return true;}else{return false;}
}

function variado() {

       if(document.getElementById("cedula").value.length <7){
		alert('Debe ingresar al menos 7 Digitos');
		 window.location='asistencia_registrar.php';
		return false;

	}
}
		</script>
	</head>
	<body>
		<div id='general'>
			<?php
				@session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="asistencia";
					include("banner.php");
					include("menu.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios' align='center'>
						<form method='post' action='../controlador/asistencia_registrar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='3' align='center'><h2>Registrar Asistencia</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Cédula</label></td>
									<td><input name='cedula' placeholder='Ingrese Cedula' class='input'  type='text' id='cedula'  onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)' required></td>
								</tr>
								<tr>
									<td colspan='3' align='center'>
										<input type='submit' class='input2' value='Registrar' value='boton1'>
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
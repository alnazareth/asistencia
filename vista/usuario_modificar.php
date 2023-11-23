<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
		<title>Modificar Usuario</title>

	<head>
		<meta charset='UTF-8'>
    <script type="text/javascript" src="script.js"></script>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
		<script type="text/javascript">

	function variad() {

       if(document.getElementById("clave").value.length <8){
		alert('Debe ingresar al menos 8 Digitos');
		 //window.location='usuario_modificar.php';
		return false;

	}
}
function permite(elEvento, permitidos)
{
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  switch(permitidos)
  {
    case 1:
      permitidos = numeros;
    break;
    case 2:
      permitidos = caracteres;
    break;
    case 12:
      permitidos = numeros_caracteres;
    break;
  }
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
  return permitidos.indexOf(caracter) != -1;
}
		</script>
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
					include("../controlador/usuario_modificar.php");
					$dato=pg_fetch_array($res);
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='usuario_modificar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Modificar Usuario</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Nombre</label></td>
									<td><input disabled value='".$dato[2]."' name='' placeholder='Nombre' class='input'  type='text' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Apellido</label></td>
									<td><input disabled value='".$dato[3]."' name='' placeholder='Apellido' class='input'  type='text' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Cedula</label></td>
									<td><input disabled value='".$dato[1]."' name='' placeholder='Cedula' class='input'  type='text' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Usuario</label></td>
									<td><input disabled value='".$dato[14]."' name='' placeholder='Usuario' class='input'  type='text' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Password</label></td>
									<td><input value='".base64_decode($dato[13])."' name='pass' placeholder='Ingrese Password' class='input' id='clave' type='password' maxlength='15' onchange='return variad()' onkeypress='return permite(event , 12)' required></td>

									<td><span class=''><i class='glyphicon glyphicon-envelope'></i></span></td>
									<td><label class=''>Nivel</label>  </td>
									<td>
										<select name='nivel' class='inputsele' >
											<option value='Usuario' ";if($dato[16]=="Usuario"){echo"selected='selected'";}echo">Usuario</option>
											<option value='administrador' ";if($dato[16]=="administrador"){echo"selected='selected'";}echo">Admin</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan='6' align='center'>
										<input type='hidden' class='input' value='".$dato[12]."' name='id'>
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
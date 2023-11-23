<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Registrar Usuario</TITLE>
	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<script type="text/javascript" src="../controlador/js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cedula").blur(function(){
				  	var cedula=$("#cedula").val();
				  	$("#nombre").val("");
				  	$.ajax({
				    	type: "POST",
				    	url: "../controlador/buscar_pers.php",
				    	data: 'cedula='+cedula,
				    	success:function(resp){
				    		 $("#nombre").val(resp);
				    	}
				    });
				});
			});

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
		 window.location='usuario_registrar.php';
		return false;

	}
}
function variad() {

       if(document.getElementById("clave").value.length <8){
		alert('Debe ingresar almenos 8 Digitos');
		 window.location='usuario_registrar.php';
		return false;

	}
}
function varia(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function solo_letras(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
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
					$fecha=date('Y-m-d');
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='../controlador/usuario_registrar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Registrar Usuario</h2></td>
								</tr>
								<tr>

									<td><span class='glyphicon glyphicon-credit-card'></span></td>
									<td><label class=''>Cédula</label></td>
									<td><input id='cedula' name='cedula' placeholder='Ingrese Cedula' class='input'  type='text' onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)' required></td>


									<td><span class='glyphicon glyphicon-user'></span></td>
									<td><label class=''>Nombre</label></td>
									<td><input disabled name='nombre' id='nombre' placeholder='Nombre y Apellido' class='input'  type='text'  required></td>


								</tr>
								<tr>
									<td><span class='glyphicon glyphicon-user'></span></td>
									<td><label class=''>Usuario</label>  </td>
									<td><input name='usu' placeholder='Ingrese Usuario' class='input'  type='text' maxlength='15' onKeyPress='return varia(event)' required></td>

									<td><span class='glyphicon glyphicon-lock'></span></td>
									<td><label class=' '>Password</label>   </td>
									<td><input name='pass' placeholder='Ingrese Contraseña' class='input' type='Password' id='clave' required maxlength='15' onchange='return variad()' onkeypress='return permite(event , 12)'  required></td>
								</tr>
								<tr>
									<td><span class='glyphicon glyphicon-question-sign'></span></td>
									<td><label class=''>Pregunta Secreta</label>  </td>
									<td><select name='pregunta' class='inputsele' >
											<option value='¿nombre de mi madre?' >¿nombre de mi madre?</option>
											<option value='¿nombre de mi mascota?' >¿nombre de mi mascota?</option>
											<option value='¿nombre de mi abuela materna?' >¿nombre de mi abuela materna?</option>
											<option value='¿programa favorito de televicion?' >¿programa favorito de televicion?</option>
											<option value='¿equipo de beisbol favorito de mi padre?' >¿equipo de beisbol favorito de mi padre?</option>

										</select></td>

									<td><span class='glyphicon glyphicon-comment'></span></td>
									<td><label class=' '>Respuesta Secreta</label>   </td>
									<td><input name='respuesta' placeholder='Ingrese Respuesta Secreta' maxlength='15' onKeyPress='return solo_letras(event)' class='input' type='text'  required></td>
								</tr>
								<tr>
									<td><span class='glyphicon glyphicon-chevron-down'></span></td>
									<td><label class=''>Nivel</label>  </td>
									<td>
										<select name='nivel' class='inputsele' >
											<option value='Usuario' >Usuario</option>
											<option value='administrador' >administrador</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan='3' align='right'>
										<input type='reset' class='input2' value='Limpiar'>
									</td>
									<td colspan='3'>
										<input type='submit' class='input2' value='Registrar'>
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
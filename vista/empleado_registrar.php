<!DOCTYPE html>
<html>
 <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Registrar Empleado</TITLE>
	<head>
		<meta charset='UTF-8'>
  		<link rel="stylesheet" type="text/css" href="../css/estilo.css">
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
		 window.location='empleado_registrar.php';
		return false;

	}
}

function telef() {

       if(document.getElementById("te").value.length <11){
		alert('Debe ingresar 11 Digitos');
		 window.location='empleado_registrar.php';
		return false;

	}
}

function solo_letras(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function varia(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm0123456789 -.,;#°)(]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
  		</script>
	</head>
	<body>
		<div id='general'>
			<?php
				@session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="empleado";
					include("banner.php");
					include("menu.php");
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='../controlador/empleado_registrar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Registro de Personal</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Nombre</label></td>
									<td><input  maxlength='20' name='nombre' placeholder='Ingrese Nombre' class='input'  type='text' maxlength='15' onKeyPress='return solo_letras(event)' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class='' >Apellido</label> </td>
									<td><input name='apellido' placeholder='Ingrese Apellido' class='input'  type='text' maxlength='15' onKeyPress='return solo_letras(event)' required></td>
								</tr>
								<tr>
								<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Cédula</label></td>
									<td><input  name='cedula' placeholder='Ingrese Cedula' class='input' id='cedula' type='text' onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)'  required></td>

									<td><span class=''><i class='glyphicon glyphicon-earphone'></i></span></td>
									<td><label class=' '>Telefono</label>   </td>
									<td><input id='te' name='telefono' placeholder='Ingrese Numero' class='input' type='text' onchange='return telef()' maxlength='11' onKeyPress='return solo_numeros2(event)' required></td>

								</tr>
								<tr>

								<td><span class=''><i class='glyphicon glyphicon-road'></i></span></td>
									<td><label class=''>Dirección</label>  </td>
									<td><input name='dire' placeholder='Dirección' class='input' type='text' maxlength='50' onKeyPress='return varia(event)' required></td>


									<td><span class=''><i class='glyphicon glyphicon-envelope'></i></span></td>
									<td><label class=''>Correo Electronico</label>  </td>
									<td><input name='correo' placeholder='Nombre@dominio.com' class='input'  type='email' required></td>

								</tr>
								<tr>
									<td><span class='glyphicon glyphicon-collapse-down'></span></td>
									<td><label class=''>Estado civil</label>  </td>
									<td>
										<select name='estado' class='inputsele' >
											<option value='' >--SELECCIONE--</option>
											<option value='comcubinato' >concubinato</option>
											<option value='soltero' >Soltero(a)</option>
											<option value='casado' >Casado(a)</option>
											<option value='divorciado' >Divorciado(a)</option>
											<option value='viudo' >Viudo(a)</option>


										</select>
									</td>

									<td><span class=''><i class='glyphicon glyphicon-briefcase'></i></span></td>
									<td><label class=''>Cargo</label>   </td>
									<td><select name='cargo' class='inputsele' >
											<option value='0' >--SELECCIONE--</option>
											<option value='obrero' >Obrero</option>
											<option value='administrativo' >Administrativo</option>
											<option value='docente' >docente</option>

										</select></td>
								</tr>

								<tr>
									<td><img src='img/glyphicons/png/glyphicons-758-gender-ori-hetero.png' width='20' height='20'></span></td>
									<td><label class=''>Sexo</label>  </td>
									<td><input type='radio' name='sexo' value='masculino' /> Masculino&nbsp;&nbsp;&nbsp; <input type='radio' name='sexo' value='femenino' /> Femenino</td>
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
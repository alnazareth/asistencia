<!DOCTYPE html>
<html>
 <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Modificar Empleado</TITLE>

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
		// window.location='../controlador/empleado_modificar.php';
		return false;

	}
}

function telef() {

       if(document.getElementById("te").value.length <11){
		alert('Debe ingresar 11 Digitos');
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
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
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
					include("../controlador/empleado_modificar.php");
					$dato=pg_fetch_array($res);
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='empleado_modificar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Modificar Empleado</h2></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Cédula</label></td>
									<td><input value='".$dato[1]."' name='cedula' placeholder='Ingrese Cedula' class='input' id='cedula'  type='text' onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)' required readonly='readonly'></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Nombre</label></td>
									<td><input value='".$dato[2]."'  name='nombre' placeholder='Ingrese Nombre' class='input'  type='text' maxlength='15' onKeyPress='return solo_letras(event)' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class='' >Apellido</label> </td>
									<td><input value='".$dato[3]."' name='apellido' placeholder='Ingrese Apellido' class='input'  type='text' maxlength='15' onKeyPress='return solo_letras(event)'  required></td>

									<td><span class=''><i class='glyphicon glyphicon-envelope'></i></span></td>
									<td><label class=''>E-Mail</label>  </td>
									<td><input value='".$dato[8]."' name='correo' placeholder='Nombre@dominio.com' class='input'  type='email' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-earphone'></i></span></td>
									<td><label class=' '>Telefono</label>   </td>
									<td><input value='".$dato[6]."' name='telefono' placeholder='Ingrese Numero' class='input' type='text' id='te'   onchange='return telef()' maxlength='11' onKeyPress='return solo_numeros2(event)' required></td>

									<td><span class=''><i class='glyphicon glyphicon-edit'></i></span></td>
									<td><label class=''>Dirección</label>  </td>
									<td><input value='".$dato[5]."' name='dire' placeholder='Dirección' class='input' type='text' maxlength='20' onKeyPress='return varia(event)' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-edit'></i></span></td>
									<td><label class=''>Estado civil</label>  </td>
									<td>
										<select name='estado' class='inputsele' >
											<option value='concubinato'";if($dato[7]=="concubinato"){echo"selected='selected'";} echo" >Concubinato</option>
											<option value='soltero'";if($dato[7]=="soltero"){echo"selected='selected'";} echo" >Soltero(a)</option>
											<option value='casado'";if($dato[7]=="casado"){echo"selected='selected'";} echo" >Casado(a)</option>
											<option value='divorciado'";if($dato[7]=="divorciado"){echo"selected='selected'";} echo" >Divorciado(a)</option>
											<option value='viudo'";if($dato[7]=="viudo"){echo"selected='selected'";} echo" >Viudo(a)</option>

										</select>
									</td>

									<td><span class=''><i class='glyphicon glyphicon-briefcase'></i></span></td>
									<td><label class=''>Cargo</label>   </td>
									<td>
										<select name='cargo' class='inputsele' >
											<option value='obrero'";if($dato[9]=="Obrero"){echo"selected='selected'";} echo" >Obrero</option>
											<option value='administrativo'";if($dato[9]=="administrativo"){echo"selected='selected'";} echo" >Administrativo</option>
											<option value='docente'";if($dato[9]=="docente"){echo"selected='selected'";} echo" >Docente</option>
										</select>
									</td>
								</tr>

								<tr>
									<td><span class=''><i class='glyphicon glyphicon-edit'></i></span></td>
									<td><label class=''>Sexo</label>  </td>
									<td>
										<input type='radio' name='sexo' value='masculino'";if($dato[4]=="masculino"){echo"checked='checked'";}echo" /> Masculino&nbsp;&nbsp;&nbsp;
										<input type='radio' name='sexo' value='femenino' ";if($dato[4]=="femenino"){echo"checked='checked'";}echo"/> Femenino
									</td>
								</tr>
								<tr>
									<td colspan='6' align='center'>
										<input type='hidden' name='oculto' value='".$dato[1]."'>
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
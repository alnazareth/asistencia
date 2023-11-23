<!DOCTYPE html>
<html><link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Registrar Permisos</TITLE>

	<head>
		<meta charset='UTF-8'>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
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
		 window.location='permiso_registrar.php';
		return false;

	}
}
		</script>
	</head>
	<body>
		<div id='general'>
			<?php
				session_start();
				if(isset($_SESSION['activa']))
				{
					$posi="permiso";
					include("banner.php");
					include("menu.php");
					$fecha=date('Y-m-d');
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='../controlador/permiso_registrar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Registrar Permiso</h2></td>
								</tr>
								<tr>
									<td colspan='2' align='right'><span class=''><i class='glyphicon glyphicon-credit-card'></i></span>
									<label class=''>Cédula</label></td>

									<th colspan='2'><input id='cedula' name='cedula' placeholder='Ingrese Cedula' class='input'  type='text' onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)' required></th>
								</tr>
								<tr>
									<td><span class='glyphicon glyphicon-calendar'></span><label class=''>Fecha Inicio</label>  </td>
									<td><input name='ini' placeholder='' class='input'  type='date' min='$fecha' required></td>

									<td><span class='glyphicon glyphicon-calendar'></span><label class=' '>Fecha Final</label>   </td>
									<td><input name='fin' placeholder='' class='input' type='date' min='$fecha' required></td>
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
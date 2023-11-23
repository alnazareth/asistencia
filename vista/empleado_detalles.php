<!DOCTYPE html>
<html>
 <link rel="shortcut icon" href="img/descarga.jpg" width="20" height="20" border="0">
<TITLE>Ver Información De Empleado</TITLE>

	<head>
		<meta charset='UTF-8'>

		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
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
					include("../controlador/empleado_detalles.php");
					$dato=pg_fetch_array($res);
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios'>
						<form method='post' action='empleado_consultar.php'>
							<table align='center' cellpadding='5' id='tablefor'>
								<tr>
									<td colspan='6' align='center'><h2>Detalles Empleado</h2></td>
								</tr>
								<tr>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class=''>Nombre</label></td>
									<td><input disabled value='".$dato[2]."'  name='nombre' placeholder='Ingrese Nombre' class='input'  type='text' required></td>

									<td><span class=''><i class='glyphicon glyphicon-user'></i></span></td>
									<td><label class='' >Apellido</label> </td>
									<td><input disabled value='".$dato[3]."' name='apellido' placeholder='Ingrese Apellido' class='input'  type='text' required></td>
								</tr>
								<tr>
								<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
									<td><label class=''>Cédula</label></td>
									<td><input disabled value='".$dato[1]."' name='cedula' placeholder='Ingrese Cedula' class='input'  type='number' required></td>

									<td><span class=''><i class='glyphicon glyphicon-earphone'></i></span></td>
									<td><label class=' '>Telefono</label>   </td>
									<td><input disabled value='".$dato[6]."' name='telefono' placeholder='Ingrese Numero' class='input' type='number' required></td>

								</tr>
								<tr>

									<td><span class='glyphicon glyphicon-road'></span></td>
									<td><label class=''>Dirección</label>  </td>
									<td><input disabled value='".$dato[5]."' name='dire' placeholder='Dirección' class='input' type='text' required></td>

									<td><span class=''><i class='glyphicon glyphicon-envelope'></i></span></td>
									<td><label class=''>Correo Electronico</label>  </td>
									<td><input disabled value='".$dato[8]."' name='correo' placeholder='Nombre@dominio.com' class='input'  type='email' required></td>
								</tr>
								<tr>
									<td><span class=''><i class='glyphicon glyphicon-edit'></i></span></td>
									<td><label class=''>Estado civil</label>  </td>
									<td>
										<select name='estado' class='inputsele' disabled>
											<option value='soltero'";if($dato[7]=="soltero"){echo"selected='selected'";} echo" >Soltero</option>
											<option value='casado'";if($dato[7]=="casado"){echo"selected='selected'";} echo" >Casado</option>
										</select>
									</td>

									<td><span class=''><i class='glyphicon glyphicon-briefcase'></i></span></td>
									<td><label class=' '>Cargo</label>   </td>
									<td><input disabled value='".$dato[9]."' name='cargo' placeholder='Ingrese Cargo' class='input'  type='text' required></td>
								</tr>

								<tr>
									<td><span class=''><i class='glyphicon glyphicon-edit'></i></span></td>
									<td><label class=''>Sexo</label>  </td>
									<td>
										<input disabled type='radio' name='sexo' value='masculino'";if($dato[4]=="masculino"){echo"checked='checked'";}echo" /> Masculino&nbsp;&nbsp;&nbsp;
										<input disabled type='radio' name='sexo' value='femenino' ";if($dato[4]=="femenino"){echo"checked='checked'";}echo"/> Femenino
									</td>
								</tr>
								<tr>
									<td colspan='6' align='center'>
										<input type='Submit' class='input2' value='Atras'>
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
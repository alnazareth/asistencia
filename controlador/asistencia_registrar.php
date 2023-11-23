<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>Registrar Asistencia</title>
		<link rel="stylesheet" type="text/css" href="../vista/css/estilo.css">
		<link rel="stylesheet" type="text/css" href="../vista/css/menu.css">
	</head>
	<body>
		<div id='general'>
			<?php
				@session_start();
				if(isset($_SESSION['activa']) or isset($_POST['enviar']))//si cumple la condicion entonces:
				{
					if(empty($_POST['enviar']))
					{
						$posi="asistencia";
						include("../vista/banner.php");//incluye la vista todo
						include("../vista/menu.php");	//incluye la vista menu
					}
					$cedula=$_POST['cedula'];
					include("../modelo/asistencia.php");
					$obj=new asistencia();//cre el objeto asistencia
					$res=$obj->registrar($cedula);//hace referencia al metodo registrar
					echo"<div id='separador'>
						&nbsp;
					</div>
					<div id='formularios' align='center'>";
						if($res==3 or $res==4)//si cualquiera bn sea 3 o 4 secumple entonces:
						{
							echo"<form method='post' action='#'>
								<table align='center' cellpadding='5' id='tablefor'>
									<tr>
										<td colspan='3' align='center'><h2>Registrar Asistencia</h2></td>
									</tr>
									<tr>
										<td><span class=''><i class='glyphicon glyphicon-credit-card'></i></span></td>
										<td><label class=''>Cédula</label></td>
										<td><input name='cedula' placeholder='Ingrese Cedula' class='input'  type='number' required></td>
									</tr>
									<tr>
										<td colspan='3' align='center'>
											<input type='submit' class='input2' value='Registrar' value='boton1'>
										</td>
									</tr>
								</table>
							</form>";
							if($res==3){//si es igual a 3 entonces:
								echo"<script>alert('Cedula de Empleado NO registrada. Verifique...');
								window.location='../vista/asistencia_registrar.php';</script>";
							}
							else if($res==4){//si es igual a 4 entonces:
								echo"<script>alert('Empleado De PERMISO. Verifique...');
								window.location='../vista/asistencia_registrar.php';</script>";
							}
						}
						else if($res==5){//si es igual a 5 entonces:
							echo"<span class='error'>Persona Bloqueada, Verifique...</span>";
						}
						else if($res==2){//si es igual a 2 entonces:
							echo"<span class='error'>ERROR al Registrar</span>";
						}
						else{// si no se cumple algunas de las condiciones anteriores entonces:
							echo"
							<table align='center' cellpadding='5'>
								<tr>
									<td>Nombre: </td><td>".$res['nombre']."</td>
								</tr>
								<tr>
									<td>Apellido: </td><td>".$res['apellido']."</td>
								</tr>
								<tr>
									<td>Cédula: </td><td>".$res['cedula']."</td>
								</tr>
								<tr>
									<td>Acción: </td><td><span class='bien'>".$res['accion']."</span></td>
								</tr>

							</table>
							<img src='../vista/img/iconos/checked-mark.png' width='20' height='20' border='0'>
							";
						}
					echo"</div>
						<meta http-equiv='refresh' content='5;../vista/asistencia_consultar.php' >";
				}
				else
				{
					header("location:../");
				}
			?>
		</div>
	</body>
</html>

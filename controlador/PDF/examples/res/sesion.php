<link rel="stylesheet" type="text/css" href="../../../vista/css/pdf.css">
<?php
	ini_set("memory_limit",'256M');
	include("../../../modelo/conexion.php");
	$clase=new Conectar();
	$clase->con();
	$sql="SELECT * FROM sesion";
	$ejecutar= pg_query($sql);
	$mostrar=pg_num_rows($ejecutar);
	$lim=20;
	$off=0;
	$total_pagina=(ceil($mostrar/$lim));
	$c=0;
	date_default_timezone_set('America/Caracas');
	$fecha=date("d/m/Y");
	for($i=1;$i<=$total_pagina;$i++)
	{
		echo"
		<page backleft='10mm' backtop='20mm' backright='10mm' backbottom='10mm' footer='page;heure;date'>
			<div class='tabla'>
				<page_header >
					<div class='logoCH'></div>
					<h4 style='margin-top:20px;' class='titulo'>Rep&uacute;blica Bolivariana de Venezuela</h4>
					<h4 class='titulo'>Ministerio del Poder Popular para la Defensa</h4>
					<h4 class='titulo'>Universidad Nacional Experimental Politecnica</h4>
					<h4 class='titulo'>de la Fuerza Armada Nacional</h4>
					<h4 class='titulo'>Nucleo Sucre Extension Car&uacute;pano</h4>
					<h4 class='titulo'>Car&uacute;pano Edo - Sucre</h4>
					<h4 class='titulo' id='titu'>ESTANCIA EN EL SISTEMA </h4>
				</page_header>";

				$select= pg_query("SELECT * FROM sesion,usuario WHERE usuario.id=sesion.id_usu LIMIT $lim OFFSET $off  ");
				$mostrar=pg_num_rows($select);
				$off=$lim+$off;

				echo"<table border='1' align='center'>
					<tr>
						<th style='border-right:none;width:7%;'>
							N&deg;
						</th>
						<th style='border-right:none;width:20%;'>
							Usuario
						</th>
						<th style='border-right:none;width:15%;'>
							Fecha de <br>Entrada
						</th>
						<th style='border-right:none;width:15%;'>
							Hora de <br>Entrada
						</th>
						<th style='border-right:none;width:15%;'>
							Fecha de <br>Salida
						</th>
						<th style='width:15%;'>
							Hora de <br>Salida
						</th>
					</tr>";
					if($mostrar > 0)
					{
						while($fila=pg_fetch_array($select))
						{
							$c++;
							$fecha_entrada=$fila[1];
							$hora_entrada=$fila[2];
							$fecha_salida=$fila[3];
							$hora_salida=$fila[4];
							$tipo=$fila[5];
							$fecha_entrada = new DateTime($fecha_entrada);
							$fecha_entrada=$fecha_entrada->format('d/m/Y');
							$fecha_salida = new DateTime($fecha_salida);
							$fecha_salida=$fecha_salida->format('d/m/Y');
							if($tipo=="Entrada"){$fecha_salida="00/00/0000";}
							if($tipo=="Entrada"){$hora_salida="00:00";}
							$usuario=$fila[9];
							echo"<tr >
								<td style='border-right:none;width:7%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$c
								</td>
								<td style='border-right:none;width:20%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$usuario
								</td>
								<td style='border-right:none;width:15%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$fecha_entrada
								</td>
								<td style='border-right:none;width:15%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$hora_entrada
								</td>
								<td style='border-right:none;width:15%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$fecha_salida
								</td>
								<td style='width:15%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$hora_salida
								</td>";
							echo"</tr>";
						}
					}
				echo"</table>
			</div>
			<span class='sicca'>Sistema de Control de Asistencia </span>
		</page>";
	}

?>
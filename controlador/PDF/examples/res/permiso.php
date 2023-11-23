<link rel="stylesheet" type="text/css" href="../../../vista/css/pdf.css">
<?php
	ini_set("memory_limit",'256M');
	include("../../../modelo/conexion.php");
	$clase=new Conectar();
	$clase->con();
	$sql="SELECT * FROM persona,permiso WHERE persona.id=permiso.id_pers ; ";
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
					<h4 class='titulo' id='titu'>HISTORIAL DE PERMISOS </h4>
				</page_header>";

				$select= pg_query("SELECT * FROM persona,permiso WHERE persona.id=permiso.id_pers ORDER BY fecha_fin DESC LIMIT $lim OFFSET $off  ");
				$mostrar=pg_num_rows($select);
				$off=$lim+$off;

				echo"<table border='1' align='center'>
					<tr >
						<th style='border-right:none;'>
							N&deg;
						</th>
						<th style='border-right:none;'>
							NOMBRE
						</th>
						<th style='border-right:none;'>
							APELLIDO
						</th>
						<th style='border-right:none;'>
							C&Eacute;DULA
						</th>
						<th style='border-right:none;'>
							INICIO
						</th>
						<th>
							FINAL
						</th>
					</tr>";
					if($mostrar > 0)
					{
						while($fila=pg_fetch_array($select))
						{
							$c++;
							$nombre=$fila[2];
							$apellido=$fila[3];
							$cedula=$fila[1];
							$inicio=$fila[14];
							$final=$fila[15];
							$inicio = new DateTime($inicio);
							$inicio=$inicio->format('d/m/Y');
							$final = new DateTime($final);
							$final=$final->format('d/m/Y');

							echo"<tr >
								<td style='width:7%;border-right:none; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$c
								</td>
								<td style='width:18%;border-right:none; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$nombre
								</td>
								<td style='width:18%;border-right:none; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$apellido
								</td>
								<td style='width:18%;border-right:none; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$cedula
								</td>
								<td style='width:20%; border-right:none; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$inicio
								</td>
								<td style='width:18%;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$final
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
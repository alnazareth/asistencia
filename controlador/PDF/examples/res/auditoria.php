<link rel="stylesheet" type="text/css" href="../../../vista/css/pdf.css">
<?php
	ini_set("memory_limit",'256M');
	include("../../../modelo/conexion.php");
	$clase=new Conectar();
	$clase->con();
	$sql="SELECT * FROM auditoria";
	$ejecutar= pg_query($sql);
	$mostrar=pg_num_rows($ejecutar);
	$lim=18;
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
					<h4 class='titulo' id='titu'>AUDITORIA </h4>
				</page_header>";

				$select= pg_query("SELECT * FROM auditoria,usuario WHERE usuario.id=auditoria.id_u LIMIT $lim OFFSET $off  ");
				$mostrar=pg_num_rows($select);
				$off=$lim+$off;

				echo"<table border='1' align='center'>
					<tr>
						<th style='border-right:none;width:8%;'>
							N&deg;
						</th>
						<th style='border-right:none;width:12%;'>
							Usuario
						</th>
						<th style='border-right:none;width:12%;'>
							Fecha
						</th>
						<th style='border-right:none;width:12%;'>
							Hora
						</th>
						<th style='width:50%;'>
							Actividad
						</th>
					</tr>";
					if($mostrar > 0)
					{
						while($fila=pg_fetch_array($select))
						{
							$c++;
							$fecha=$fila[1];
							$hora=$fila[2];
							$actividad=$fila[3];
							$usuario=$fila[7];

							$fecha = new DateTime($fecha);
							$fecha=$fecha->format('d/m/Y');

							echo"<tr >
								<td style='border-right:none;width:8%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$c
								</td>
								<td style='border-right:none;width:10%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$usuario
								</td>
								<td style='border-right:none;width:10%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$fecha
								</td>
								<td style='border-right:none;width:10%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$hora
								</td>
								<td style='width:50%; ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" '>
									$actividad
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
<link rel="stylesheet" type="text/css" href="../../../vista/css/pdf.css">
<?php
	ini_set("memory_limit",'256M');
	include("../../../modelo/conexion.php");
	$clase=new Conectar();
	$clase->con();
	$lim=20;
	$off=0;
	$fecha=date("d/m/Y");
	$ano=date("Y");
	$mes=date("m");
	$dia=date("d");

	for($i=1;$i<=$dia;$i++)
	{
		$sql="SELECT * FROM persona WHERE fecha_registro<='$ano-$mes-$i' order by estatu_per ";
		$ejecutar= pg_query($sql);
		$mostrar=pg_num_rows($ejecutar);
		$lim=20;
		$off=0;
		$total_pagina=(ceil($mostrar/$lim));
		$c=0;
		for($j=1;$j<=$total_pagina;$j++)
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
						<h4 class='titulo' id='titu'>HISTORIAL DE ASISTENCIA $i/$mes/$ano</h4>
					</page_header>";

					$select= pg_query("SELECT * FROM persona WHERE fecha_registro<='$ano-$mes-$i' order by estatu_per LIMIT $lim OFFSET $off  ");
					$mostrar=pg_num_rows($select);
					$off=$lim+$off;

					echo"<table border='1' align='center'>
						<tr>
							<th style='border-right:none;' >Nombre</th>
							<th style='border-right:none;' >Apellido</th>
							<th style='border-right:none;' >Cedula</th>
							<th style='border-right:none;' >Entrada</th>
							<th style='border-right:none;' >Salida</th>
							<th style='border-right:none;' >Entrada</th>
							<th>Salida</th>
						</tr>
						";
						if($mostrar > 0)
						{
							while($fila=pg_fetch_array($select))
							{
								$c++;
								$nombre=$fila[2];
								$apellido=$fila[3];
								$cedula=$fila[1];
								$id=$fila[0];
								$fecha=date('Y-m-d');
								$sql_per="SELECT * FROM permiso,persona WHERE cedu_pers='$cedula' AND id=id_pers AND fecha_ini<='$ano-$mes-$i' AND fecha_fin>='$ano-$mes-$i'";

								$eje_per=pg_query($sql_per);
								$con_per=pg_num_rows($eje_per);
								echo"<tr>
										<td style='width:15%;border-right:none;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"'>$nombre</td><td style='width:15%;border-right:none;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"'>$apellido</td><td style='width:15%;border-right:none;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"'>$cedula</td>";
								if($con_per>0)
								{
									echo"<td colspan='4' style='";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" width:40%;'> De PERMISO</td>";
								}
								else
								{
									$sql="SELECT * FROM asistencia WHERE id_pe='$id' AND fecha='$ano-$mes-$i' ";
									$eje=pg_query($sql);
									$dato_asis=pg_fetch_array($eje);
									echo"<td style=' ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" width:12%;border-right:none;'>";
										if($dato_asis[2]=="" OR $dato_asis[2]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[2]." AM";}
									echo"</td><td style=' ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" width:12%;border-right:none;'>";
										if($dato_asis[3]=="" OR $dato_asis[3]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[3]." AM";}
									echo"</td><td style=' ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" width:12%;border-right:none;'>";
									if($dato_asis[4]=="" OR $dato_asis[4]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[4]." PM";}
									echo"</td><td style=' ";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo" width:12%;'>";
										if($dato_asis[5]=="" OR $dato_asis[5]=="00:00:00"){echo"Sin Marcar";}else{echo $dato_asis[5]." PM";}
									echo"</td>";
								}
								echo"</tr>";
							}
						}
					echo"</table>
				</div>
				<span class='sicca'>Sistema de Control de Asistencia </span>
			</page>";
		}
	}




?>
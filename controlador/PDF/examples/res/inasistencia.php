<link rel="stylesheet" type="text/css" href="../../../vista/css/pdf.css">
<?php
	ini_set("memory_limit",'256M');
	include("../../../modelo/conexion.php");
	$clase=new Conectar();
	$clase->con();
	date_default_timezone_set('America/Caracas');
	$fecha=date("d/m/Y");
	$ano=date("Y");
	$mes=date("m");
	$dia=date("d");
	$mess[0]="Enero";    $mess[1]="Febrero";    $mess[2]="Marzo";    $mess[3]="Abril";    $mess[4]="Mayo";    $mess[5]="Junio";    $mess[6]="Julio";    $mess[7]="Agosto";$mess[8]="Septiembre";    $mess[9]="Octubre";    $mess[10]="Noviembre";    $mess[11]="Diciembre";
	$dato_ho=pg_fetch_array(pg_query("SELECT * FROM horario"));
	$ho_entrada_ma=$dato_ho[1];
	$ho_salida_ma=$dato_ho[2];
	$ho_entrada_ta=$dato_ho[3];
	$ho_salida_ta=$dato_ho[4];

	$total_horas_ma= new DateTime($ho_salida_ma);
	$total_horas_ma->sub(new DateInterval('PT'.$ho_entrada_ma[0].''.$ho_entrada_ma[1].'H'.$ho_entrada_ma[3].''.$ho_entrada_ma[4].'M'));

	$total_horas_ta= new DateTime($ho_salida_ta);
	$total_horas_ta->sub(new DateInterval('PT'.$ho_entrada_ta[0].''.$ho_entrada_ta[1].'H'.$ho_entrada_ta[3].''.$ho_entrada_ta[4].'M'));

	$total_horas_ma=$total_horas_ma->format('H:i:s');
	$total_horas_ta=$total_horas_ta->format('H:i:s');

	$total_horas_dia=new DateTime($total_horas_ma);
	$total_horas_dia->add(new DateInterval('PT'.$total_horas_ta[0].''.$total_horas_ta[1].'H'.$total_horas_ta[3].''.$total_horas_ta[4].'M'));

	for($i=1;$i<=$dia;$i++)
	{
		$sql="SELECT * FROM persona WHERE fecha_registro<='$ano-$mes-$i'";
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
						<h4 class='titulo' id='titu'>Historial de Inasistencias $i/$mes/$ano</h4>
					</page_header>";
					$select= pg_query("SELECT * FROM persona WHERE fecha_registro<='$ano-$mes-$i' LIMIT $lim OFFSET $off  ");
					$mostrar=pg_num_rows($select);
					$off=$lim+$off;
					echo"
					<table border='1' align='center'>
						<tr>
							<th style='border-right:none;' >Nombre</th>
							<th style='border-right:none;' >Apellido</th>
							<th style='border-right:none;' >Cedula</th>
							<th >Horas de inasistencia</th>
						</tr>
					";
					if($mostrar > 0)
					{
						$total_horas=$total_horas_dia->format('H:i');
						while($fila=pg_fetch_array($select))
						{
							$eje_per=pg_query("SELECT * FROM permiso WHERE id_pers='".$fila[0]."' AND fecha_ini<='$ano-$mes-$i' AND fecha_fin>='$ano-$mes-$i' ");
							if(pg_num_rows($eje_per)>0)
							{
								$total_horas="De Permiso";
							}
							else
							{
								$eje=pg_query("SELECT * FROM asistencia WHERE id_pe='".$fila[0]."' AND fecha='$ano-$mes-$i' ");
								if(pg_num_rows($eje)<1)
								{
									$total_horas=$total_horas_dia->format('H:i');
								}
								else
								{
									$total_horas="00:00";
									$dato=pg_fetch_array($eje);
									$entrada_ma=$dato[2];
									$salida_ma=$dato[3];
									$entrada_ta=$dato[4];
									$salida_ta=$dato[5];
									if($entrada_ma=="00:00:00")
									{
										$total_horas=new DateTime($total_horas);
										$total_horas->add(new DateInterval('PT'.$total_horas_ma[0].''.$total_horas_ma[1].'H'.$total_horas_ma[3].''.$total_horas_ma[4].'M'));
										$total_horas=$total_horas->format('H:i');
									}
									else
									{
										if($entrada_ma>$ho_entrada_ma and $entrada_ma<=$ho_salida_ma)
										{
											$per_ma_en=new DateTime($entrada_ma);
											$per_ma_en->sub(new DateInterval('PT'.$ho_entrada_ma[0].''.$ho_entrada_ma[1].'H'.$ho_entrada_ma[3].''.$ho_entrada_ma[4].'M'));
											$per_ma_en=$per_ma_en->format('H:i:s');

											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$per_ma_en[0].''.$per_ma_en[1].'H'.$per_ma_en[3].''.$per_ma_en[4].'M'));
											$total_horas=$total_horas->format('H:i');

										}
										else
										{
											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$total_horas_ma[0].''.$total_horas_ma[1].'H'.$total_horas_ma[3].''.$total_horas_ma[4].'M'));
											$total_horas=$total_horas->format('H:i');
										}
										if($salida_ma<$ho_salida_ma)
										{
											$per_ma_sa=new DateTime($ho_salida_ma);
											$per_ma_sa->sub(new DateInterval('PT'.$salida_ma[0].''.$salida_ma[1].'H'.$salida_ma[3].''.$salida_ma[4].'M'));
											$per_ma_sa=$per_ma_sa->format('H:i:s');

											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$per_ma_sa[0].''.$per_ma_sa[1].'H'.$per_ma_sa[3].''.$per_ma_sa[4].'M'));
											$total_horas=$total_horas->format('H:i');
										}
									}
									if($entrada_ta=="00:00:00")
									{
										$total_horas=new DateTime($total_horas);
										$total_horas->add(new DateInterval('PT'.$total_horas_ta[0].''.$total_horas_ta[1].'H'.$total_horas_ta[3].''.$total_horas_ta[4].'M'));
										$total_horas=$total_horas->format('H:i');
									}
									else
									{
										if($entrada_ta>$ho_entrada_ta AND $entrada_ta<=$ho_salida_ta)
										{
											$per_ta_en=new DateTime($entrada_ta);
											$per_ta_en->sub(new DateInterval('PT'.$ho_entrada_ta[0].''.$ho_entrada_ta[1].'H'.$ho_entrada_ta[3].''.$ho_entrada_ta[4].'M'));
											$per_ta_en=$per_ta_en->format('H:i:s');

											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$per_ta_en[0].''.$per_ta_en[1].'H'.$per_ta_en[3].''.$per_ta_en[4].'M'));
											$total_horas=$total_horas->format('H:i');
										}
										else
										{
											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$total_horas_ta[0].''.$total_horas_ta[1].'H'.$total_horas_ta[3].''.$total_horas_ta[4].'M'));
											$total_horas=$total_horas->format('H:i');
										}
										if($salida_ta<$ho_salida_ta)
										{
											$per_ta_sa=new DateTime($ho_salida_ta);
											$per_ta_sa->sub(new DateInterval('PT'.$salida_ta[0].''.$salida_ta[1].'H'.$salida_ta[3].''.$salida_ta[4].'M'));
											$per_ta_sa=$per_ta_sa->format('H:i:s');

											$total_horas=new DateTime($total_horas);
											$total_horas->add(new DateInterval('PT'.$per_ta_sa[0].''.$per_ta_sa[1].'H'.$per_ta_sa[3].''.$per_ta_sa[4].'M'));
											$total_horas=$total_horas->format('H:i');
										}
									}
								}
							}

							echo"";
							$c++;
							echo"<tr>
								<td style='border-right:none;width:20%;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"' >".$fila[2]."</td>
								<td style='border-right:none;width:20%;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"' >".$fila[3]."</td>
								<td style='border-right:none;width:20%;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"' >".$fila[1]."</td>
								<td style='width:30%;";if($mostrar==$c){echo"border-bottom: 1px solid #282828;";} echo"'>".$total_horas."</td>
							</tr>";
						}
					}
					else
					{
						echo"<tr><td colspan='4' align='center'>Ninguna persona registrada</td></tr>";
					}
			echo"	</table>
				</div>
			</page>";
		}
	}
?>
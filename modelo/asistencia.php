<?php
	class asistencia//se crea la clase asistencia
	{
		public function __construct()//se crea un contruct
		{
			include_once("conexion.php");//incluye la clase conexion
			$obj_con= new conectar();
			$con = $obj_con->con();
			include_once("auditoria.php");//incluye la clase auditoria
			date_default_timezone_set('America/Caracas');
		}
		public function registrar($cedula)//busca las personas existentes del sistema
		{
			$this->sql1="SELECT * FROM persona WHERE cedu_pers='$cedula' ;";
			$this->eje1=pg_query($this->sql1);
			$this->con1=pg_num_rows($this->eje1);
			if($this->con1<1)
			{
				return 3;
			}
			else//busca por fecha si la persona esta de permiso
			{
				$fecha=date('Y-m-d');
				//sql para buscar todos los usuario registrados
				$this->sql2="SELECT * FROM permiso,persona WHERE cedu_pers='$cedula' AND id=id_pers AND fecha_fin>='$fecha' AND fecha_ini<='$fecha'";
				$this->eje2=pg_query($this->sql2);//ejecuta la consulta
                $this->con2=pg_num_rows($this->eje2);//cuenta el numero de filas que arrojo la ejecucion

				if($this->con2>0)//compara si es mayor a 0

				{
					return 4;
				}
				else
				{
					$this->dato=pg_fetch_array($this->eje1);//cuenta el numero de filas que arrojo la ejecucion y lo pocisiona segun el arreglo
					$this->nombre=$this->dato[2];
					$this->nombre=$this->dato[2];
					$this->apellido=$this->dato[3];
					$this->cedula=$this->dato[1];
					$this->id=$this->dato[0];
					$this->estatus=$this->dato[10];
					$this->accion="";
					$this->fecha=date('Y-m-d');
					$this->hora=@date('H', time() );
					$this->minutos=@date('i', time() );
					$this->meri='AM';
					if($this->hora>12)
					{
						$this->meri='PM';
					}
					if($this->hora>12)
					{
						$this->hora=$this->hora-12;
					}
					$this->htotal=$this->hora.":".$this->minutos ;
                         //muestra empantalla la siguiente informacion
					$re['nombre']=$this->nombre;
					$re['apellido']=$this->apellido;
					$re['cedula']=$this->cedula;
					if($this->estatus=="bloqueado")
					{
						return 5;
					}	
					else
					{
						$this->sql="SELECT * FROM asistencia WHERE fecha='$this->fecha' AND id_pe='$this->id' ";
						$this->eje=pg_query($this->sql);
						$this->con=pg_num_rows($this->eje);
						if($this->con<1)//compara si es menor a 1
						{
							//Insert
							if($this->meri=="AM")//si ingresa en la mañana 
							{
								$this->sql="INSERT INTO asistencia VALUES (default,'$this->fecha','$this->htotal','00:00:00','00:00:00','00:00:00','$this->id') ";
							}
							else
							{
								$this->sql="INSERT INTO asistencia VALUES (default,'$this->fecha','00:00:00','00:00:00','$this->htotal','00:00:00','$this->id') ";
							}
							$this->accion="Entrada";
						}
						else
						{
							//Update
							if($this->meri=="AM")//salida de mañana
							{
								$this->sql="UPDATE asistencia SET hsali_ma='$this->htotal' WHERE id_pe='$this->id' AND fecha='$this->fecha' ";
								$this->accion="Salida";
							}
							else//ingreso y salidad en la tarde
							{
								$this->dato=pg_fetch_array($this->eje);
								$this->aux=$this->dato[4];
								if($this->aux=="00:00:00")
								{
									$this->sql="UPDATE asistencia SET hentra_ta='$this->htotal' WHERE id_pe='$this->id' AND fecha='$this->fecha' ";
									$this->accion="Entrada";
								}
								else
								{
									$this->sql="UPDATE asistencia SET hsali_ta='$this->htotal' WHERE id_pe='$this->id' AND fecha='$this->fecha' ";
									$this->accion="Salida";
								}
							}
						}
						//ejecuta la consulta
						$re['accion']=$this->accion;
						$this->eje=pg_query($this->sql);//si se cumple la consulta entonces:
						if($this->eje)
						{
							return $re;//retorna $re si es correcto
						}
						else
						{
							return 2;//si no cumple retorna 2
						}	
					}					
				}
			}
		}
		public function mostrar()//funcion para mostrar el estatus de la persona
		{
			$this->sql="SELECT * FROM persona WHERE estatu_per='activo' ";//sql para verificar si la persona esta activa
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1
			{
				return $this->eje;//retorna la ejecucion
			}
			else
			{
				return $this->eje;//si no cumple la anterior retorna esta ejecucion
			}
		}
		public function asis($cedula)//recive las varibles
		{
			$this->sql="SELECT * FROM asistencia WHERE id_pe='$cedula' AND fecha='".date("Y-m-d")."'";//sql para buscar la asistencia
			
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1
			{
				return $this->eje;//retorna la ejecucion
			}
			else
			{
				return $this->eje;//sino retorna
			}
		}
	}
?>
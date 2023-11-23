<?php
	class usuario
	{
		public function __construct()
		{
			include("conexion.php");//incluye la conexion
			$obj_con= new conectar();//crea el metodo 
			$con = $obj_con->con();//ejecuta el objeto
			include_once("auditoria.php");
		}
		public function registrar($cedula,$usu,$pass,$nivel,$pregunta,$respuesta)//recibe las variables 
		{
			$this->sql="SELECT * FROM usuario,persona WHERE persona.id=codi_pers AND cedu_pers='$cedula' ";//crea el sql para buscar si la persona ya tiene un usuario registrado
			$this->eje=pg_query($this->sql);// ejecuta el sql
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con>0)//compara si es mayor a 0
			{
				return 4;//si se cumple la condicion retorna un 4 al controlador
			}
			else
			{
				$this->sql="SELECT * FROM persona WHERE cedu_pers='$cedula' ;";//sql para verificar si la persona esta registrada
				$this->eje=pg_query($this->sql);//ejecuta el sql
				$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
				if($this->con<1)//compara si es menor a 1
				{
					return 5;//si se cumple la condicion retorna un 5 al controlador
				}
				else
				{
					$this->sql="SELECT * FROM usuario WHERE logn_usua='$usu' ";//query para ver si el usuario se encuentra registrado
					$this->eje=pg_query($this->sql);//ejecuta el sql
					$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
					if($this->con>0)
					{
						return 3;
					}
					else
					{
						$pass=base64_encode($pass);//encripta la clave
						//sql de insercion
						$this->sql="INSERT INTO usuario (codi_pers,clav_usua,logn_usua,tipo_usua,pregunta,respuesta,estatus_usu) SELECT id,'$pass','$usu','$nivel','$pregunta','$respuesta','Activo' from persona where cedu_pers='$cedula' ";
						$this->eje=pg_query($this->sql);
						if($this->eje)
						{
							auditoria::registrar("Registro un Usuario ( $usu )");
							return 1;
						}
						else
						{
							return 2;
						}
					}	
				}
				
			}
		}

				public function login($id)
		{
			$this->sql="SELECT * FROM usuario WHERE logn_usua='".$id."' ";//sql para buscar los datos del usuario
			$this->eje=pg_query($this->sql);
			$this->con=pg_num_rows($this->eje);
			if($this->con<1)
			{
				return $this->eje;//retorna la ejecucion
			}
			else
			{
				return $this->eje;
			}
		}
		
		public function ver($id)
		{
			$this->sql="SELECT * FROM persona,usuario WHERE persona.id=codi_pers AND usuario.id='$id' ";//sql para buscar los datos del usuario
			$this->eje=pg_query($this->sql);
			$this->con=pg_num_rows($this->eje);
			if($this->con<1)
			{
				return $this->eje;//retorna la ejecucion
			}
			else
			{
				return $this->eje;
			}
		}
		public function mostrar()
		{
			$this->sql="SELECT * FROM persona,usuario WHERE persona.id=codi_pers ";//sql para buscar todos los usuario registrados
			$this->eje=pg_query($this->sql);
			$this->con=pg_num_rows($this->eje);
			if($this->con<1)
			{
				return $this->eje;
			}
			else
			{
				return $this->eje;
			}
		}
		public function estatus($id,$estatus)
		{
			$this->sql="UPDATE usuario SET estatus_usu='$estatus' WHERE id='$id' ";//sql para modificar el status del usuario
			$this->eje=pg_query($this->sql);
			if($this->eje)
			{
				$usu=pg_fetch_array(pg_query("SELECT * FROM usuario WHERE id='$id';"));
				auditoria::registrar("Modifico el Estatus del Usuario ( ".$usu[2]." )");
				return 1;
			}
			else
			{
				return 2;
			}
		}
		public function modificar($pass,$nivel,$id)
		{
			$pass=base64_encode($pass);//encriptacion
			$this->sql="UPDATE usuario SET clav_usua='$pass',tipo_usua='$nivel' WHERE id='$id' ";//sql para modificar los datos del usuario
			$this->eje=pg_query($this->sql);
			if($this->eje)
			{
				$usu=pg_fetch_array(pg_query("SELECT * FROM usuario WHERE id='$id';"));
				auditoria::registrar("Modifico la Clave del Usuario ( ".$usu[2]." )");
				return 1;
			}
			else
			{
				return 2;
			}
		}
	}
?>
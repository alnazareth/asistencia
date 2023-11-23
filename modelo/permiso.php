<?php
	class permiso//se crea la clase permiso
	{
		public function __construct()//se crea un contruct
		{
			include_once("conexion.php");//incluye la clase conexion
			$obj_con= new conectar();//crea el metodo 
			$con = $obj_con->con();//ejecuta el objeto
			include_once("auditoria.php");
		}

		public function registrar($cedula,$ini,$fin)//recibe las variables para registrar
		{
			$this->sql="SELECT * FROM persona WHERE cedu_pers='$cedula'; ";//crea el sql para buscar si la persona ya tiene permiso registrado
			$this->eje=pg_query($this->sql);// ejecuta el sql
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1
			{
				return 3;
			}
			else
			{
				//sql de insercion
				$this->sql="INSERT INTO permiso (id_pers,fecha_ini,fecha_fin) SELECT id,'$ini','$fin' FROM persona WHERE cedu_pers='$cedula' ; ";
				$this->eje=pg_query($this->sql);//ejecuta la consulta
				if($this->eje)//si se cumple la consulta entonces:
				{
					auditoria::registrar("Registro un Permiso ( $cedula )");
					return 1;//si inserta correctamente retorna un 1 al controlador
				}
				else
				{
					return 2;//si no se inserta retorna 2 al controlador
				}
			}
		}

		public function mostrar()//funcion que permite mostrar los permisos
		{
			$fecha=date('Y-m-d');
			$this->sql="SELECT * FROM permiso,persona WHERE id=id_pers AND fecha_ini<='$fecha' AND fecha_fin>='$fecha'";//crea el sql para buscar los permiso
			$this->eje=pg_query($this->sql);// ejecuta el sql
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

		public function buscar($cedula)//funcion que permite buscar los permiso de una persona 
		{
			$fecha=date('Y-m-d');
			$this->sql="SELECT * FROM permiso,persona WHERE cedu_pers='$cedula' AND id=id_pers AND fecha_fin>='$fecha' AND fecha_ini<='$fecha'";//crea el sql para buscar los permiso
			$this->eje=pg_query($this->sql);// ejecuta el sql
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
	}
?>
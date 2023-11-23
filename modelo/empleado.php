<?php
	class empleado//se crea la clase empleado
	{
		public function __construct()//se crea un contruct
		{
			include_once("conexion.php");//incluye la clase conexion
			$obj_con= new conectar();//crea el metodo
			$con = $obj_con->con();//ejecuta el objeto
			include_once("auditoria.php");//incluye la clase auditoria
		}

		public function registrar($nombre,$apellido,$cedula,$correo,$telefono,$cargo,$dire,$estado,$sexo)//recibe las variables para registrar
		{
			$this->sql="SELECT * FROM persona WHERE cedu_pers='$cedula'";//crea el sql para buscar si la persona ya esta registrada
			$this->eje=pg_query($this->sql);// ejecuta el sql
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con>0)//compara si es mayor a 0
			{
				return 3;
			}
			else
			{
				//sql de insercion
				$this->fecha=date('Y-m-d');
				$this->sql="INSERT INTO persona VALUES (default,'$cedula','$nombre','$apellido','$sexo','$dire','$telefono','$estado','$correo','$cargo','activo','$this->fecha');";
				$this->eje=pg_query($this->sql);//ejecuta la consulta
				if($this->eje)//si se cumple la consulta entonces:
				{
					return 1;//si inserta correctamente retorna un 1 al controlador
				}
				else
				{
					return 2;//si no se inserta retorna 2 al controlador
				}
			}
		}
		public function mostrar()//funcion que permite ver el estatus de la persona
		{
			$this->sql="SELECT * FROM persona ORDER BY estatu_per ASC";//sql para ver el status del empleado
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1
			{
				return 3;//retorna 3 si es correcto
			}
			else
			{
				return $this->eje;//retorna $this->eje si no lo es 
			}
		}
		public function ver($cedula)//recibe la variables
		{
			if($cedula==""){$cedula=0;}//si se cumple la condicion
			$this->sql="SELECT * FROM persona WHERE cedu_pers='$cedula';";//sql para ver el empleado
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1
			{
				return 3;//retorna 3 si es correcto
			}
			else
			{
				return $this->eje;//retorna $this->eje si no lo es 
			}
		}
		public function estatus($cedula,$estatus)//recibe la variables para modificar el estatus
		{
			$this->sql="UPDATE persona SET estatu_per='$estatus' WHERE cedu_pers='$cedula' ";//sql para modificar el status del empleado
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			if($this->eje)//si se cumple la consulta entonces:
			{
				return 1;//retorna 1 si a ejecucion es correcta
			}
			else
			{
				return 2;// si no retorna 2
			}
		}
		public function modificar($nombre,$apellido,$cedula,$correo,$telefono,$cargo,$dire,$estado,$sexo,$oculto)//recibe las variables para buscar el rejistro del empleado
		{
			$this->sql="SELECT * FROM persona WHERE cedu_pers='$cedula' AND cedu_pers!='$oculto'; ";//sql para buscar los datos del empleado
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con>0)//compara si es mayor a 0
			{
				return 3;//retorna 3 si lo en contro
			}
			else
			{
				$this->sql="UPDATE persona SET cedu_pers='$cedula',nomb_pers='$nombre',apel_pers='$apellido',sexo_pers='$sexo',dire_pers='$dire',tele_pers='$telefono',eciv_pers='$estado',corr_pers='$correo',carg_pers='$cargo' WHERE cedu_pers='$oculto' ;  ";//sql para modificar los datos del empleado
				$this->eje=pg_query($this->sql);//ejecuta la consulta
				if($this->eje)//si se cumple la consulta entonces:
				{
					return 1;//retorna 1 si a ejecucion es correcta
				}
				else
				{
					return 2;// si no retorna 2
				}
			}
		}
		public function activos()
		{
			$this->sql="SELECT * FROM persona WHERE estatu_per='activo' ";//para ver cuales son los empleados activos en el sistema 
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			$this->con=pg_num_rows($this->eje);//cuenta el numero de filas que arrojo la ejecucion
			if($this->con<1)//compara si es menor a 1 entonces:
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
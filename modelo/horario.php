<?php
	class horario//se crea la clase horario
	{
		public function __construct()//se crea un contruct
		{
			include("conexion.php");//incluye la clase conexion
			$obj_con= new conectar();//crea el metodo
			$con = $obj_con->con();//ejecuta el objeto
			include_once("auditoria.php");//incluye la clase auditoria
		}
		public function mostrar()//funcion que permite mostrar el horarial
		{
			$this->sql="SELECT * FROM horario";//sql para ver el horario
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
		public function modificar($entra_ma,$sali_ma,$entra_ta,$sali_ta)//funcion que permite modificar el horario
		{
			$this->sql="UPDATE horario SET hora_entra_ma='$entra_ma',hora_sali_ma='$sali_ma',hora_entra_ta='$entra_ta',hora_sali_ta='$sali_ta' ;";//sql para modificar los datos del horario
			$this->eje=pg_query($this->sql);//ejecuta la consulta
			if($this->eje)//si se cumple la consulta entonces:
			{
				auditoria::registrar("Modifico el horario de Trabajo");
				return 1;//retorna 1 si a ejecucion es correcta
			}
			else
			{
				return 2;// si no retorna 2
			}
		}
	}

?>
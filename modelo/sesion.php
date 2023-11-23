<?php
@session_start();//INICIAR LA SESSION
class usuario{//crea la clase usuario
	public $usuario;
	private $clave;
	public $tipo;

	function iniciar($user,$password){//funcion que recibe los parametros para iniciar seccion
		//$password=base64_encode($password);//encripta la clave
		date_default_timezone_set('America/Caracas');
		$this->fecha=date("d/m/Y");
		$this->hora=@date('H', time());
		$this->minutos=@date('i', time());
		$this->meri='AM';
		if($this->hora>12)
		{
			$this->meri='PM';
			$this->hora=$this->hora-12;
		}
		$this->htotal=$this->hora.":".$this->minutos." ".$this->meri;
		$this->result= pg_query("SELECT * FROM usuario where logn_usua='$user' and clav_usua='$password' ");//ejecuta la consulta para buscar el usuario
		$this->cantidad=pg_num_rows($this->result);//cuenta el numero de filas que arrojo la ejecucion
		if($this->cantidad==1)//si se cumple la condicion entonces:
		{
			$dato=pg_fetch_array($this->result);//cuenta el numero de filas que arrojo la ejecucion y lo pocisiona segun el arreglo
			$estatus=$dato[7];//pocisiona el arrglo 
			if($estatus=="Activo")//si se cumple la condicion entonces:
			{
				$_SESSION['activa']= 'true';//PARA VERIFICAR SI HAY SESSION ABIERTA
				$_SESSION['usuario']=$user;//login
				$_SESSION['id']=$dato['id'];
				$_SESSION['tipo_usua']=$dato['tipo_usua'];
				$this->id=$dato['id'];
				$this->sql="SELECT * FROM sesion WHERE id_usu='$this->id' AND tipo='Entrada'; ";
				//Se ejecuta el SQL
				$this->ejecutar=pg_query($this->sql);
				//Se compara
				if(!$this->ejecutar)
				{
					//Si falla la consulta se devuele un 0 al controlador para que muestre un mensaje.
					return 0;
				}
				else
				{
					//se Cuenta
					$this->contar=pg_num_rows($this->ejecutar);
					if($this->contar>0)
					{
						//Si se encuenta una sesion activada anteriormente se crea un SQL para cerrar esa sesion y insertar los datos de la nueva sesion.
						$this->sql="UPDATE sesion SET fecha_sa='$this->fecha',hora_sa='$this->htotal',tipo='Salina' WHERE id_usu=$this->id AND tipo='Entrada';
						
						INSERT INTO sesion (fecha_en,hora_en,tipo,id_usu) VALUES ('$this->fecha','$this->htotal','Entrada',$this->id);";
						//Se ejecuta.
						$this->ejecutar=pg_query($this->sql);
						//Se compara
						if(!$this->ejecutar)
						{
							//Si falla la consulta se devuele un 0 al controlador para que muestre un mensaje.
							return 0;
						}
						else
						{
							//Se retorna un 1 al controlador para permitir el accseo.
							if($this->fila[3]==3)
								return 11;
							else
								return 1;
						}	
						
					}
					else
					{
						//Se crea un SQL para insertar el registro de la sesion.
						$this->sql="INSERT INTO sesion(fecha_en,hora_en,tipo,id_usu) VALUES ('$this->fecha','$this->htotal','Entrada',$this->id); ";
						//se ejecuta.
						$this->ejecutar=pg_query($this->sql);
						//Se compara.
						if(!$this->ejecutar)
						{
							//Si falla la consulta se devuele un 0 al controlador para que muestre un mensaje.
							return 0;
						}
						else
						{
							//Se retorna un 1 al controlador para permitir el accseo.
							return 1;
						}
					}
				}	
			}
			else
			{
				return 2;
			}
			
		}
		else
			return 0;

	}
	function salir(){//funcion para ssalir del sistema
		@session_start();
		date_default_timezone_set('America/Caracas');
		$this->id=$_SESSION['id'];
		$this->fecha=date("d/m/Y");
		$this->hora=@date('H', time());
		$this->minutos=@date('i', time());
		$this->meri='AM';
		if($this->hora>12)
		{
			$this->meri='PM';
			$this->hora=$this->hora-12;
		}
		$this->htotal=$this->hora.":".$this->minutos." ".$this->meri;
		//Se crea el SQL para indicar que la sesion que una vez fue activa ya se desconectara.
		$this->sql="UPDATE sesion SET fecha_sa='$this->fecha',hora_sa='$this->htotal',tipo='Salida' WHERE id_usu='$this->id' AND tipo='Entrada'";
		//Se ejecuta la consulta.
		$this->ejecutar=pg_query($this->sql);
		session_destroy();//destruye la session
		echo"<script type='text/javascript'>window.location='../';</script>";
	}

}
?>

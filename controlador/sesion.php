<?php
	@session_start();//INICIAR LA SESSION
	$nombre = trim($_POST['usuario']);//usuario ingresado
	$clave  = trim($_POST['clave']);//clave ingresada

	//CONECTAR CON LA BD
	include("../modelo/conexion.php");
	$obj_con= new conectar();
	$con = $obj_con->con();
	//CREAR OBJETO USUARIO
	include("../modelo/sesion.php");
	$obj_us= new usuario();//Crear objeto usuario*/
	$validar=$obj_us->iniciar($nombre,$clave);
	if(isset($_POST['enviar'])){//si se cumple la condicion entonces:
		if($validar==1){ ?>			
		    <script type="text/javascript">window.location="../vista/principal.php";</script>
			<?php
		}
		else if($validar==0){
			?>
			<script type="text/javascript">alert(" Usuario o Contraseña INCORRECTA ");</script>
			<script type="text/javascript">window.location="../";</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">alert(" Usuario INACTIVO ");</script>
			<script type="text/javascript">window.location="../";</script>
			<?php
		}
	}
	else{// si no sesion activa 
		if($_SESSION['activa']!='true'){
			echo "<script type='text/javascript'>javascript:location='../vista/principal.php'</script>";	
		}
		else
		{
			?>
			<script type="text/javascript">window.location="../";</script>
		<?php
		 }
	}
?>

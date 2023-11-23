  <?php

        //atarapa la s variables que viene del formulario 
    $login=$_GET['login'];
    include("../modelo/usuario.php");
    $obj=new usuario();//crea el obejeto empleado 
    $res=$obj->login($login);//hace referencia al metodo estatus 
    $cantidad=pg_num_rows($res);
    if ($cantidad<1) {
        echo"<script>alert('Usuario no existe');window.location='../index.php';</script>";

    }else{
        ?>
    <html lang="es">
    <head>
      
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/ancla.png" width="20" height="20" border="0">
        <title>EPGCA</title>
        <link href="css/style inicio.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" scr="../controlador/js/validacion.js"></script>
        <script type="text/javascript">
/*function varia(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function variad() {
   
       if(document.getElementById("clave").value.length <8){
        alert('Debe ingresar al menos 8 Digitos');
        window.location='index.php';
        return false;

    }
}   

function valida(tx)
{ 
  var
  nMay = 0, 
  nMin = 0,
  nNum = 0
  var t1 = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ"
  var t2 = "abcdefghijklmnñopqrstuvwxyz"
  var t3 = "0123456789"
  for (i=0;i<tx.length;i++) {
    if ( t1.indexOf(tx.charAt(i)) != -1 ) {nMay++}
    if ( t2.indexOf(tx.charAt(i)) != -1 ) {nMin++}
    if ( t3.indexOf(tx.charAt(i)) != -1 ) {nNum++}
  }
  if ( nMay>0 && nMin>0 && nNum>0 ) { 
    return true
     }
  else {
   return false 
 }
}
 
*/
function vamos() {
window.location='../index.php';
}
        </script>
        <style type="text/css">
            #b_asis{
                position: absolute;
                float: left;
                margin-left: 20px;
            }
            #su{
                position: absolute;
                float: left;
                margin-left: -50px;
            }
            #du{
                position: absolute;
                float: left;
                margin-left: 50px;
            }
        </style>
    </head>

    <body><?php
                $datos=pg_fetch_array($res);
                $log= $datos['logn_usua'];
            ?>
        <img src="img/top.png" hspace="20" vspace="5" width='100'>
      
        <h2> BIENVENIDO AL SISTEMA <BR></h2>
        <div class="caja" id="text" align="center" style='margin-top:15px;'>
            <div id='ini'>
                <form action="#" method="POST">
                    <font size="4"><h4>RECUPERACI&Oacute;N DE CLAVE</h4></font><BR>
                    <table>
                        <tr>
                            <td><label>Usuario: </label></td>
                            <td><?php echo $datos['logn_usua'];  ?></td>
                        </tr>
                        <tr>
                            <td><label>Pregunta:</label></td>
                            <td><?php echo $datos['pregunta'];  ?></td>
                        </tr>
                        <tr>
                            <td><label>respuesta:</label></td>
                            <td><input type='text' placeholder='respuesta secreta aqui' name='resp'></td>
                        </tr>
                    </table> <BR>   
                    <center>
                        <input type="submit" name='enviar' value="OBTENER" id='su' onClick="alert valida(this.form.clave.value))"> <input type="button" name='enviar' value="CANCELAR" id='du'onClick="vamos();">
                    </center>
        
                </form>
              
            <div>
        <div>  
    </body>
</html>
<?php
@$enviar = $_POST['resp'];
if(!empty($enviar)){
    if($enviar==$datos['respuesta']) {
            $clave_recuperada=base64_decode($datos['clav_usua']);

         echo"<script>alert('Su clave aparecerá en breve en la pantalla...');</script>";
echo"<script>alert('Su clave de acceso es: ->>".$clave_recuperada."<<-, cambiela inmediatamente');window.location='../index.php';</script>";
    }else{
    echo"<script>alert('Respuesta incorrecta!');window.location='../index.php';</script>";
}
   
}
}
?>
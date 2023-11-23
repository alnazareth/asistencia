<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="vista/img/descarga.jpg" width="20" height="20" border="0">
        <title>SISTEMA</title>
        <link href="vista/css/style inicio.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" scr="controlador/js/validacion.js"></script>
        <script type="text/javascript">
/*function varia(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}*/
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


function alerta() {
    var login= prompt("Ingrese su nombre de usuario:","");
   if (login== null || login=="") {

    window.location='index.php';

   }else{
      window.location='vista/recuperarclave.php?login='+login+'';
   } 
}
 


        </script>
        <style type="text/css">
            #b_asis{
                padding: 5px;
                position: absolute;
                float: left;
                margin-left: 20px;
            }
            #su{
                padding: 5px;
                position: absolute;
                float: left;
                margin-left: -50px;
            }
            .im{
                position: relative;
                float: left;
                margin-left: -40%;
                margin-top: 0%;
                border-radius: 40%;
            }
            @font-face {
                font-family: "uente";
                src: url(vista/fonts/Philosopher-BoldItalic.ttf) format("truetype");
            }
            .caja{
                border-radius: 20px 0px  20px 0px;
            }
            h4{
                font-family: "uente";
                border-radius: 20px 0px 0px 0px;
            }
            body{
                background: url(vista/img/mobil.png);
                background-repeat: no-repeat;
                background-size: 100% 110%;
            }
            button{
                cursor: pointer;
            }
            #su{
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <h2 style="font-family: 'uente';margin-top: 5%; -webkit-text-stroke: 2px rgb(15, 15, 155);"> SISTEMA DE CONTROL DE ASISTENCIA  <BR>
        "UNEfA CARUPANO"</h2>
        <div class="caja" id="text" align="center" style="margin-top: 10%;background: white; padding:15px;">
            <div id='ini'>
             <img src="vista/img/descarga.png" hspace="20" vspace="5" class="im">
                <form action="controlador/sesion.php" method="POST">
                    <font size="4"><h4>Iniciar Sesión</h4></font><BR>
                    <table>
                        <tr>
                            <td><label>Usuario:</label></td>
                            <td><input class='input'type="text" name="usuario" placeholder="nombre de usuario" maxlength='15' onKeyPress='return permite(event, 12)' required></td>
                        </tr>
                        <tr>
                            <td><label>Clave:</label></td>
                            <td><input class='input' type="password" name="clave" placeholder="contraseña" id="clave" required maxlength="15" onchange='return variad()' onkeypress="return permite(event , 12)"></td>
                        </tr>
                         <tr><td colspan='2'>  <div align='right'><a href='#' onclick='alerta();'><SMALL>Recuperar contraseña</SMALL></a></div></td></tr>
                    </table> <BR>
                    <center>
                        <input type="submit" name='enviar' value="Ingresar" id='su' onClick="alert valida(this.form.clave.value))">
                    </center>
                </form>
                <form action="asistencia.php" method="POST">
                    <button id='b_asis'>Asistencia</button>
                </form>
            <div>
        <div>
    </body>
</html>

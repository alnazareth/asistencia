<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="vista/img/logo.jpg" width="20" height="20" border="0">
        <title>Registrar Asistencia</title>
        <link href="vista/css/style inicio.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function solo_numeros2(evt)
{

    var nav4 = window.Event ? true : false;
    var key = nav4 ? evt.which : evt.keyCode;
    var caract = new Array('1','2','3','4','5','6','7','8','9','0');
    var ban = false;
    for(var w=0;w<caract.length;w++){if (caract[w] == String.fromCharCode(key) || key == 8 || key == 0){ban = true;break;}}

    if (ban == true){return true;}else{return false;}
}

function variado() {

       if(document.getElementById("cedula").value.length <7){
        alert('Debe ingresar al menos 7 Digitos');
        window.location='index.php';
        return false;

    }
}
        </script>
         <style type="text/css">
            #b_ini{
                padding: 5px;
                position: absolute;
                float: left;
                margin-left: 40px;
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
            h2{
                margin-top: 15%;
                font-family: "uente";
                -webkit-text-stroke: 2px rgb(15, 15, 155);
            }
        </style>
    </head>
     <body>
        <h2> REGISTRAR ASISTENCIA <BR></h2>
        <div class="caja" id="text" align="center" style="background: white;">
            <div id='asi'>
             <img src="vista/img/descarga.png" hspace="20" vspace="5" class="im">
                 <form action="controlador/asistencia_registrar.php" method="POST">
                    <font size="4"><h4>Marcar Asistencia</h4></font><BR>
                    <table>
                        <tr>
                            <td><label>Cédula:</label></td>
                            <td><input class='input' name="cedula" placeholder="Ingrese Cedula" type='text' id='cedula'  onchange='return variado()' maxlength='8' onKeyPress='return solo_numeros2(event)' required></td>
                        </tr>
                    </table> <BR>
                    <center>

                        <input type="submit" name='enviar' value="Registrar" id='su'>
                    </center>
                </form>
                <form action="index.php" method="POST">
                    <button id='b_ini'>Inicio</button>
                </form>
            </div>
        <div>
    </body>
</html>

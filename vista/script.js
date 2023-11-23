/***********modificar horario*************/

function solo_numeros(evt)
{
	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;
	var caract = new Array('1','2','3','4','5','6','7','8','9','0',':');
	var ban = false;
	for(var w=0;w<caract.length;w++){if (caract[w] == String.fromCharCode(key) || key == 8 || key == 0){ban = true;break;}}

	if (ban == true){return true;}else{return false;}
}

/***********registrar permiso*************/


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
		alert('Debe ingresar almenos 7 Digitos');
		return false;

	}
	 
}

/***********modificar clave de usuario*************/

function validar_cla()
{
	var clave = document.getElementById("clave").value;
	var numeros = "0123456789";
	var caracteres = "QWERTYUIOPÑLKJHGFDSAZXCVBNMÁÉÍÓÚáéíóú";
	var numero=0;
	var caracter=0;
	if(clave.length<8 || clave.length>15)
	{
		alert("Logitud permitida entre 8 - 15 caracteres");
		return false;
	}
	else
	{
		for(i=0;i<clave.length;i++)
		{
			else if(numeros.indexOf(clave.charAt(i),0)!=-1)
			{
				numero++;
			}
			else if(caracteres.indexOf(clave.charAt(i),0)!=-1)
			{
				caracter++;
			}
		}
		if( numero==0 || caracter==0)
		{
			alert("Debe ser Alfanumerica (Numeros y Letras) ");
			return false;
		}
	}
}






function variados(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
      
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNM0123456789]/;
    te = String.fromCharCode(tecla);
	  return patron.test(te);
}



function variados_otros(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[qwertyuiopasdfghjklñzxcvbnm0123456789]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function solo_letras(e) {
    tecla = (document.all) ? e.keyCode : e.which;
	//alert(tecla);
    if (tecla==8 || tecla==0) return true;
    patron =/[QWERTYUIOPASDFGHJKLÑZXCVBNMqwertyuiopasdfghjklñzxcvbnm]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function valida(e){
	if(document.getElementById("texto").value.length <=7){
		alert('Debe ingresar 8 Digitos');
		return false;
	}else{
		document.form1.submit();
	}
}

function valida2(e){
	if(document.getElementById("texto2").value.length <=8){
		alert('Debe ingresar 8 Digitos');
		return false;
	}else{
		document.form1.submit();
	}
}



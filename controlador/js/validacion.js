function permite(elEvento, permitidos) 
{
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [8, 37, 39, 13, 241];
  switch(permitidos) 
  {
    case 1:
      permitidos = numeros;
    break;
    case 2:
      permitidos = caracteres;
    break;
    case 12:
      permitidos = numeros_caracteres;
    break;
  }
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
  var tecla_especial = false;
  for(var i in teclas_especiales) 
  {
    if(codigoCaracter == teclas_especiales[i]) 
	{
      tecla_especial = true;
      break;
    }
  }
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

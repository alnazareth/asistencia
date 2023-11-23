var puntos = ":"
function hora()
{
	var fecha = new Date()
	var hora = fecha.getHours()
	var minuto = fecha.getMinutes()
	var meridiano = " AM"
	if(hora > 11)
	{ 
		meridiano = " PM"
	}
	if (hora > 12)
	{ 
		hora-= 12
	}
	if (hora < 10)
	{
		hora = "0" + hora
	}
	if (minuto < 10)
	{
		minuto = "0" + minuto
	}
	puntos == ":" ? puntos = " " : puntos = ":"
	var horaD = hora + puntos + minuto + meridiano
	document.getElementById('hora').firstChild.nodeValue = horaD	
	tiempo = setTimeout('hora()',1000)
}
function reloj()
{
	document.write('<span id="hora">')
	document.write('000000</span>')
	hora()
}
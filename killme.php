<?php   
    require_once "conn_mysql.php";
    $result1 = "";
	$result2 = "";
	
	/*Consulta ip*/
	$sqlIP = "SELECT ip, estado FROM pulsera WHERE id_pulsera = '1'"; //esto debe reemplazarse por la ip correspondiente a la pulsera asignada al usuario
	$result1 = $conn->query($sqlIP);
	$rows1 = $result1->fetchAll();
	/*consulta tiempo*/
	$sql = "SELECT descripcion FROM tiempo WHERE id_tiempo = '1'"; //esto también debe cambiarse por el registro de tiempo que tenga el usuario
	$result2 = $conn->query($sql);
	$rows = $result2->fetchAll();
	
	foreach ($rows as $row){
		$tiempo = $row["descripcion"]; //obtiene el tiempo de los resultados de la consulta
	}

	foreach ($rows1 as $row1){
		$ip = $row1["ip"];
		$jalisco = $row1['estado'];
		$kk = (int)$jalisco;
	}
	var_dump($jalisco);
	var_dump($kk);
	/*var_dump($tiempo);
	var_dump($ip);*/

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<script>
function mandaAlvAlMorro()
{
	let bandera = "LED=TODOOFF"
    var host = '<?php echo $ip;?>'
	todooff = window.open(host+bandera); //window.location.replace(host+bandera); esto reemplaza la ventana actual, lo cambié para que se abra una nueva pestaña
	cerrar = setTimeout(function(){todooff.window.close()}, 10000); //cierra la pestaña abierta (del server de la pulsera) después de x tiempo
}
		
function startTimer(duration, display) {
	var timer = duration, minutes, seconds;
    var intervalo = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
		
			if (--timer < 0) {
				timer = duration;
				mandaAlvAlMorro() /*aqui esta el bug, a pesar de que el contador ya llegó a 0, sigue habiendo un conteo y al pasar de nuevo el tiempo establecido, 
				vuelve a ejecutar este script, lo que abre ventana tras ventana y por consiguiente, se manda la orden a la pulsera cicliamente*/
				display = "";
				clearInterval(intervalo);
			}
    }, 1000); //esto son los milisegundos/velocidad a la que hará el conteo
	
  }
  if(<?php echo $kk;?> == 1){
	window.onload = function () { //lo que hace esto es asignar y desplegar la info en el div señalado
    	var tiempo = 10 * 1, //aqui meter el tiempo de ['descripcion']
        display = document.querySelector('#time');
		startTimer(tiempo, display)
	};
  }	
    
</script>
<div>
    <div>Tiempo termina en <span id="time"></span></div>
</div>
</body>
</html>
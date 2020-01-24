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

	foreach ($rows1 as $row1){ //esto ya no se debe utilizar pues sólo sirve para mostrar el resultado obtenido al momento de la consulta
		$ip = $row1["ip"];
		$jalisco = $row1['estado'];
		$kk = (int)$jalisco; //convierte a entero lo obtenido en la consulta
	}
	/*var_dump($jalisco);
	var_dump($kk); 
	var_dump($tiempo);
	var_dump($ip);*/

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
	var resultadoGlobal;
		function confirmacion() { 
				estado = $.ajax({ //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX   
				url: 'puerta.php', //indicamos la ruta donde se genera la consulta
				dataType: 'text',//indicamos que es de tipo texto plano
				async: false,     //ponemos el parámetro asyn a falso
				success:function(){
					resultadoGlobal = estado;
					console.log("Obtuve esto del AJAX: "+resultadoGlobal);
				}
			}).responseText;

			//actualizamos el div que nos mostrará el estado de la puerta
			document.getElementById("estado").innerHTML = "Estado de la puerta Obtenido en AJAX: "+resultadoGlobal;
			}
			//con esto llamamos a la función confirmacion cada segundo para actualizar el div que mostrará el estado
			setInterval(confirmacion,1000);
			console.log("estoy despues de la confirmacion AJAX, resultadoGlobal tiene: "+resultadoGlobal)

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
						mandaAlvAlMorro()
						display = "";
						clearInterval(intervalo); //esto soluciona el bug que tenía del temporizador en bucle
					}
			}, 1000); //esto son los milisegundos/velocidad a la que hará el conteo	
		}
		/*TERMINAN FUNCIONES, ESTO YA ES LA EJECUSION DIRECTA*/
		if(resultadoGlobal == 1){ //condiciona que si se ha obtenido un 1 (true) comienza a contar el tiempo
			window.onload = function () { //lo que hace esto es asignar y desplegar la info en el div señalado
				var tiempo = 10 * 1, //aqui meter el tiempo de ['descripcion']
				display = document.querySelector('#time');
				startTimer(tiempo, display)
			};
		}
		console.log("VARIABLE FUERA DE LA FUNCION: "+resultadoGlobal);
		eval(confirmacion);
</script>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<script>
		
		
    
</script>
<div>
	<div id="estado"></div>
    <div>Tiempo termina en <span id="time"></span></div>
</div>
</body>
</html>
<?php
	//Declaramos 4 variables para la conexión a la base de datos
 $servername = "localhost";
 $username = "root";
 $password = "";
 $BasedeDatos = "city_jumper";
	//En un bloque try catch escribimos la linea de conexión
	try {
		//creamos la varable $conn que usaremos todo el proyecto web
		//se usan las 4 variables de la conexión
		//PDO significa PHP DATA OBJECTS y es para conectarnos a las bases de datos
		$conn = new PDO("mysql:host=$servername;dbname=$BasedeDatos", $username, $password);
		
		//Asignamos los atributos de conexión
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		//Imprime en pantalla cuando no se pudo conectar
		echo "<div align='center'><h1>No me conecté aiudaaaaaa agase paya</h1></div>" . $e->getMessage();
	}
	
?>
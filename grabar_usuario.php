<?php   
    require_once "conn_mysql.php";
    $result = "";
	$result1 = "";
    $nombre = $_POST["txtNombre"];
	/*$paterno = $_POST["txtPaterno"];
	$materno = $_POST["txtMaterno"];*/
	$pulsera = $_POST["txtIdPulsera"];
	$pulsera = (int)$pulsera;
	/*$tiempo = $_POST[]; */
	/*Consulta ip*/
	$sqlIP = "SELECT ip FROM pulsera WHERE id_pulsera = " .$pulsera;
	$result1 = $conn->query($sqlIP);
	$rows1 = $result1->fetchAll();
	/*Termina intento consulta*/
	$sql = "SELECT nombre, id_pulsera FROM cliente WHERE id_pulsera= " . $pulsera;
	$result = $conn->query($sql);
	$rows = $result->fetchAll();
	
	if(empty($rows))
	{
    $sqlINSERT1 = "INSERT INTO cliente(nombre, id_pulsera)";
	$sqlINSERT2 = $sqlINSERT1 . "VALUES ('$nombre', '$pulsera')";
    $conn->exec($sqlINSERT2);
		
	$mensaje = "CLIENTE REGISTRADO SATISFACTORIAMENTE";
	$activate = "activate"; // o igual a 1
		foreach ($rows1 as $row1) {
			$x = $row1["ip"].$activate;
	header("Location: ".$x);
				}
	}else {
		$mensaje = "EL ID de Usuario YA EXISTE en la base de datos";
		
		$nombre="";
		$pulsera="";
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
<title>Guardar usuario</title>
</head>

<body>
	
	<?php
	echo $mensaje
	?>
	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>	
</body>
</html>
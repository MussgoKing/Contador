<?php
require_once "conn_mysql.php";
$result = "";
$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);
$rows = $result1->fetchAll();
/* Aquí hay que poner la consulta que 
inserta el true en la base de datos, el cual leera el dashboard 
para comenzar a contar el tiempo */
$ip = $_SERVER['REMOTE_ADDR'];
$algo = "/algo";
echo 'User IP - '.$ip.$algo;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
    echo 
?>
</body>
</html>
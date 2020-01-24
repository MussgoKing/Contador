<?php
    require_once "conn_mysql.php";
    $result = "";
    $sql = "SELECT pulsera.estado FROM pulsera where id_pulsera = '1'";
    $result = $conn->query($sql);
    $rows = $result->fetchAll();
    foreach ($rows as $row){
        $fila = $row["estado"];
        $estado = (int)$fila;
        
    }
    var_dump($estado)
?>
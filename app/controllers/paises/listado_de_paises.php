<?php

$sql_paises = "SELECT * FROM tb_paises";
$resultado_paises = $mysqli->query($sql_paises);

$paises_datos = array();
if ($resultado_paises->num_rows > 0) {
    while ($fila = $resultado_paises->fetch_assoc()) {
        $paises_datos[] = $fila;
    }
}

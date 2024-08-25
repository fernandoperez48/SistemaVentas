<?php

$sql_estado_envios = "SELECT * FROM tb_estado_envios";

// Preparar la consulta
$query_estado_envios = $mysqli->prepare($sql_estado_envios);

// Comprobar si la consulta se preparó correctamente
if (!$query_estado_envios) {
    die("Error al preparar la consulta: " . $mysqli->error);
}

// Ejecutar la consulta
if (!$query_estado_envios->execute()) {
    die("Error al ejecutar la consulta: " . $query_estado_envios->error);
}

// Obtener los resultados
$result = $query_estado_envios->get_result();
$estado_envios_datos = $result->fetch_all(MYSQLI_ASSOC);

// Liberar el resultado y cerrar la consulta
$result->free();
$query_estado_envios->close();

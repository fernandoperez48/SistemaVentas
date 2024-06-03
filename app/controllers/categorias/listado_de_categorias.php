<?php

$sql_categorias = "SELECT * FROM tb_acategorias";

// Preparar la consulta
$query_categorias = $mysqli->prepare($sql_categorias);

// Comprobar si la consulta se preparó correctamente
if (!$query_categorias) {
    die("Error al preparar la consulta: " . $mysqli->error);
}

// Ejecutar la consulta
if (!$query_categorias->execute()) {
    die("Error al ejecutar la consulta: " . $query_categorias->error);
}

// Obtener los resultados
$result = $query_categorias->get_result();
$categorias_datos = $result->fetch_all(MYSQLI_ASSOC);

// Liberar el resultado y cerrar la consulta
$result->free();
$query_categorias->close();

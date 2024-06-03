<?php

$sql_proveedores = "SELECT p.*,d.*, ci.nombre as iva
                    FROM tb_proveedores as p
                    INNER JOIN tb_domicilios as d
                    ON p.id_domicilio = d.id_domicilio
                    INNER JOIN tb_condicion_iva as ci 
                    ON ci.id = p.condicion_iva";

// Preparar la consulta
$query_proveedores = $mysqli->prepare($sql_proveedores);

// Comprobar si la consulta se preparó correctamente
if (!$query_proveedores) {
    die("Error al preparar la consulta: " . $mysqli->error);
}

// Ejecutar la consulta
if (!$query_proveedores->execute()) {
    die("Error al ejecutar la consulta: " . $query_proveedores->error);
}

// Obtener los resultados
$result = $query_proveedores->get_result();
$proveedores_datos = $result->fetch_all(MYSQLI_ASSOC);

// Liberar el resultado y cerrar la consulta
$result->free();
$query_proveedores->close();

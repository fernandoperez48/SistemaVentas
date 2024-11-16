<?php

$sql_condicion_iva = "SELECT tb_cond_iva.id as id, tb_cond_iva.nombre as nombre
FROM tb_condicion_iva AS tb_cond_iva";

$result_condicion_iva = $mysqli->query($sql_condicion_iva);

$clientesper_datos = [];

if ($result_condicion_iva) {
    while ($row = $result_condicion_iva->fetch_assoc()) {
        $condicion_iva_datos[] = $row;
    }
}

<?php

$id_clienteper_get = $_GET['id'];
$sql_clientesper = "SELECT cl.id_cliente, p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio 
                    FROM tb_clientes AS cl 
                    INNER JOIN tb_personas AS p 
                    ON cl.id_persona = p.id_persona 
                    WHERE id_cliente = '$id_clienteper_get'";

$resultado_clientesper = $mysqli->query($sql_clientesper);

$clientesper_datos = array();

while ($fila = $resultado_clientesper->fetch_assoc()) {
    $clientesper_datos[] = $fila;
}

foreach ($clientesper_datos as $clientesper_datos) {
    $idCliente = $clientesper_datos['id_cliente'];
    $dni = $clientesper_datos['dni'];
    $nombre = $clientesper_datos['nombre'];
    $apellido = $clientesper_datos['apellido'];
    $telefono = $clientesper_datos['telefono'];
    $email = $clientesper_datos['email'];
}

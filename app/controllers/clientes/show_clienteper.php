<?php
$id_clienteper_get = $_GET['id'];
$sql_clientesper = "SELECT cl.id_cliente, p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio FROM tb_clientes as cl inner join tb_personas as p on cl.id_persona=p.id_persona where id_cliente = '$id_clienteper_get'";
$query_clientesper = $pdo->prepare($sql_clientesper);
$query_clientesper->execute();
$clientesper_datos = $query_clientesper->fetchAll(PDO::FETCH_ASSOC);

foreach ($clientesper_datos as $clientesper_datos) {
    $idCliente = $clientesper_datos['id_cliente'];
    $dni = $clientesper_datos['dni'];
    $nombre = $clientesper_datos['nombre'];
    $apellido = $clientesper_datos['apellido'];
    $telefono = $clientesper_datos['telefono'];
    $email = $clientesper_datos['email'];
}

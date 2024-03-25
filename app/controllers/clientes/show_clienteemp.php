<?php
$id_clienteemp_get = $_GET['id'];
$sql_clientesemp = "SELECT cl.id_cliente, e.cuit, e.nombre, e.razon_social, e.telefono, e.email, e.persona_autorizada, e.id_domicilio 
FROM tb_clientes as cl 
inner join tb_empresas as e 
on cl.id_empresa=e.id_empresa 
where id_cliente = '$id_clienteemp_get'";
$query_clientesemp = $pdo->prepare($sql_clientesemp);
$query_clientesemp->execute();
$clientesemp_datos = $query_clientesemp->fetchAll(PDO::FETCH_ASSOC);

foreach ($clientesemp_datos as $clientesemp_datos) {
    $idCliente = $clientesemp_datos['id_cliente'];
    $cuit = $clientesemp_datos['cuit'];
    $nombre = $clientesemp_datos['nombre'];
    $razon_social = $clientesemp_datos['razon_social'];
    $telefono = $clientesemp_datos['telefono'];
    $email = $clientesemp_datos['email'];
    $persona_autorizada = $clientesemp_datos['persona_autorizada'];
}

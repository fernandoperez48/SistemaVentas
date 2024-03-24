<?php


$sql_clientesemp = "SELECT cl.id_cliente, cl.saldo, 
e.cuit, e.nombre, e.razon_social, e.telefono, e.email, e.persona_autorizada, e.id_domicilio
FROM tb_clientes as cl 
inner join tb_empresas as e 
on cl.id_empresa=e.id_empresa";
$query_clientesemp = $pdo->prepare($sql_clientesemp);
$query_clientesemp->execute();
$clientesemp_datos = $query_clientesemp->fetchAll(PDO::FETCH_ASSOC);

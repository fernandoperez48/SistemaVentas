<?php


$sql_clientesper = "SELECT cl.id_cliente, cl.saldo, 
p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio
FROM tb_clientes as cl 
inner join tb_personas as p 
on cl.id_persona=p.id_persona";
$query_clientesper = $pdo->prepare($sql_clientesper);
$query_clientesper->execute();
$clientesper_datos = $query_clientesper->fetchAll(PDO::FETCH_ASSOC);

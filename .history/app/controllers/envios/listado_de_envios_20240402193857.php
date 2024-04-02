<?php


$sql_envios ="SELECT e.IdVenta,e.IdCliente, e.Direccion, e.estado,c.nombre
FROM tb_envios as e
inner Join tb_cliente as c on c.id_cliente = e.IdCliente";
$query_envios= $pdo->prepare($sql_envios);
$query_envios->execute();
$envios_datos=$query_envios->fetchAll(PDO::FETCH_ASSOC);
?>

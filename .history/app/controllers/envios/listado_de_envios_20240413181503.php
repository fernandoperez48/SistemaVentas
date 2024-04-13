<?php


$sql_envios ="SELECT e.IdVenta,emp.nombre, e.Direccion, e.estado,c.id_persona,v.total_pagado
FROM tb_envios as e
inner Join tb_clientes as c on c.id_cliente = e.IdCliente
INNER JOIN tb_empresas AS emp ON c.id_empresa = emp.id_empresa 
inner Join tb_ventas as v on e.idVenta = v.id_venta";
$query_envios= $pdo->prepare($sql_envios);
$query_envios->execute();
$envios_datos=$query_envios->fetchAll(PDO::FETCH_ASSOC);
?>

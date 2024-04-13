<?php


$sql_envios ="SELECT e.IdVenta,COALESCE(emp.nombre, p.nombre) AS nombre, e.Direccion, e.estado,c.id_persona,v.total_pagado,v.nro_venta,v.fyh_creacion
FROM tb_envios as e
inner Join tb_clientes as c on c.id_cliente = e.IdCliente
left JOIN tb_empresas AS emp ON c.id_empresa = emp.id_empresa
left JOIN tb_personas AS p ON c.id_persona = p.id_persona 
inner Join tb_ventas as v on e.idVenta = v.id_venta";
$query_envios= $pdo->prepare($sql_envios);
$query_envios->execute();
$envios_datos=$query_envios->fetchAll(PDO::FETCH_ASSOC);
?>

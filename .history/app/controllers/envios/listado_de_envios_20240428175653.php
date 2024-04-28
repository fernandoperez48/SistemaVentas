<?php


$sql_envios ="SELECT e.IdVenta,COALESCE(emp.nombre, p.nombre) AS nombre,COALESCE(emp.razon_social, p.apellido) AS apellido, e.Direccion, e.estado,c.id_persona,v.total_pagado,v.nro_venta,v.fyh_creacion,d.calle,d.numero
FROM tb_envios as e
inner Join tb_clientes as c on c.id_cliente = e.IdCliente
left JOIN tb_empresas AS emp ON c.id_empresa = emp.id_empresa
left JOIN tb_personas AS p ON c.id_persona = p.id_persona 
inner Join tb_ventas as v on e.idVenta = v.nro_venta
inner Join tb_domicilios as d on d.id_domicilio = emp.id_domicilio or d.id_domicilio = p.id_domicilio";
$query_envios= $pdo->prepare($sql_envios);
$query_envios->execute();
$envios_datos=$query_envios->fetchAll(PDO::FETCH_ASSOC);
?>

<?php


$sql_envios ="SELECT e.IdVenta,e.IdCliente, e.Direccion, e.estado,c.nombre--,f.totalfactura,f.Fecha
FROM envios as e
inner Join tb_cliente as c on c.id_cliente = e.IdCliente
--inner join tb_factura as f on f.nofactura = e.IdVenta";
$query_productos= $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos=$query_productos->fetchAll(PDO::FETCH_ASSOC);
?>

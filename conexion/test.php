<?php
require('conexion.php');

$data=new Conexion();
$conexion=$data->conect();
$strquery="SELECT
    v.nro_venta,
    p.nombre AS nombre_cliente,
    v.fyh_creacion,
    a.nombre AS nombre_producto,
    c.cantidad,
    a.precio_venta,
    (c.cantidad * a.precio_venta) AS subtotal
FROM
    tb_ventas v
INNER JOIN tb_clientes cl ON v.id_cliente = cl.id_cliente
INNER JOIN tb_personas p ON cl.id_persona = p.id_persona
INNER JOIN tb_carrito c ON v.nro_venta = c.nro_venta
INNER JOIN tb_almacen a ON c.id_producto = a.id_producto
WHERE
    v.nro_venta = 1  -- Reemplaza por el número de venta específico
ORDER BY
    a.nombre";
$result= $conexion->prepare($strquery);
$result->execute();
$data = $result->fetchall(PDO::FETCH_ASSOC);

var_dump($data);
?>
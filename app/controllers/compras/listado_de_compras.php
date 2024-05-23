<?php

$sql_compras = "SELECT *,
                pro.codigo as codigo, pro.nombre as nombre_producto, pro.descripcion as descripcion, 
                pro.stock as stock, pro.stock_minimo as stock_minimo, pro.stock_maximo as stock_maximo, 
                pro.precio_compra as precio_compra_producto, pro.precio_venta as precio_venta_producto, 
                pro.imagen as imagen,

                cat.nombre_categoria as nombre_categoria, 

                us.nombres as nombre_usuarios_producto,
                pr.nombre_proveedor as nombre_proveedor, pr.celular as celular_proveedor, pr.telefono as telefono_proveedor, 
                pr.email as email_proveedor, pr.empresa as empresa_proveedor,
                us.nombres as nombres_usuario
                FROM tb_compras as co 
                INNER JOIN tb_almacen as pro ON co.id_producto = pro.id_producto 
                INNER JOIN tb_acategorias as cat ON cat.id_categoria = pro.id_categoria
                INNER JOIN tb_usuarios as us ON co.id_usuario = us.id_usuarios 
                INNER JOIN tb_proveedores as pr ON co.id_proveedor = pr.id_proveedor";

$result_compras = $mysqli->query($sql_compras);

$compras_datos = [];

if ($result_compras) {
    while ($row = $result_compras->fetch_assoc()) {
        $compras_datos[] = $row;
    }
}

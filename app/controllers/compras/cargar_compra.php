<?php

$id_compra_get = $_GET['id'];

$sql_compras = "SELECT *,
                pro.codigo as codigo, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.stock as stock, pro.stock_minimo as stock_minimo, pro.stock_maximo as stock_maximo, pro.precio_compra as precio_compra_producto, pro.precio_venta as precio_venta_producto, pro.fecha_ultimo_ingreso as fecha_ultimo_ingreso, pro.imagen as imagen,
                cat.nombre_categoria as nombre_categoria, us.nombres as nombre_usuarios_producto,
                pr.nombre_proveedor as nombre_proveedor, pr.celular as celular_proveedor, pr.telefono as telefono_proveedor, pr.direccion as direccion_proveedor, pr.email as email_proveedor, pr.empresa as empresa_proveedor, us.nombres as nombres_usuario
                FROM tb_compras as co 
                INNER JOIN tb_almacen as pro ON co.id_producto = pro.id_producto 
                INNER JOIN tb_acategorias as cat ON cat.id_categoria = pro.id_categoria
                INNER JOIN tb_usuarios as us ON co.id_usuario = us.id_usuarios 
                INNER JOIN tb_proveedores as pr ON co.id_proveedor = pr.id_proveedor
                WHERE co.id_compra = '$id_compra_get'";

$result_compras = $mysqli->query($sql_compras);

$compras_datos = array();

while ($row = $result_compras->fetch_assoc()) {
    $compras_datos[] = $row;
}

foreach ($compras_datos as $compras_datos) {
    $nro_compra = $compras_datos['nro_compra'];
    $id_compra = $compras_datos['id_compra'];
    $id_producto = $compras_datos['id_producto'];
    $id_proveedor_tabla = $compras_datos['id_proveedor'];
    $codigo = $compras_datos['codigo'];
    $nombre_categoria = $compras_datos['nombre_categoria'];
    $nombre_producto = $compras_datos['nombre_producto'];
    $nombre_usuarios_producto = $compras_datos['nombre_usuarios_producto'];
    $descripcion = $compras_datos['descripcion'];
    $stock = $compras_datos['stock'];
    $stock_minimo = $compras_datos['stock_minimo'];
    $stock_maximo = $compras_datos['stock_maximo'];
    $precio_compra_producto = $compras_datos['precio_compra_producto'];
    $precio_venta_producto = $compras_datos['precio_venta_producto'];
    $fecha_ingreso = $compras_datos['fecha_ingreso'];
    $imagen = $compras_datos['imagen'];
    $nombre_proveedor_tabla = $compras_datos['nombre_proveedor'];
    $celular_proveedor = $compras_datos['celular_proveedor'];
    $telefono_proveedor = $compras_datos['telefono_proveedor'];
    $direccion_proveedor = $compras_datos['direccion_proveedor'];
    $email_proveedor = $compras_datos['email_proveedor'];
    $empresa_proveedor = $compras_datos['empresa_proveedor'];
    $fecha_compra = $compras_datos['fecha_compra'];
    $comprobante = $compras_datos['comprobante'];
    $cantidad = $compras_datos['cantidad'];
    $precio_compra = $compras_datos['precio_compra'];
}

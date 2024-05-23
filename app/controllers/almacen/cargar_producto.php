<?php

$id_producto_get = $_GET['id'];

$sql_productos = "SELECT a.id_producto as id_producto,a.codigo as codigo,a.nombre as nombre,
a.descripcion as descripcion,a.stock as stock,a.stock_minimo as stock_minimo,a.stock_maximo as stock_maximo,
a.precio_compra as precio_compra,a.precio_venta as precio_venta,a.fecha_ultimo_ingreso as fecha_ultimo_ingreso,
a.imagen as imagen,cat.nombre_categoria as nombre_categoria, u.email as email, u.id_usuarios as id_usuario
FROM tb_almacen as a 
INNER JOIN tb_acategorias as cat on a.id_categoria=cat.id_categoria
INNER JOIN tb_usuarios as u on a.id_usuario=u.id_usuarios
WHERE id_producto='$id_producto_get'";

$result = $mysqli->query($sql_productos);

if ($result) {
    $productos_datos = $result->fetch_assoc();

    $codigo = $productos_datos['codigo'];
    $nombre_categoria = $productos_datos['nombre_categoria'];
    $nombre = $productos_datos['nombre'];
    $email = $productos_datos['email'];
    $id_usuario = $productos_datos['id_usuario'];
    $descripcion = $productos_datos['descripcion'];
    $stock = $productos_datos['stock'];
    $stock_minimo = $productos_datos['stock_minimo'];
    $stock_maximo = $productos_datos['stock_maximo'];
    $precio_compra = $productos_datos['precio_compra'];
    $precio_venta = $productos_datos['precio_venta'];
    $fecha_ingreso = $productos_datos['fecha_ingreso'];
    $imagen = $productos_datos['imagen'];
}

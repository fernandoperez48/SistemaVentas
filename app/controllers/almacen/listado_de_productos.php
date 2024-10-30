<?php

$sql_productos = "SELECT a.id_producto as id_producto,a.codigo as codigo,a.nombre as nombre,
a.descripcion as descripcion,a.stock as stock,a.stock_minimo as stock_minimo,a.stock_maximo as stock_maximo,
a.precio_compra as precio_compra,a.precio_venta as precio_venta,a.fecha_ultimo_ingreso as fecha_ultimo_ingreso,
a.fecha_carga as fecha_carga,a.imagen as imagen, a.talle as talle, a.color as color, cat.nombre_categoria as nombre_categoria,
u.nombres as nombres_usuario, pro.nombre_proveedor as nombre_proveedor, u.email as email
FROM tb_almacen as a 
INNER JOIN tb_acategorias as cat ON a.id_categoria=cat.id_categoria
INNER JOIN tb_proveedores as pro ON a.id_proveedor=pro.id_proveedor
INNER JOIN tb_usuarios as u ON a.id_usuario=u.id_usuarios";

$productos_datos = $mysqli->query($sql_productos)->fetch_all(MYSQLI_ASSOC);

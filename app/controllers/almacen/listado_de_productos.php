<?php

$sql_productos = "SELECT a.id_producto as id_producto,a.codigo as codigo,a.nombre as nombre,
a.descripcion as descripcion,a.stock as stock,a.stock_minimo as stock_minimo,a.stock_maximo as stock_maximo,
a.precio_compra as precio_compra,a.precio_venta as precio_venta,a.fecha_ultimo_ingreso as fecha_ultimo_ingreso,
a.fecha_carga as fecha_carga,a.imagen as imagen,cat.nombre_categoria as nombre_categoria,
<<<<<<< HEAD
 u.nombres as nombres_usuario
 
FROM tb_almacen as a inner join tb_acategorias as cat on a.id_categoria=cat.id_categoria
inner join tb_usuarios as u on a.id_usuario=u.id_usuarios";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);
=======
u.nombres as nombres_usuario
FROM tb_almacen as a 
INNER JOIN tb_acategorias as cat ON a.id_categoria=cat.id_categoria
INNER JOIN tb_usuarios as u ON a.id_usuario=u.id_usuarios";

$productos_datos = $mysqli->query($sql_productos)->fetch_all(MYSQLI_ASSOC);
>>>>>>> 04d44838cbe1dee6bbddc9ca45e77956bafeb114

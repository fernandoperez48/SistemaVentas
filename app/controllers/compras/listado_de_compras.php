<?php
$sql_compras = "SELECT *,
pro.codigo as codigo, pro.nombre as nombre_producto, pro.descripcion as descripcion, 
pro.stock as stock, pro.stock_minimo as stock_minimo, pro.stock_maximo as stock_maximo, 
pro.precio_compra as precio_compra_producto, pro.precio_venta as precio_venta_producto, 
pro.imagen as imagen,

cat.nombre_categoria as nombre_categoria, 

us.nombres as nombre_usuarios_producto,
pr.nombre_proveedor as nombre_proveedor, pr.celular as celular_proveedor, pr.telefono as telefono_proveedor, 
pr.direccion as direccion_proveedor, pr.email as email_proveedor, pr.empresa as empresa_proveedor,
us.nombres as nombres_usuario
from tb_compras as co 
inner join tb_almacen as pro on co.id_producto = pro.id_producto 
inner join tb_acategorias as cat on cat.id_categoria = pro.id_categoria
inner join tb_usuarios as us on co.id_usuario = us.id_usuarios 
inner join tb_proveedores as pr on co.id_proveedor = pr.id_proveedor";


$query_compras = $pdo->prepare($sql_compras);
$query_compras->execute();
$compras_datos = $query_compras->fetchAll(PDO::FETCH_ASSOC);

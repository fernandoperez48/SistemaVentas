<?php
function ListarProductosXProveedor($mysqli, $id_proveedorDelSelect)
{
    if (empty($id_proveedorDelSelect)) {
        // Maneja el caso en que $id_proveedorDelSelect esté vacío
        return [];
    }

    $query = "SELECT a.id_producto as id_producto, a.codigo as codigo, a.nombre as nombre,
    a.descripcion as descripcion, a.stock as stock, a.stock_minimo as stock_minimo, a.stock_maximo as stock_maximo,
    a.precio_compra as precio_compra, a.precio_venta as precio_venta, a.fecha_ultimo_ingreso as fecha_ultimo_ingreso,
    a.fecha_carga as fecha_carga, a.imagen as imagen, cat.nombre_categoria as nombre_categoria,
    u.nombres as nombres_usuario
FROM tb_almacen as a
INNER JOIN tb_acategorias as cat ON a.id_categoria = cat.id_categoria
INNER JOIN tb_usuarios as u ON a.id_usuario = u.id_usuarios
where a.id_proveedor = $id_proveedorDelSelect";

    //echo 'Consulta SQL: ' . $query . '<br>'; // Depuración

    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($mysqli));
    }

    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }

    return $productos;
}

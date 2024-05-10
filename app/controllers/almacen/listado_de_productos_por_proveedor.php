<?php

// Verificar si el parámetro id_proveedor está presente en la solicitud POST
if (isset($_POST['id_proveedor'])) {

    // Asignar el valor del parámetro id_proveedor a una variable

    $id_proveedor = $_POST['id_proveedor'];
    // Agregar una salida para verificar si se recibió el valor correctamente
    echo "El valor de id_proveedor es: " . $id_proveedor;

    $sql_productosXproveedor = "SELECT *, cat.nombre_categoria as nombre_categoria
    from tb_almacen as pro
    inner join tb_acategorias as cat on cat.id_categoria = pro.id_categoria

    where pro.id_proveedor = $id_proveedor";


    $query_productosXproveedor = $pdo->prepare($sql_productosXproveedor);
    $query_productosXproveedor->execute();
    $productosXproveedor_datos = $query_productosXproveedor->fetchAll(PDO::FETCH_ASSOC);
}

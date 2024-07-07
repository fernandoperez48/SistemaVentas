<?php

$sql_compras = "SELECT *,
                pr.nombre_proveedor as nombre_proveedor, usu.nombres as nombre_usuario
                FROM tb_compras as co 
                INNER JOIN tb_usuarios as usu ON usu.id_usuarios = co.id_usuario                                                                    
                INNER JOIN tb_proveedores as pr where co.id_proveedor = pr.id_proveedor";


$result_compras = $mysqli->query($sql_compras);

$compras_datos = [];

if ($result_compras) {
    while ($row = $result_compras->fetch_assoc()) {
        $compras_datos[] = $row;
    }
}

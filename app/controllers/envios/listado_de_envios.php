<?php

$sql_envios = "SELECT e.IdVenta,COALESCE(emp.nombre, p.nombre) AS nombre,COALESCE(emp.razon_social, p.apellido) AS apellido, e.Direccion, e.nombre_usuario as nombre_usuario, e.estado,c.id_persona,v.total_pagado,v.nro_venta,v.fyh_creacion,d.calle,d.numero
               FROM tb_envios as e
               INNER JOIN tb_clientes as c ON c.id_cliente = e.IdCliente
               LEFT JOIN tb_empresas AS emp ON c.id_empresa = emp.id_empresa
               LEFT JOIN tb_personas AS p ON c.id_persona = p.id_persona 
               INNER JOIN tb_ventas as v ON e.idVenta = v.nro_venta
               INNER JOIN tb_domicilios as d ON d.id_domicilio = emp.id_domicilio OR d.id_domicilio = p.id_domicilio";

$result_envios = $mysqli->query($sql_envios);

$envios_datos = [];

if ($result_envios) {
    while ($row = $result_envios->fetch_assoc()) {
        $envios_datos[] = $row;
    }
}

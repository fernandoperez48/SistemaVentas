<?php

$sql_ventas = "SELECT *,cl.id_cliente as id_cliente, COALESCE(emp.nombre, p.nombre) AS nombre,COALESCE(emp.razon_social, p.apellido) AS apellido, 
COALESCE(emp.telefono, p.telefono) AS telefono, COALESCE(emp.cuit, p.dni) AS cuitDni, COALESCE(emp.email, p.email) AS email, emp.persona_autorizada,
d.calle,d.numero,d.ciudad,d.provincia,d.pais, d.piso, d.depto
               FROM tb_ventas as ve 
               INNER JOIN tb_clientes as cl ON cl.id_cliente=ve.id_cliente
               LEFT JOIN tb_empresas AS emp ON cl.id_empresa = emp.id_empresa
               LEFT JOIN tb_personas AS p ON cl.id_persona = p.id_persona 
               INNER JOIN tb_domicilios AS d ON COALESCE(emp.id_domicilio, p.id_domicilio) = d.id_domicilio  
               WHERE ve.estado != 'anulada'        
               GROUP BY ve.nro_venta";

$result_ventas = $mysqli->query($sql_ventas);

$ventas_datos = [];

if ($result_ventas) {
    while ($row = $result_ventas->fetch_assoc()) {
        $ventas_datos[] = $row;
    }
}

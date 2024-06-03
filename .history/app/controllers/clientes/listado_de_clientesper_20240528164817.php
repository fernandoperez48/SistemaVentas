<?php

$sql_clientesper = "SELECT cl.id_cliente, cl.saldo, 
                    p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio,d.calle,d.numero,d.ciudad,d.provincia,d.pais, d.piso, d.depto
                    FROM tb_clientes as cl 
                    INNER JOIN tb_personas as p 
                    ON cl.id_persona=p.id_persona
                    INNER JOIN tb_domicilios as d ON d.id_domicilio=p.id_domicilio";

$result_clientesper = $mysqli->query($sql_clientesper);

$clientesper_datos = [];

if ($result_clientesper) {
    while ($row = $result_clientesper->fetch_assoc()) {
        $clientesper_datos[] = $row;
    }
}

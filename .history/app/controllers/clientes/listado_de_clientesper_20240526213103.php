<?php

$sql_clientesper = "SELECT cl.id_cliente, cl.saldo, 
                    p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio
                    FROM tb_clientes as cl 
                    INNER JOIN tb_personas as p 
                    ON cl.id_persona=p.id_persona";

$result_clientesper = $mysqli->query($sql_clientesper);

$clientesper_datos = [];

if ($result_clientesper) {
    while ($row = $result_clientesper->fetch_assoc()) {
        $clientesper_datos[] = $row;
    }
}

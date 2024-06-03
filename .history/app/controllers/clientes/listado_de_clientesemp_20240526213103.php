<?php

$sql_clientesemp = "SELECT cl.id_cliente, cl.saldo, 
                    e.cuit, e.nombre, e.razon_social, e.telefono, e.email, e.persona_autorizada, e.id_domicilio
                    FROM tb_clientes as cl 
                    INNER JOIN tb_empresas as e 
                    ON cl.id_empresa=e.id_empresa";

$result_clientesemp = $mysqli->query($sql_clientesemp);

$clientesemp_datos = [];

if ($result_clientesemp) {
    while ($row = $result_clientesemp->fetch_assoc()) {
        $clientesemp_datos[] = $row;
    }
}

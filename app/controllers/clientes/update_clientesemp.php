<?php

$id_clienteemp_get = $_GET['id'];
$sql_clientesemp = "SELECT cl.id_cliente, e.id_empresa, e.cuit, e.nombre, e.razon_social, e.telefono, e.email, e.id_domicilio, e.persona_autorizada, d.calle, d.numero, d.piso, d.depto 
                    FROM tb_clientes AS cl 
                    INNER JOIN tb_empresas AS e 
                    ON cl.id_empresa = e.id_empresa 
                    INNER JOIN tb_domicilios AS d 
                    ON e.id_domicilio = d.id_domicilio 
                    WHERE cl.id_cliente = '$id_clienteemp_get'";

$resultado_clientesemp = $mysqli->query($sql_clientesemp);

$clientesemp_datos = array();

while ($fila = $resultado_clientesemp->fetch_assoc()) {
    $clientesemp_datos[] = $fila;
}

foreach ($clientesemp_datos as $clientesemp_datos) {
    $idCliente = $clientesemp_datos['id_cliente'];
    $idEmpresa = $clientesemp_datos['id_empresa'];
    $cuit = $clientesemp_datos['cuit'];
    $nombre = $clientesemp_datos['nombre'];
    $razon_social = $clientesemp_datos['razon_social'];
    $telefono = $clientesemp_datos['telefono'];
    $email = $clientesemp_datos['email'];
    $persona_autorizada = $clientesemp_datos['persona_autorizada'];
    $calle = $clientesemp_datos['calle'];
    $numero = $clientesemp_datos['numero'];
    $piso = $clientesemp_datos['piso'];
    $depto = $clientesemp_datos['depto'];
}

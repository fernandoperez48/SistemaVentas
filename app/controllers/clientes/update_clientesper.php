
<?php

$id_clienteper_get = $_GET['id'];
$sql_clientesper = "SELECT cl.id_cliente, p.id_persona, p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio, d.calle, d.numero, d.piso, d.depto 
                    FROM tb_clientes AS cl 
                    INNER JOIN tb_personas AS p 
                    ON cl.id_persona = p.id_persona 
                    INNER JOIN tb_domicilios AS d 
                    ON p.id_domicilio = d.id_domicilio 
                    WHERE cl.id_cliente = '$id_clienteper_get'";

$resultado_clientesper = $mysqli->query($sql_clientesper);

$clientesper_datos = array();

while ($fila = $resultado_clientesper->fetch_assoc()) {
    $clientesper_datos[] = $fila;
}

// El bucle foreach se mantiene sin cambios
foreach ($clientesper_datos as $cliente) {
    $idCliente = $cliente['id_cliente'];
    $idPersona = $cliente['id_persona'];
    $dni = $cliente['dni'];
    $nombre = $cliente['nombre'];
    $apellido = $cliente['apellido'];
    $telefono = $cliente['telefono'];
    $email = $cliente['email'];
    $calle = $cliente['calle'];
    $numero = $cliente['numero'];
    $piso = $cliente['piso'];
    $depto = $cliente['depto'];
}

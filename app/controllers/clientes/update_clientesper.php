
<?php


$id_clienteper_get = $_GET['id'];
$sql_clientesper = "SELECT cl.id_cliente, p.id_persona, p.dni, p.nombre, p.apellido, p.telefono, p.email, p.id_domicilio, d.calle, d.numero, d.piso, d.depto 
FROM tb_clientes AS cl 
INNER JOIN tb_personas AS p 
ON cl.id_persona = p.id_persona 
INNER JOIN tb_domicilios AS d 
ON p.id_domicilio = d.id_domicilio 
WHERE cl.id_cliente = '$id_clienteper_get'";

$query_clientesper = $pdo->prepare($sql_clientesper);
$query_clientesper->execute();
$clientesper_datos = $query_clientesper->fetchAll(PDO::FETCH_ASSOC);

foreach ($clientesper_datos as $clientesper_datos) {
    $idCliente = $clientesper_datos['id_cliente'];
    $idPersona = $clientesper_datos['id_persona'];
    $dni = $clientesper_datos['dni'];
    $nombre = $clientesper_datos['nombre'];
    $apellido = $clientesper_datos['apellido'];
    $telefono = $clientesper_datos['telefono'];
    $email = $clientesper_datos['email'];
    $calle = $clientesper_datos['calle'];
    $numero = $clientesper_datos['numero'];
    $piso = $clientesper_datos['piso'];
    $depto = $clientesper_datos['depto'];
}

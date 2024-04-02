<?php
include '../../config.php';

$nombreper = $_POST['nombreper'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefonoper = $_POST['telefonoper'];
$emailper = $_POST['emailper'];
$calleper = $_POST['calleper'];
$numeroper = $_POST['numeroper'];
$pisoper = $_POST['pisoper'];
$deptoper = $_POST['deptoper'];


if (!empty($nombreper) && !empty($apellido) && !empty($dni) && !empty($telefonoper) && !empty($emailper)) {

    // sentencia personas
    $sentenciaper = $pdo->prepare("INSERT INTO tb_personas(nombre, apellido, dni, email, telefono ) 
    VALUES (:nombre,:apellido,:dni,:email,:telefono)");

    $sentenciaper->bindParam('nombre', $nombreper);
    $sentenciaper->bindParam('apellido', $apellido);
    $sentenciaper->bindParam('dni', $dni);
    $sentenciaper->bindParam('email', $emailper);
    $sentenciaper->bindParam('telefono', $telefonoper);
    $sentenciaper->execute();

    $id_persona = $pdo->lastInsertId();

    // Sentencia crear el cliente
    $sentencia_agrega_cliente = $pdo->prepare("INSERT INTO tb_clientes(id_persona) 
    VALUES (:id_persona);");

    $sentencia_agrega_cliente->bindParam('id_persona', $id_persona);
    $sentencia_agrega_cliente->execute();

    // sentencia domicilio 
    $sentenciadom = $pdo->prepare("INSERT INTO tb_domicilios(calle,numero,piso,depto) 
    VALUES (:calle,:numero,:piso,:depto);");

    $sentenciadom->bindParam('calle', $calleper);
    $sentenciadom->bindParam('numero', $numeroper);
    $sentenciadom->bindParam('piso', $pisoper);
    $sentenciadom->bindParam('depto', $deptoper);
    $sentenciadom->execute();

    $id_domicilio = $pdo->lastInsertId();

    // Sentencia id_domicilio de tabla persona
    // Sentencia para actualizar el campo id_domicilio en la tabla tb_personas
    $sentencia_id_domicilio = $pdo->prepare("UPDATE tb_personas SET id_domicilio = :id_domicilio WHERE id_persona = :id_persona");

    // Vincular los parámetros
    $sentencia_id_domicilio->bindParam(':id_domicilio', $id_domicilio);
    $sentencia_id_domicilio->bindParam(':id_persona', $id_persona);

    // Ejecutar la sentencia
    $sentencia_id_domicilio->execute();

    session_start();
    $_SESSION['mensaje'] = "Se creo el cliente correctamente";
    $_SESSION['icono'] = "success";

    header('location: ' . $URL . 'clientes/indexper.php');
} else {
    //echo "Hay un campo vacio";
    session_start();
    $_SESSION['mensaje'] = "Hay campos vacios";
    header('location: ' . $URL . 'clientes/createper.php');
}

<?php
include '../../config.php';

$nombreemp = $_POST['nombreemp'];
$razon_social = $_POST['razon_social'];
$cuit = $_POST['cuit'];
$telefonoemp = $_POST['telefonoemp'];
$emailemp = $_POST['emailemp'];
$persona_autorizada = $_POST['persona_autorizada'];
$calleemp = $_POST['calleemp'];
$numeroemp = $_POST['numeroemp'];
$pisoemp = $_POST['pisoemp'];
$deptoemp = $_POST['deptoemp'];


if (!empty($nombreemp) && !empty($razon_social) && !empty($cuit) && !empty($telefonoemp) && !empty($emailemp) && !empty($persona_autorizada)) {

    // sentencia empresas
    $sentenciaemp = $pdo->prepare("INSERT INTO tb_empresas(cuit,nombre,razon_social,telefono,email, persona_autorizada) 
    VALUES (:cuit,:nombre,:razon_social,:telefono,:email,:persona_autorizada);");

    $sentenciaemp->bindParam('cuit', $cuit);
    $sentenciaemp->bindParam('nombre', $nombreemp);
    $sentenciaemp->bindParam('razon_social', $razon_social);
    $sentenciaemp->bindParam('telefono', $telefonoemp);
    $sentenciaemp->bindParam('email', $emailemp);
    $sentenciaemp->bindParam('persona_autorizada', $persona_autorizada);
    $sentenciaemp->execute();

    $id_empresa = $pdo->lastInsertId();

    // Sentencia crear el cliente
    $sentencia_agrega_cliente = $pdo->prepare("INSERT INTO tb_clientes(id_empresa) 
    VALUES (:id_empresa);");

    $sentencia_agrega_cliente->bindParam('id_empresa', $id_empresa);
    $sentencia_agrega_cliente->execute();

    // sentencia domicilio 
    $sentenciadom = $pdo->prepare("INSERT INTO tb_domicilios(calle,numero,piso,depto) 
    VALUES (:calle,:numero,:piso,:depto);");

    $sentenciadom->bindParam('calle', $calleemp);
    $sentenciadom->bindParam('numero', $numeroemp);
    $sentenciadom->bindParam('piso', $pisoemp);
    $sentenciadom->bindParam('depto', $deptoemp);
    $sentenciadom->execute();

    $id_domicilio = $pdo->lastInsertId();

    // Sentencia id_domicilio de tabla empresa
    // Sentencia para actualizar el campo id_domicilio en la tabla tb_empresas
    $sentencia_id_domicilio = $pdo->prepare("UPDATE tb_empresas SET id_domicilio = :id_domicilio WHERE id_empresa = :id_empresa");

    // Vincular los parámetros
    $sentencia_id_domicilio->bindParam(':id_domicilio', $id_domicilio);
    $sentencia_id_domicilio->bindParam(':id_empresa', $id_empresa);

    // Ejecutar la sentencia
    $sentencia_id_domicilio->execute();

    session_start();
    $_SESSION['mensaje'] = "Se creo el cliente correctamente";
    $_SESSION['icono'] = "success";

    header('location: ' . $URL . 'clientes/indexemp.php');
} else {
    //echo "Hay un campo vacio";
    session_start();
    $_SESSION['mensaje'] = "Hay campos vacios";
    header('location: ' . $URL . 'clientes/createemp.php');
}

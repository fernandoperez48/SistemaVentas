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
    // Inserción en tb_empresas
    $sql_empresas = "INSERT INTO tb_empresas(cuit, nombre, razon_social, telefono, email, persona_autorizada) 
                     VALUES ('$cuit', '$nombreemp', '$razon_social', '$telefonoemp', '$emailemp', '$persona_autorizada')";
    $mysqli->query($sql_empresas);
    $id_empresa = $mysqli->insert_id;

    // Inserción en tb_clientes
    $sql_clientes = "INSERT INTO tb_clientes(id_empresa) VALUES ('$id_empresa')";
    $mysqli->query($sql_clientes);

    // Inserción en tb_domicilios
    $sql_domicilios = "INSERT INTO tb_domicilios(calle, numero, piso, depto) 
                       VALUES ('$calleemp', '$numeroemp', '$pisoemp', '$deptoemp')";
    $mysqli->query($sql_domicilios);
    $id_domicilio = $mysqli->insert_id;

    // Actualización de tb_empresas con el id_domicilio
    $sql_update_empresa = "UPDATE tb_empresas SET id_domicilio = '$id_domicilio' WHERE id_empresa = '$id_empresa'";
    $mysqli->query($sql_update_empresa);

    session_start();
    $_SESSION['mensaje'] = "Se creó el cliente correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'clientes/indexemp.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Hay campos vacíos";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'clientes/createemp.php');
}

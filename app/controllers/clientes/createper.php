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
    // Inserción en tb_personas
    $sql_personas = "INSERT INTO tb_personas(nombre, apellido, dni, email, telefono) 
                     VALUES ('$nombreper', '$apellido', '$dni', '$emailper', '$telefonoper')";
    $mysqli->query($sql_personas);
    $id_persona = $mysqli->insert_id;

    // Inserción en tb_clientes
    $sql_clientes = "INSERT INTO tb_clientes(id_persona) VALUES ('$id_persona')";
    $mysqli->query($sql_clientes);

    // Inserción en tb_domicilios
    $sql_domicilios = "INSERT INTO tb_domicilios(calle, numero, piso, depto) 
                       VALUES ('$calleper', '$numeroper', '$pisoper', '$deptoper')";
    $mysqli->query($sql_domicilios);
    $id_domicilio = $mysqli->insert_id;

    // Actualización de tb_personas con el id_domicilio
    $sql_update_persona = "UPDATE tb_personas SET id_domicilio = '$id_domicilio' WHERE id_persona = '$id_persona'";
    $mysqli->query($sql_update_persona);

    session_start();
    $_SESSION['mensaje'] = "Se creó el cliente correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'clientes/indexper.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Hay campos vacíos";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'clientes/createper.php');
}

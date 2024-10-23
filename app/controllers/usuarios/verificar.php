<?php
include '../../config.php';

// Obtener los valores desde la solicitud GET
$nombre_usuario = $_GET['nombre_usuario'];
$email = $_GET['email'];

// Inicializar las variables para los mensajes de error
$duplicados = [];

// Verificar si ya existe un usuario con el mismo nombre_usuario
$sql_verificar_nombre = "SELECT * FROM tb_usuarios WHERE nombres = '$nombre_usuario'";
$result_nombre = $mysqli->query($sql_verificar_nombre);
if ($result_nombre->num_rows > 0) {
    $duplicados[] = 'nombre de usuario';
}

// Verificar si ya existe un usuario con el mismo email
$sql_verificar_email = "SELECT * FROM tb_usuarios WHERE email = '$email'";
$result_email = $mysqli->query($sql_verificar_email);
if ($result_email->num_rows > 0) {
    $duplicados[] = 'email';
}

// Preparar el mensaje de respuesta
if (!empty($duplicados)) {
    $mensaje = "Ya existe un usuario con igual " . implode(", ", $duplicados) . ".";
    echo json_encode([
        'status' => 'error',
        'message' => $mensaje
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'message' => 'No existe un usuario con el mismo nombre o email.'
    ]);
}









// // Verificar si ya existe un usuario con el mismo nombre_usuario
// $sql_verificar_nombre = "SELECT * FROM tb_usuarios WHERE nombres= ?";
// $stmt_nombre = $mysqli->prepare($sql_verificar_nombre);
// $stmt_nombre->bind_param('s', $nombre_usuario);
// $stmt_nombre->execute();
// $result_nombre = $stmt_nombre->get_result();
// if ($result_nombre->num_rows > 0) {
//     $duplicados[] = 'nombre de usuario';
// }

// // Verificar si ya existe un usuario con la misma email
// $sql_verificar_email = "SELECT * FROM tb_usuarios WHERE email = ?";
// $stmt_email = $mysqli->prepare($sql_verificar_email);
// $stmt_email->bind_param('s', $email);
// $stmt_email->execute();
// $result_email = $stmt_email->get_result();
// if ($result_email->num_rows > 0) {
//     $duplicados[] = 'email';
// }

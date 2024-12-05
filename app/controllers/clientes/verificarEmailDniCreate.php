<?php
// Incluir el archivo de configuración
include '../../config.php';  // Asegúrate de que el path sea correcto

$email = $_POST['email'] ?? '';
$dni = $_POST['dni'] ?? '';

// Respuesta inicial
$response = ['email_exists' => false, 'dni_exists' => false];

// Verificar si el email ya existe en tb_personas
if (!empty($email)) {
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_personas WHERE email = ?");
    $query->bind_param('s', $email); // 's' indica que es un string
    $query->execute();
    $query->bind_result($email_exists);
    $query->fetch();
    $response['email_exists'] = $email_exists > 0; // Si hay más de 0, significa que ya existe
    $query->close();
}

// Verificar si el DNI ya existe en tb_personas
if (!empty($dni)) {
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_personas WHERE dni = ?");
    $query->bind_param('s', $dni); // 's' indica que es un string
    $query->execute();
    $query->bind_result($dni_exists);
    $query->fetch();
    $response['dni_exists'] = $dni_exists > 0; // Si hay más de 0, significa que ya existe
    $query->close();
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

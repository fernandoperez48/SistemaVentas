<?php
// Incluir el archivo de configuración
include '../../config.php';  // Asegúrate de que el path sea correcto

$email = $_POST['email'] ?? '';
$cuit = $_POST['cuit'] ?? '';

// Respuesta inicial
$response = ['email_exists' => false, 'cuit_exists' => false];

// Verificar si el email ya existe en tb_personas
if (!empty($email)) {
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_empresas WHERE email = ?");
    $query->bind_param('s', $email); // 's' indica que es un string
    $query->execute();
    $query->bind_result($email_exists);
    $query->fetch();
    $response['email_exists'] = $email_exists > 0; // Si hay más de 0, significa que ya existe
    $query->close();
}

// Verificar si el DNI ya existe en tb_personas
if (!empty($cuit)) {
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_empresas WHERE cuit = ?");
    $query->bind_param('s', $cuit); // 's' indica que es un string
    $query->execute();
    $query->bind_result($cuit_exists);
    $query->fetch();
    $response['cuit_exists'] = $cuit_exists > 0; // Si hay más de 0, significa que ya existe
    $query->close();
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

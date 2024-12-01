<?php
// Incluir el archivo de configuración
include '../../config.php';  // Asegúrate de que el path sea correcto

$email = $_POST['email'] ?? '';
$dni = $_POST['dni'] ?? '';
$id_cliente = $_POST['id_cliente'] ?? ''; // Obtén el id_cliente que se pasa desde el frontend

// Respuesta inicial
$response = ['email_exists' => false, 'dni_exists' => false];

// Verificar si el email existe en tb_personas, excluyendo al cliente actual
if (!empty($email)) {
    // Consulta para verificar si el email ya existe pero no para el cliente actual
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_personas WHERE email = ? AND id_persona != (SELECT id_persona FROM tb_clientes WHERE id_cliente = ?)");
    $query->bind_param('si', $email, $id_cliente);  // 's' para email (string) y 'i' para id_cliente (entero)
    $query->execute();
    $query->bind_result($email_exists);
    $query->fetch();
    $response['email_exists'] = $email_exists > 0;  // Si hay más de 0, significa que ya existe
    $query->close();
}

// Verificar si el DNI existe en tb_personas, excluyendo al cliente actual
if (!empty($dni)) {
    // Consulta para verificar si el DNI ya existe pero no para el cliente actual
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_personas WHERE dni = ? AND id_persona != (SELECT id_persona FROM tb_clientes WHERE id_cliente = ?)");
    $query->bind_param('si', $dni, $id_cliente);  // 's' para dni (string) y 'i' para id_cliente (entero)
    $query->execute();
    $query->bind_result($dni_exists);
    $query->fetch();
    $response['dni_exists'] = $dni_exists > 0;  // Si hay más de 0, significa que ya existe
    $query->close();
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

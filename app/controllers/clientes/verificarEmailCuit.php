<?php
// Incluir el archivo de configuración
include '../../config.php';  // Asegúrate de que el path sea correcto

$email = $_POST['email'] ?? '';
$cuit = $_POST['cuit'] ?? '';
$id_cliente = $_POST['id_cliente'] ?? ''; // Obtén el id_cliente que se pasa desde el frontend

// Respuesta inicial
$response = ['email_exists' => false, 'cuit_exists' => false];

// Verificar si el email existe en tb_personas, excluyendo al cliente actual
if (!empty($email)) {
    // Consulta para verificar si el email ya existe pero no para el cliente actual
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_empresas WHERE email = ? AND id_empresa != (SELECT id_empresa FROM tb_clientes WHERE id_cliente = ?)");
    $query->bind_param('si', $email, $id_cliente);  // 's' para email (string) y 'i' para id_cliente (entero)
    $query->execute();
    $query->bind_result($email_exists);
    $query->fetch();
    $response['email_exists'] = $email_exists > 0;  // Si hay más de 0, significa que ya existe
    $query->close();
}

// Verificar si el CUIT existe en tb_empresas, excluyendo al cliente actual
if (!empty($cuit)) {
    // Consulta para verificar si el CUIT ya existe pero no para el cliente actual
    $query = $mysqli->prepare("SELECT COUNT(*) FROM tb_empresas WHERE cuit = ? AND id_empresa != (SELECT id_empresa FROM tb_clientes WHERE id_cliente = ?)");
    $query->bind_param('si', $cuit, $id_cliente);  // 's' para cuit (string) y 'i' para id_cliente (entero)
    $query->execute();
    $query->bind_result($cuit_exists);
    $query->fetch();
    $response['cuit_exists'] = $cuit_exists > 0;  // Si hay más de 0, significa que ya existe
    $query->close();
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

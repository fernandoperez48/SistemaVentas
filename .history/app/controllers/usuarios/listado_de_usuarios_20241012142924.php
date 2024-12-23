<?php
/*
$sql_usuarios = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, us.imagen as imagen, us.id_rol as id_rol, rol.rol as rol FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol=rol.id_rol";

$result_usuarios = $mysqli->query($sql_usuarios);

$usuarios_datos = [];

if ($result_usuarios) {
    while ($row = $result_usuarios->fetch_assoc()) {
        $usuarios_datos[] = $row;
    }
}*/

// URL de tu API en Node.js
$api_url = "http://localhost:3000/api/usuarios";

// Hacer la solicitud a la API
$api_response = file_get_contents($api_url);

// Verificar si la solicitud fue exitosa
if ($api_response === FALSE) {
    die('Error al intentar obtener los datos de la API');
}

// Decodificar la respuesta JSON
$usuarios_datos = json_decode($api_response, true);

// Verificar si los datos fueron decodificados correctamente
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error al decodificar los datos JSON: ' . json_last_error_msg());
}

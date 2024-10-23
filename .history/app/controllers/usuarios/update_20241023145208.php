<?php
/*include '../../config.php';

$id_usuarios = $_POST['id_usuario'];
$nombres = $_POST['nombre_usuario'];
$email = $_POST['email'];
$password_user = $_POST['contraseña'];
$password_repeat = $_POST['repita_contraseña'];
$rol = $_POST['rolupdate'];
$fechaHora = date("Y-m-d H:i:s");
$password_user = password_hash($password_user, PASSWORD_DEFAULT);

// Inicializar el nombre del archivo
$filename = "";

// Obtener la imagen actual del usuario
$result = $mysqli->query("SELECT imagen FROM tb_usuarios WHERE id_usuarios = '$id_usuarios'");
$currentImage = $result->fetch_assoc();
$filename = $currentImage['imagen'] ? $currentImage['imagen'] : "sinimagen.jpg";

// Verificar si se ha subido una imagen
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../usuarios/img/img_usuarios" . $filename;

    // Intentar mover el archivo subido a la ubicación deseada
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
        // Si falla la subida, registrar un error y finalizar el script
        echo "Error al subir la imagen.";
        exit;
    }
}

// URL de la API
$url = "http://localhost:3000/api/usuarios/" . $id_usuarios;

// Crear un array con los datos del formulario
$post_data = [
    'nombres' => $nombres,
    'email' => $email,
    'id_rol' => $rol,
    'password_user' => $password_user,
    'imagen' => $filename,
    'fyh_actualizacion' => $fechaHora
];

// Convertir los datos a formato JSON
$post_data_json = json_encode($post_data);

// Inicializar cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Cambiar a PUT para la actualización
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); // Enviar JSON
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_json);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Manejar la respuesta
if ($response === false) {
    $error_msg = curl_error($ch);
    echo 'Error en cURL: ' . $error_msg;
} else {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
    $_SESSION['icono'] = "success";
    echo 'Usuario actualizado correctamente: ' . $response;
}
// Cerrar cURL
curl_close($ch);
*/
include '../../config.php';

$id_usuarios = $_POST['id_usuario'];
$nombres = $_POST['nombre_usuario'];
$email = $_POST['email'];
$password_user = $_POST['contraseña'];
$password_repeat = $_POST['repita_contraseña'];
$rol = $_POST['rolupdate'];
$fechaHora = date("Y-m-d H:i:s");
$password_user = password_hash($password_user, PASSWORD_DEFAULT);

// Inicializar el nombre del archivo
$filename = "";

// Obtener la imagen actual del usuario
$result = $mysqli->query("SELECT imagen FROM tb_usuarios WHERE id_usuarios = '$id_usuarios'");
$currentImage = $result->fetch_assoc();
$filename = $currentImage['imagen'] ? $currentImage['imagen'] : "sinimagen.jpg";

// Verificar si se ha subido una imagen
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../usuarios/img/img_usuarios" . $filename;

    // Intentar mover el archivo subido a la ubicación deseada
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
        // Si falla la subida, registrar un error y finalizar el script
        echo "Error al subir la imagen.";
        exit;
    }
}

if (!empty($nombres) && !empty($rol) && !empty($email) && !empty($password_user)) {
    // Actualizar datos del usuario en la base de datos
    $sql_usuarios = "UPDATE tb_usuarios SET 
        nombres = '$nombres', 
        email = '$email', 
        id_rol = '$rol', 
        password_user = '$password_user', 
        imagen = '$filename',
        fyh_actualizacion = '$fechaHora' 
        WHERE id_usuarios = '$id_usuarios'";

    $resultado_usuario = $mysqli->query($sql_usuarios);

    if ($resultado_usuario) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
        $_SESSION['icono'] = "success";
        echo "actualizado";
    } else {
        echo "No se pudo registrar el usuario";
    }
} else {
    echo "Faltan campos obligatorios.";
}





?>
<?php
include '../../config.php';

// Obtener los datos del usuario
$nombre_usuario = $_POST['nombre_usuario'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$contraseña = $_POST['contraseña'];


// Verificar si se ha subido una imagen
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../usuarios/img/img_usuarios" . $filename;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
} else {
    $filename = "sinimagen.jpg";
}

if (!empty($nombre_usuario) && !empty($rol) && !empty($email)) {

    $fecha_creacion =  date("Y-m-d-h-i-s");


    // Consulta SQL para insertar el usuario
    $sql_usuario = "INSERT INTO tb_usuarios(nombres, email, id_rol, password_user, imagen, fyh_creacion) 
VALUES ('$nombre_usuario', '$email', '$rol', '$contraseña', '$filename', '$fecha_creacion')";
    $resultado_usuario = $mysqli->query($sql_usuario);
}

if ($resultado_usuario) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el usuario correctamente";
    $_SESSION['icono'] = "success";
    echo "registrado";
} else {
    echo "No se pudo registrar el usuario";
}

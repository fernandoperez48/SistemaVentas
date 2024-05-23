<?php
include '../../config.php';

$nombres = $_POST['nombres'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

if ($password_user == $password_repeat) {
    $password_hashed = password_hash($password_user, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_usuarios(nombres, email, id_rol, password_user, fyh_creacion) 
            VALUES ('$nombres', '$email', '$rol', '$password_hashed', '$fechaHora')";

    if ($mysqli->query($sql) === TRUE) {
        session_start();
        $_SESSION['mensaje'] = "Se registró el usuario correctamente";
        header('location: ' . $URL . 'usuarios/');
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas no coinciden";
    header('location: ' . $URL . 'usuarios/create.php');
}

$mysqli->close();

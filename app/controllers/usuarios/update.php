<?php
include '../../config.php';
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuarios = $_POST['id_usuarios'];
$rol = $_POST['rol'];
$fechaHora = date("Y-m-d H:i:s");  // Assuming you need a timestamp

if ($password_user == "") {
    if ($password_user == $password_repeat) {
        $sql = "UPDATE tb_usuarios 
                SET nombres='$nombres', 
                    email='$email', 
                    id_rol='$rol', 
                    fyh_actualizacion='$fechaHora' 
                WHERE id_usuarios='$id_usuarios'";

        if ($mysqli->query($sql) === TRUE) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
            $_SESSION['icono'] = "success";
            header('location: ' . $URL . 'usuarios/');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar el usuario";
            $_SESSION['icono'] = "error";
            header('location: ' . $URL . 'usuarios/update.php?id=' . $id_usuarios);
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('location: ' . $URL . 'usuarios/update.php?id=' . $id_usuarios);
    }
} else {
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sql = "UPDATE tb_usuarios 
                SET nombres='$nombres', 
                    email='$email', 
                    id_rol='$rol', 
                    password_user='$password_user', 
                    fyh_actualizacion='$fechaHora' 
                WHERE id_usuarios='$id_usuarios'";

        if ($mysqli->query($sql) === TRUE) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
            $_SESSION['icono'] = "success";
            header('location: ' . $URL . 'usuarios/');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar el usuario";
            $_SESSION['icono'] = "error";
            header('location: ' . $URL . 'usuarios/update.php?id=' . $id_usuarios);
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('location: ' . $URL . 'usuarios/update.php?id=' . $id_usuarios);
    }
}

$mysqli->close();

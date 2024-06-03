<?php
include_once '../../config.php';

$email = $_POST['email'];
$password_user = $_POST['password_user'];

$contador = 0;
$sql = "SELECT * FROM tb_usuarios WHERE email='$email'";
$resultado = $mysqli->query($sql);

if ($resultado->num_rows > 0) {
    while ($usuario = $resultado->fetch_assoc()) {
        $contador++;
        $email = $usuario['email'];
        $nombres = $usuario['nombres'];
        $password_user_tabla = $usuario['password_user'];
    }

    if ($contador > 0 && password_verify($password_user, $password_user_tabla)) {
        echo "Datos Correctos";
        session_start();
        $_SESSION['email'] = $email;
        header('location:' . $URL . '/index.php');
    } else {
        echo "No existe el usuario...";
        session_start();
        $_SESSION['mensaje'] = "Error: datos incorrectos";
        header('location:' . $URL . '/login/index.php');
    }
} else {
    echo "No existe el usuario...";
    session_start();
    $_SESSION['mensaje'] = "Error: usuario no encontrado";
    header('location:' . $URL . '/login/index.php');
}

<?php
include_once '../../config.php';

$email = $_POST['email'];
$password_user = $_POST['password_user'];

// Función para limpiar carritos huérfanos
function limpiarCarrito($mysqli)
{
    $sql_limpieza = "DELETE FROM tb_carrito WHERE nro_venta NOT IN (SELECT nro_venta FROM tb_ventas)";
    if ($mysqli->query($sql_limpieza)) {
        return true; // Limpieza exitosa
    } else {
        error_log("Error al limpiar carritos: " . $mysqli->error);
        return false; // Error durante la limpieza
    }
}

// Realizamos la consulta para obtener el email en la base de datos
$sql = "SELECT * FROM tb_usuarios WHERE email='$email'";
$resultado = $mysqli->query($sql);

if ($resultado->num_rows > 0) {
    // Creamos un array para almacenar los datos del usuario
    $usuario = $resultado->fetch_assoc();

    // Obtenemos la contraseña guardada en la base de datos
    $password_user_tabla = $usuario['password_user'];

    // Verificamos que la contraseña ingresada coincida con la de la base de datos
    if (password_verify($password_user, $password_user_tabla)) {
        session_start();
        $_SESSION['email'] = $email;

        // Limpieza de carritos huérfanos
        limpiarCarrito($mysqli);

        // Devolvemos 'success' para indicar que los datos son correctos
        echo "success";
    } else {
        // Si la contraseña no coincide
        echo "errorpass"; // Cambiado de "Contraseña incorrecta." a "errorpass"
    }
} else {
    // Si no existe el usuario en la base de datos
    echo "usuario_no_encontrado";
}

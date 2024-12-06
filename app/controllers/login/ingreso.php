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
// Función para limpiar detalles de compras huérfanos
// Función para limpiar registros huérfanos de compras
function limpiarCompras($mysqli)
{
    // Identificar las compras con 'costo', 'usuario' y 'nro_comprobante' vacíos o nulos
    $sql_obtener_compras = "
        SELECT nro_compra 
        FROM tb_compras 
        WHERE (costo IS NULL OR costo = '') 
          AND (id_usuario IS NULL OR id_usuario = '') 
          AND (nro_comprobante IS NULL OR nro_comprobante = '')";
    $resultado = $mysqli->query($sql_obtener_compras);

    if ($resultado) {
        // Recolectar los `nro_compra` que cumplen las condiciones
        $compras_a_eliminar = [];
        while ($row = $resultado->fetch_assoc()) {
            $compras_a_eliminar[] = $row['nro_compra'];
        }

        if (!empty($compras_a_eliminar)) {
            // Convertir los números de compra en una lista para la consulta
            $compras_in = implode(",", $compras_a_eliminar);

            // Eliminar registros en `tb_detalle_compras` correspondientes
            $sql_eliminar_detalle = "
                DELETE FROM tb_detalle_compras 
                WHERE nro_compra IN ($compras_in)
            ";
            if (!$mysqli->query($sql_eliminar_detalle)) {
                error_log("Error al limpiar detalles de compras: " . $mysqli->error);
            }

            // Eliminar los registros en `tb_compras` correspondientes
            $sql_eliminar_compras = "
                DELETE FROM tb_compras 
                WHERE nro_compra IN ($compras_in)
            ";
            if (!$mysqli->query($sql_eliminar_compras)) {
                error_log("Error al limpiar compras: " . $mysqli->error);
            }
        }
    } else {
        error_log("Error al obtener compras para limpieza: " . $mysqli->error);
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
        limpiarCompras($mysqli);

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

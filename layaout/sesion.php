
<?php
session_start();
if (isset($_SESSION['email'])) {
    //echo "Si existe sesion de ".$_SESSION['email'];
    $email_session = $_SESSION['email'];
    $sql = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, 
            rol.rol as rol, rol.id_rol 
            FROM tb_usuarios as us 
            INNER JOIN tb_roles as rol ON us.id_rol=rol.id_rol 
            WHERE email=?";

    // Preparar la consulta
    $query = $mysqli->prepare($sql);

    // Comprobar si la consulta se preparó correctamente
    if (!$query) {
        die("Error al preparar la consulta: " . $mysqli->error);
    }

    // Bind del parámetro
    $query->bind_param("s", $email_session);

    // Ejecutar la consulta
    if (!$query->execute()) {
        die("Error al ejecutar la consulta: " . $query->error);
    }

    // Obtener los resultados
    $result = $query->get_result();
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuarios_sesion = $usuario['id_usuarios'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
        $id_rol = $usuario['id_rol'];
    }

    // Liberar el resultado y cerrar la consulta
    $result->free();
    $query->close();
} else {
    echo "No existe sesion";
    header('Location: ' . $URL . '/login');
    exit(); // Asegurarse de que el script se detenga después de redirigir
}

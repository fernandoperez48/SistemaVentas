<?php
include '../../config.php';

$nombre_usuario = $_GET['nombre_usuario'];
$email = $_GET['email'];
$rol = $_GET['rol'];
$contraseña = $_GET['contraseña'];
$repita_contraseña = $_GET['repita_contraseña'];

if (!empty($nombre_usuario) && !empty($rol) && !empty($email)) {
    // Insertar en la tabla tb_usuarios    
    $sql_usuario = "INSERT INTO tb_usuarios(nombres, email, id_rol, password_user) 
                      VALUES ('$nombre_usuario', '$email', '$rol', '$contraseña')";
    $resultado_usuario = $mysqli->query($sql_usuario);

    if ($resultado_usuario) {
        $id_usuarios = $mysqli->insert_id;
        //echo "Guardado correctamente";
        session_start();
        $_SESSION['mensaje'] = "Se registró el usuario correctamente";
        $_SESSION['icono'] = "success";
?>
        <script>
            window.location.href = '<?php echo $URL; ?>/usuarios/';
        </script>
    <?php
    } else {
        //echo "No se pudo registrar el usuario";
        session_start();
        $_SESSION['mensaje'] = "No se pudo registrar el usuario";
        $_SESSION['icono'] = "error";
    ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/usuarios/';
        </script>
    <?php
    }
} else {
    //echo "Faltan campos obligatorios";
    session_start();
    $_SESSION['mensaje'] = "Faltan campos obligatorios";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        window.location.href = '<?php echo $URL; ?>/usuarios/';
    </script>
<?php
}
?>
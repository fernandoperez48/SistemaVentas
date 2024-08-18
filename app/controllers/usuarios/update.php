<?php
include '../../config.php';

$id_usuarios = $_POST['id_usuario'];
$nombres = $_POST['nombre_usuario'];
$email = $_POST['email'];
$password_user = $_POST['contraseña'];
$password_repeat = $_POST['repita_contraseña'];
$rol = $_POST['rolupdate'];
$fechaHora = date("Y-m-d H:i:s");
$password_user = password_hash($password_user, PASSWORD_DEFAULT);

// Actualizar datos del proveedor
$sql_usuarios = "UPDATE tb_usuarios SET 
    nombres='$nombres', 
                        email='$email', 
                        id_rol='$rol', 
                        password_user='$password_user', 
                        fyh_actualizacion='$fechaHora' 
                    WHERE id_usuarios='$id_usuarios'";

// Iniciar sesión
session_start();

// Ejecutar las consultas
if ($mysqli->query($sql_usuarios) === true) {
    $_SESSION['mensaje'] = "Se actualizó al proveedor correctamente";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "No se pudo actualizar al proveedor o su domicilio";
    $_SESSION['icono'] = "error";
}

// Redirigir
?>
<script>
    window.location.href = '<?php echo $URL; ?>/usuarios/';
</script>
<?php
exit();
?>
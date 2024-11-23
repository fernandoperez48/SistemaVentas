<?php
include '../../config.php';

$id_usuario = $_POST['id_usuario'];

$sql = "DELETE FROM tb_usuarios WHERE id_usuarios = '$id_usuario'";
if ($mysqli->query($sql) === true) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó al usuario correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/usuarios/';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar al usuario";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/usuarios';
    </script>
<?php
}
?>
<?php
include '../../config.php';

$id_cliente = $_GET['id_cliente'];

// Aquí actualizamos el estado a '0' (inactivo)
$sql = "UPDATE tb_clientes SET estado = 0 WHERE id_cliente = '$id_cliente'";

if ($mysqli->query($sql) === true) {
    session_start();
    $_SESSION['mensaje'] = "El cliente ha sido eliminado de su lista";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo desactivar al cliente";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
    </script>
<?php
}
?>
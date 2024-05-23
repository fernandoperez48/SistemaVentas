<?php
include '../../config.php';

$id_proveedor = $_GET['id_proveedor'];

$sql = "DELETE FROM tb_proveedores WHERE id_proveedor = '$id_proveedor'";
if ($mysqli->query($sql) === true) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó al proveedor correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/proveedores/';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar al proveedor";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/proveedores/';
    </script>
<?php
}
?>
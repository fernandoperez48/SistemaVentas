<?php
include '../../config.php';

$id_proveedor = $_GET['id_proveedor'];
$estado = $_GET['estado'];
if ($estado == "habilitado") {
    $sql = "UPDATE tb_proveedores SET estado = 'deshabilitado' WHERE id_proveedor = '$id_proveedor'";
} else {
    $sql = "UPDATE tb_proveedores SET estado = 'habilitado' WHERE id_proveedor = '$id_proveedor'";
}

if ($mysqli->query($sql) === true) {
    session_start();

    $_SESSION['mensaje'] = "Se cambio de estado correctamente";

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
<?php
include '../../config.php';

$id_cliente = $_GET['id_cliente'];

$sql = "DELETE FROM tb_clientes WHERE id_cliente = '$id_cliente''";
if ($mysqli->query($sql) === true) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó al cliente correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar al cliente";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
    </script>
<?php
}
?>
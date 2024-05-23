<?php
include '../../config.php';

$id_carrito = $_POST['id_carrito'];

$sql = "DELETE FROM tb_carrito WHERE id_carrito='$id_carrito'";

if ($mysqli->query($sql) === TRUE) {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
} else {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
}

$mysqli->close();
?>
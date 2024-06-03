<?php
include_once '../../config.php';

$nro_venta = $_GET['nro_venta'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$fechaHora = date('Y-m-d H:i:s'); // Suponiendo que `$fechaHora` se obtiene así

$sql = "INSERT INTO tb_carrito (nro_venta, id_producto, cantidad, fyh_creacion) 
        VALUES ('$nro_venta', '$id_producto', '$cantidad', '$fechaHora')";

if ($mysqli->query($sql) === TRUE) {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la compra";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
}

$mysqli->close();
?>
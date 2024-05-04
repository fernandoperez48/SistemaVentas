<?php
include_once '../../config.php';

$nro_compra = $_GET['nro_compra'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$precio_unitario = $_GET['precio_unitario'];


$sentencia = $pdo->prepare("INSERT INTO tb_detalle_compras
    (nro_compra,id_producto,cantidad_producto,precio_unitario)
     VALUES (:nro_compra,:id_producto,:cantidad_producto,:precio_unitario);");


$sentencia->bindParam('nro_compra', $nro_compra);
$sentencia->bindParam('id_producto', $id_producto);
$sentencia->bindParam('cantidad_producto', $cantidad);
$sentencia->bindParam('precio_unitario', $precio_unitario);



if ($sentencia->execute()) {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la compra";
    $_SESSION['icono'] = "error";
    // header('location: '.$URL.'/categorias');
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>
<?php
}



?>
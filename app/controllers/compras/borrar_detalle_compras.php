<?php
include '../../config.php';


$id_detalle_compras = $_POST['id_detalle_compras'];


$sentencia = $pdo->prepare("DELETE FROM tb_detalle_compras WHERE id_detalle_compras=:id_detalle_compras;");

$sentencia->bindParam('id_detalle_compras', $id_detalle_compras);



if ($sentencia->execute()) {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>
<?php
} else {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>
<?php
}

?>
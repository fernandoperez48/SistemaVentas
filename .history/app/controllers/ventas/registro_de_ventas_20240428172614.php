<?php
include '../../config.php';

$nro_venta = $_GET['nro_venta'];
$id_cliente = $_GET['id_cliente'];
$total_a_cancelar = $_GET['total_a_cancelar'];


$pdo->beginTransaction();


$sentencia = $pdo->prepare("INSERT INTO tb_ventas
    (id_cliente,total_pagado,fyh_creacion)
     VALUES (:id_cliente,:total_pagado,:fyh_creacion);");


//$sentencia->bindParam(':nro_venta', $nro_venta);
$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->bindParam(':total_pagado', $total_a_cancelar);
$sentencia->bindParam(':fyh_creacion', $fechaHora);


if ($sentencia->execute()) {

    $pdo->commit();

    //echo "Guardado correctamente";
    session_start();
    //echo "Se registro la categoria correctamente";
    $_SESSION['mensaje'] = "Se registro la venta correctamente";
    $_SESSION['icono'] = "success";
    //header('location: '.$URL.'/categorias/');
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas';
    </script>
<?php
} else {
    $pdo->rollBack();
    //echo "No se guardo correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    // header('location: '.$URL.'/categorias');
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
}



?>
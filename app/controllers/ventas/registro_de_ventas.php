<?php
include '../../config.php';

$nro_venta = $_GET['nro_venta'];
$id_cliente = $_GET['id_cliente'];
$total_a_cancelar = $_GET['total_a_cancelar'];
$fechaHora = date('Y-m-d H:i:s'); // Suponiendo que `$fechaHora` se obtiene así
$usuario = $_GET['usuario'];


$mysqli->begin_transaction();

$sql = "INSERT INTO tb_ventas (nro_venta, id_cliente, total_pagado, fyh_creacion, usuario, estadoVenta) 
        VALUES ('$nro_venta', '$id_cliente', '$total_a_cancelar', '$fechaHora', '$usuario', 'habilitada')";

if ($mysqli->query($sql) === TRUE) {
    $mysqli->commit();
    session_start();
    $_SESSION['mensaje'] = "Se registró la venta correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas';
    </script>
<?php
} else {
    $mysqli->rollback();
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
}

$mysqli->close();
?>
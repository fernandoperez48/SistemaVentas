<?php
include '../../config.php';

$id_envio = $_GET['id_envio'];
$direccion = $_GET['direccion'];
$estado = $_GET['estado'];

$sql = "UPDATE tb_envios SET 
            Direccion='$direccion',
            estado='$estado'
         WHERE idVenta='$id_envio'";

if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el envío correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/envios/';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo editar el envío";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/envios/';
    </script>
<?php
}
?>
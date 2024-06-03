<?php
include '../../config.php';

$id_envio = $_GET['id_envio'];

$sql = "DELETE FROM tb_envios WHERE idVenta='$id_envio'";

if ($mysqli->query($sql) === TRUE) {
    //echo "Guardado correctamente";
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el envío correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/envios/';
    </script>
<?php
} else {
    //echo "No se guardo correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el envío";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/envios/';
    </script>
<?php
}
?>
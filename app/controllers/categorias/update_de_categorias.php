<?php
include '../../config.php';

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];
$fechaHora = date('Y-m-d H:i:s'); // Asumiendo que $fechaHora no está definida en el código proporcionado

$sql = "UPDATE tb_acategorias 
        SET nombre_categoria='$nombre_categoria', 
            fyh_actualizacion='$fechaHora' 
        WHERE id_categoria='$id_categoria'";

if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la categoria correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/categorias/';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se actualizo la categoria correctamente";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/categorias/';
    </script>
<?php
}
?>
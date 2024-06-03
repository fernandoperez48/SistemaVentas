<?php
include '../../config.php';
$nombre_categoria = $_GET['nombre_categoria'];

// Construcción de la consulta
$sql = "INSERT INTO tb_acategorias(nombre_categoria, fyh_creacion) VALUES ('$nombre_categoria', '$fechaHora')";

// Ejecución de la consulta y comprobación del resultado
if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se registró la categoría correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/categorias/';
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la categoría";
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/categorias/';
    </script>
<?php
}
?>
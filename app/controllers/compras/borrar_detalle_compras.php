<?php
include '../../config.php';

// Recuperar el ID del detalle de compra a eliminar
$id_detalle_compras = $_POST['id_detalle_compras'];

// Crear conexión a la base de datos
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Preparar la consulta de eliminación
$sql = "DELETE FROM tb_detalle_compras WHERE id_detalle_compras = ?";

// Preparar la consulta
$stmt = $mysqli->prepare($sql);

// Vincular parámetros
$stmt->bind_param('i', $id_detalle_compras);

// Ejecutar la consulta
if ($stmt->execute()) {
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

// Cerrar la conexión
$stmt->close();
$mysqli->close();
?>
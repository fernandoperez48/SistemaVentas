<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadeventas');

// Crear la conexión con MySQLi
$mysqli = new mysqli(SERVIDOR, USUARIO, PASSWORD, BD);

// Comprobar la conexión
if ($mysqli->connect_error) {
    die("Error al conectar con la base de datos: " . $mysqli->connect_error);
} else {
    // echo "<script>alert('Conectado...')</script>";
}

// Establecer el conjunto de caracteres a utf8
if (!$mysqli->set_charset("utf8")) {
    die("Error al configurar el conjunto de caracteres: " . $mysqli->error);
}

$URL = "http://localhost/SistemaVentas/";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaHora = date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_proveedor'])) {
    $id_proveedorDelSelect = $_POST['id_proveedor'];


    $sql_productosXproveedor = "SELECT a.id_producto as id_producto, a.codigo as codigo, a.nombre as nombre,
    a.descripcion as descripcion, a.stock as stock, a.stock_minimo as stock_minimo, a.stock_maximo as stock_maximo,
    a.precio_compra as precio_compra, a.precio_venta as precio_venta, a.fecha_ultimo_ingreso as fecha_ultimo_ingreso,
    a.fecha_alta as fecha_alta, a.imagen as imagen, cat.nombre_categoria as nombre_categoria,
    u.nombres as nombres_usuario
FROM tb_almacen as a
INNER JOIN tb_acategorias as cat ON a.id_categoria = cat.id_categoria
INNER JOIN tb_usuarios as u ON a.id_usuario = u.id_usuarios
where a.id_proveedor = $id_proveedorDelSelect";

    $result_productosXproveedor = $mysqli->query($sql_productosXproveedor);

    $productosXproveedor_datos = [];

    if ($result_productosXproveedor) {
        while ($row = $result_productosXproveedor->fetch_assoc()) {
            $productosXproveedor_datos[] = $row;
        }
    }
}

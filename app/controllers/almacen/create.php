<?php
include '../../config.php';
// Función para generar el código del producto
function generarCodigo($mysqli)
{
    $sql = "SELECT COUNT(*) AS total FROM tb_almacen";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $contador_de_id_productos = $row['total'] + 1;

    // Formatear el número con ceros a la izquierda
    return 'p-' . str_pad($contador_de_id_productos, 5, '0', STR_PAD_LEFT);
}

$codigo = generarCodigo($mysqli);
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$id_proveedor = $_POST['id_proveedor'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];

$fecha_carga = date('Y-m-d');

// Verificar si se ha subido una imagen
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../almacen/img/img_productos" . $filename;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
} else {
    $filename = "sinimagen.jpg";
}

// Validar que los valores de stock no sean negativos y que el stock mínimo no sea mayor que el stock máximo
if ($stock_minimo > $stock_maximo) {
    session_start();
    $_SESSION['mensaje'] = "El stock mínimo no puede ser mayor que el stock máximo.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/create.php');
    exit();
}

if ($stock_minimo < 0 || $stock_maximo < 0) {
    session_start();
    $_SESSION['mensaje'] = "Los valores de stock no pueden ser negativos.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/create.php');
    exit();
}

// Consulta SQL para insertar el producto
$sql = "INSERT INTO tb_almacen(codigo, nombre, descripcion, stock_minimo, stock_maximo, fecha_carga, imagen, id_usuario, id_categoria, id_proveedor) 
        VALUES ('$codigo', '$nombre', '$descripcion', '$stock_minimo', '$stock_maximo', '$fecha_carga', '$filename', '$id_usuario', '$id_categoria', '$id_proveedor')";

if ($mysqli->query($sql)) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el producto correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/almacen/');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar el producto";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/create.php');
}

<?php
include '../../config.php';
// Función para generar el código del producto

function generarCodigo($mysqli)
{
    // Consulta para obtener el código con el valor numérico más alto ignorando el prefijo 'p-'
    $sql = "SELECT codigo FROM tb_almacen ORDER BY CAST(SUBSTRING(codigo, 3) AS UNSIGNED) DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    // Si hay al menos un código en la tabla, extraemos el número
    if ($row) {
        $ultimo_numero = (int)substr($row['codigo'], 2); // Eliminamos el prefijo 'p-' y convertimos a entero
        $nuevo_numero = $ultimo_numero + 1; // Sumamos 1 al último número
    } else {
        // Si no hay registros, comenzamos desde el número 1
        $nuevo_numero = 1;
    }

    // Formateamos el nuevo número con ceros a la izquierda
    return 'p-' . str_pad($nuevo_numero, 5, '0', STR_PAD_LEFT);
}


$codigo = generarCodigo($mysqli);
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$id_proveedor = $_POST['id_proveedor'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$talle = $_POST['talle'];
$color = $_POST['color'];

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
$sql = "INSERT INTO tb_almacen(codigo, nombre, descripcion, stock_minimo, stock_maximo, fecha_carga, imagen, id_usuario, id_categoria, id_proveedor, talle, color) 
        VALUES ('$codigo', '$nombre', '$descripcion', '$stock_minimo', '$stock_maximo', '$fecha_carga', '$filename', '$id_usuario', '$id_categoria', '$id_proveedor', '$talle', '$color')";

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

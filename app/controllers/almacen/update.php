<?php
include '../../config.php';
include '../../../layaout/sesion.php';

// Recibir y sanitizar los datos enviados
$id_producto = $_POST['id_producto'];
$nombre_producto = $_POST['nombre_producto'];
$id_categoria = $_POST['id_categoria'];
$descripcion = $_POST['descripcion'];
$talle = $_POST['talle'];
$color = $_POST['color'];
$proveedor = $_POST['proveedor'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stockminimo'];
$stock_maximo = $_POST['stockmaximo'];
$precio_compra = str_replace(',', '.', $_POST['precio_compra']);
$precio_venta = str_replace(',', '.', $_POST['precio_venta']);
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_usuario = $id_usuarios_sesion;
$fechaHora = date("Y-m-d H:i:s");

// Inicializar el nombre del archivo
$filename = "";


// Obtener la imagen actual del producto
$result = $mysqli->query("SELECT imagen FROM tb_almacen WHERE id_producto = '$id_producto'");
$currentImage = $result->fetch_assoc();
$filename = $currentImage['imagen'] ? $currentImage['imagen'] : "sinimagen.jpg";

// Verificar si se ha subido una imagen
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../almacen/img/img_productos" . $filename;

    // Intentar mover el archivo subido a la ubicación deseada
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
        // Si falla la subida, registrar un error y finalizar el script
        echo "Error al subir la imagen.";
        exit;
    }
}



// Validar que stock_minimo no sea mayor que stock_maximo
if ($stock_minimo > $stock_maximo) {
    session_start();
    $_SESSION['mensaje'] = "El stock mínimo no puede ser mayor que el stock máximo.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/update.php?id=' . $id_producto);
    exit();
}

// Validar que los valores de stock no sean negativos
if ($stock < 0 || $stock_minimo < 0 || $stock_maximo < 0) {
    session_start();
    $_SESSION['mensaje'] = "Los valores de stock no pueden ser negativos.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/update.php?id=' . $id_producto);
    exit();
}


// Consulta SQL para actualizar el producto en la base de datos
$sql = "UPDATE tb_almacen SET 
            id_categoria='$id_categoria',
            nombre='$nombre_producto',
            id_usuario='$id_usuario',
            descripcion='$descripcion',
            talle='$talle',
            color='$color',
            stock='$stock',
            stock_minimo='$stock_minimo',
            stock_maximo='$stock_maximo',
            precio_compra='$precio_compra',
            imagen = '$filename',
            precio_venta='$precio_venta',
            fecha_ultimo_ingreso='$fecha_ingreso',
            fyh_actualizacion='$fechaHora'
         WHERE id_producto='$id_producto'";

$resultado_producto = $mysqli->query($sql);

if ($resultado_producto) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
    $_SESSION['icono'] = "success";
    echo "actualizado";
} else {
    echo "No se pudo registrar el usuario correctamente";
}

<?php
include '../../config.php';

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = str_replace(',', '.', $_POST['precio_compra']); // Convertir coma a punto
$precio_venta = str_replace(',', '.', $_POST['precio_venta']); // Convertir coma a punto
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_producto = $_POST['id_producto'];
$image_text = $_POST['image_text'];

if ($_FILES['image']['name'] != null) {
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $image_text = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../almacen/img/img_productos" . $image_text;
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
} else {
    echo "no hay imagen nueva";
}

$sql = "UPDATE tb_almacen SET 
            id_categoria='$id_categoria',
            nombre='$nombre',
            id_usuario='$id_usuario',
            descripcion='$descripcion',
            stock='$stock',
            stock_minimo='$stock_minimo',
            stock_maximo='$stock_maximo',
            precio_compra='$precio_compra',
            imagen='$image_text',
            precio_venta='$precio_venta',
            fecha_ultimo_ingreso='$fecha_ingreso',
            fyh_actualizacion='$fechaHora'
         WHERE id_producto='$id_producto'";

if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el producto correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/almacen/');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se actualizó el producto correctamente";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL2 . 'almacen/update.php?id=' . $id_producto . '');
}

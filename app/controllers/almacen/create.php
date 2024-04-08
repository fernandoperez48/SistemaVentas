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
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];

$image = $_POST['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
if (empty($_FILES['image']['name'])) {
    $filename = "sinimagen.jpg";
} else {
    $filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
}

$location = "../../../almacen/img_productos" . $filename;

move_uploaded_file($_FILES['image']['tmp_name'], $location);



$sentencia = $pdo->prepare("INSERT INTO tb_almacen(codigo,nombre,descripcion,stock,stock_minimo,stock_maximo,precio_compra,precio_venta,fecha_ingreso,imagen,id_usuario,id_categoria) VALUES (:codigo,:nombre,:descripcion,:stock,:stock_minimo,:stock_maximo,:precio_compra,:precio_venta,:fecha_ingreso,:imagen,:id_usuario,:id_categoria);");

$sentencia->bindParam('codigo', $codigo);
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('stock', $stock);
$sentencia->bindParam('stock_minimo', $stock_minimo);
$sentencia->bindParam('stock_maximo', $stock_maximo);
$sentencia->bindParam('precio_compra', $precio_compra);
$sentencia->bindParam('precio_venta', $precio_venta);
$sentencia->bindParam('fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam('imagen', $filename);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_categoria', $id_categoria);


if ($sentencia->execute()) {
    //echo "Guardado correctamente";
    session_start();
    $_SESSION['mensaje'] = "Se registro el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/almacen/');
} else {
    //echo "No se guardo correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'roles/almacen/create.php');
}

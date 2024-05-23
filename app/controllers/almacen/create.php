<?php
include '../../config.php';

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$id_proveedor = $_POST['id_proveedor'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_alta = date('Y-m-d');
$image = $_POST['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = empty($_FILES['image']['name']) ? "sinimagen.jpg" : $nombreDelArchivo . "__" . $_FILES['image']['name'];

$location = "../../../almacen/img_productos" . $filename;
move_uploaded_file($_FILES['image']['tmp_name'], $location);

$sql = "INSERT INTO tb_almacen(codigo, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_alta, imagen, id_usuario, id_categoria, id_proveedor) 
        VALUES ('$codigo', '$nombre', '$descripcion', '$stock', '$stock_minimo', '$stock_maximo', '$precio_compra', '$precio_venta', '$fecha_alta', '$filename', '$id_usuario', '$id_categoria', '$id_proveedor')";

if ($mysqli->query($sql)) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el producto correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/almacen/');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . 'roles/almacen/create.php');
}

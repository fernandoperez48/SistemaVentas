<?php
include '../../config.php';

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$id_proveedor = $_POST['id_proveedor'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];


$fecha_carga = date('Y-m-d');
$image = $_POST['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = empty($_FILES['image']['name']) ? "sinimagen.jpg" : $nombreDelArchivo . "__" . $_FILES['image']['name'];

$location = "../../../almacen/img/img_productos" . $filename;
move_uploaded_file($_FILES['image']['tmp_name'], $location);

$sql = "INSERT INTO tb_almacen(codigo, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_carga, imagen, id_usuario, id_categoria, id_proveedor) 
        VALUES ('$codigo', '$nombre', '$descripcion', '$stock', '$stock_minimo', '$stock_maximo', '$precio_compra', '$precio_venta', '$fecha_carga', '$filename', '$id_usuario', '$id_categoria', '$id_proveedor')";


$sentencia = $pdo->prepare("INSERT INTO tb_almacen(codigo,nombre,descripcion,stock_minimo,stock_maximo,fecha_alta,imagen,id_usuario,id_categoria,id_proveedor) VALUES (:codigo,:nombre,:descripcion,:stock_minimo,:stock_maximo,:fecha_carga,:imagen,:id_usuario,:id_categoria,:id_proveedor);");

$sentencia->bindParam('codigo', $codigo);
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('descripcion', $descripcion);

$sentencia->bindParam('stock_minimo', $stock_minimo);
$sentencia->bindParam('stock_maximo', $stock_maximo);


$sentencia->bindParam('fecha_carga', $fecha_carga);
$sentencia->bindParam('imagen', $filename);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('id_proveedor', $id_proveedor);


if ($sentencia->execute()) {
    //echo "Guardado correctamente";
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
}

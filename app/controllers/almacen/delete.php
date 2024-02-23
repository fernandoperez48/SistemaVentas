<?php
include '../../config.php';

$id_producto=$_POST['id_producto'];


    $sentencia = $pdo->prepare("DELETE FROM tb_almacen WHERE id_producto=:id_producto;");

    $sentencia->bindParam('id_producto',$id_producto);
    if($sentencia->execute()){
        session_start();
        $_SESSION['mensaje']="Se elimino el producto correctamente";
        $_SESSION['icono']="success";
        header('location: '.$URL.'almacen/');
    }else{
        session_start();
        $_SESSION['mensaje']="Ocurrio un error al eliminar el producto";
        $_SESSION['icono']="error";
        header('location: '.$URL.'almacen/delete.php?id_producto='.$id_producto);
    }
?>
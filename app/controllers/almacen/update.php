<?php
include '../../config.php';

$codigo=$_POST['codigo'];
$id_categoria=$_POST['id_categoria'];
$nombre=$_POST['nombre'];
$id_usuario=$_POST['id_usuario'];
$descripcion=$_POST['descripcion'];
$stock=$_POST['stock'];
$stock_minimo=$_POST['stock_minimo'];
$stock_maximo=$_POST['stock_maximo'];
$precio_compra=$_POST['precio_compra'];
$precio_venta=$_POST['precio_venta'];
$fecha_ingreso=$_POST['fecha_ingreso'];
$id_producto=$_POST['id_producto'];
$image_text=$_POST['image_text'];

if($_FILES['image']['name']!=null){
    //echo "hay imagen nueva";
    $nombreDelArchivo= date("Y-m-d-h-i-s");
    $image_text = $nombreDelArchivo."__".$_FILES['image']['name'];
    $location = "../../../almacen/img_productos".$image_text;

    move_uploaded_file($_FILES['image']['tmp_name'],$location);
}else{
    echo "no hay imagen nueva";
}

$sentencia = $pdo->prepare("UPDATE tb_almacen SET 
            id_categoria=:id_categoria,
            nombre=:nombre,
            id_usuario=:id_usuario,
            descripcion=:descripcion,
            stock=:stock,
            stock_minimo=:stock_minimo,
            stock_maximo=:stock_maximo,
            precio_compra=:precio_compra,
            imagen=:imagen,
            precio_venta=:precio_venta,
            fecha_ingreso=:fecha_ingreso,
            fyh_actualizacion=:fyh_actualizacion
         WHERE id_producto=:id_producto;"); 
        
        
    
        $sentencia->bindParam('id_categoria',$id_categoria);
        $sentencia->bindParam('nombre',$nombre);
        $sentencia->bindParam('id_usuario',$id_usuario);
        $sentencia->bindParam('descripcion',$descripcion);
        $sentencia->bindParam('stock',$stock);
        $sentencia->bindParam('stock_minimo',$stock_minimo);
        $sentencia->bindParam('stock_maximo',$stock_maximo);
        $sentencia->bindParam('precio_compra',$precio_compra);
        $sentencia->bindParam('imagen',$image_text);
        $sentencia->bindParam('precio_venta',$precio_venta);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_producto',$id_producto);
        $sentencia->bindParam('fecha_ingreso',$fecha_ingreso);
        
        if($sentencia->execute()){
            //echo "guardado";
            session_start();
            $_SESSION['mensaje']="Se actualizo el producto correctamente";
            $_SESSION['icono']="success";
            header('location: '.$URL.'/almacen/');
        }else{
            //echo "no guardado";
            session_start();
            $_SESSION['mensaje']="No se actualizo el rol correctamente";
            $_SESSION['icono']="error";
            header('location: '.$URL.'almacen/update.php?id='.$id_producto.'');
        }
     

?>
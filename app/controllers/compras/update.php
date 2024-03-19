<?php
include '../../config.php';

$id_compra=$_GET['id_compra'];
$id_producto=$_GET['id_producto'];
$nro_compra=$_GET['nro_compra'];
$fecha_compra=$_GET['fecha_compra'];
$id_proveedor=$_GET['id_proveedor'];
$comprobante=$_GET['comprobante'];
$precio_compra=$_GET['precio_compra'];
$cantidad_compra=$_GET['cantidad_compra'];
$id_usuario=$_GET['id_usuario'];
$stock_total=$_GET['stock_total'];

$pdo->beginTransaction();

   
    $sentencia = $pdo->prepare("update tb_compras set 
    id_producto=:id_producto,
    nro_compra=:nro_compra,
    fecha_compra=:fecha_compra,
    id_proveedor=:id_proveedor,
    comprobante=:comprobante,
    precio_compra=:precio_compra,
    cantidad=:cantidad,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion
     where id_compra=:id_compra;");
   

    $sentencia->bindParam(':id_producto',$id_producto);
    $sentencia->bindParam(':nro_compra',$nro_compra);
    $sentencia->bindParam(':fecha_compra',$fecha_compra);
    $sentencia->bindParam(':id_proveedor',$id_proveedor);
    $sentencia->bindParam(':comprobante',$comprobante);
    $sentencia->bindParam(':precio_compra',$precio_compra);
    $sentencia->bindParam(':cantidad',$cantidad_compra);
    $sentencia->bindParam(':id_usuario',$id_usuario);
    $sentencia->bindParam(':id_compra',$id_compra);
    $sentencia->bindParam(':fyh_actualizacion',$fechaHora);
   

    if($sentencia->execute()){
        //actualiza el stock desde la compra
        $sentencia = $pdo->prepare("UPDATE tb_almacen 
        SET  stock=:stock WHERE id_producto=:id_producto;"); 
            
        $sentencia->bindParam('stock',$stock_total);
        $sentencia->bindParam('id_producto',$id_producto);
        $sentencia->execute();

        $pdo->commit();

        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se actualizo la compra correctamente";
        $_SESSION['icono']="success";
        //header('location: '.$URL.'/categorias/');
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/compras/';
        </script>
        <?php
    }else{
        $pdo->rollBack();
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo actualizar la compra";
        $_SESSION['icono']="error";
       // header('location: '.$URL.'/categorias');
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/compras';
        </script>
        <?php
    }

    

?>
<?php
include '../../config.php';


$id_compra=$_GET['id_compra'];
$id_producto=$_GET['id_producto'];
$stock_actual=$_GET['stock_actual'];
$cantidad_compra=$_GET['cantidad_compra'];

//echo $id_compra." ".$id_producto;
$pdo->beginTransaction();

   
    $sentencia = $pdo->prepare("DELETE FROM tb_compras WHERE id_compra=:id_compra;");
   
    $sentencia->bindParam(':id_compra',$id_compra);
    
   

    if($sentencia->execute()){
        //actualiza el stock desde la compra
        $stock=$stock_actual-$cantidad_compra;
        $sentencia = $pdo->prepare("UPDATE tb_almacen 
        SET  stock=:stock WHERE id_producto=:id_producto;"); 
            
        $sentencia->bindParam('stock',$stock);
        $sentencia->bindParam('id_producto',$id_producto);
        $sentencia->execute();

        $pdo->commit();

        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se elimino la compra correctamente";
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
<?php
include '../../config.php';

$id_producto=$_GET['id_producto'];
$stock_calculado=$_GET['stock_calculado'];


   
    $sentencia = $pdo->prepare("update tb_almacen set stock=:stock where id_producto=:id_producto");

   

    $sentencia->bindParam('stock',$stock_calculado);
    $sentencia->bindParam('id_producto',$id_producto);
    
   

    if($sentencia->execute()){
       echo "Guardado correctamente";       
    }else{
        echo "No se guardo correctamente";     
    }

    

?>
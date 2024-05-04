<?php
include '../../config.php';

$id_envio=$_GET['id_envio'];


    $sentencia = $pdo->prepare("DELETE FROM tb_envios WHERE id_envio=:id_envio;");

    $sentencia->bindParam('id_envio',$id_envio);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se elimino al envio correctamente";
        $_SESSION['icono']="success";
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }else{
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo eliminar el envio";
        $_SESSION['icono']="error";
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }
?>
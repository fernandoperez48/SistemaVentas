<?php
include '../../config.php';

$id_envio = $_GET['id_envio'];
$direccion = $_GET['direccion'];
$estado = $_GET['estado'];

$sentencia = $pdo->prepare("UPDATE tb_envios SET 
            Direccion=:direccion,
            estado=:estado
         WHERE idVenta=:id_envio;"); 

    $sentencia->bindParam(':direccion',$direccion);
    $sentencia->bindParam(':estado',$estado);
    $sentencia->bindParam(':id_envio',$id_envio);

    if($sentencia->execute()){
        session_start();
                window.location.reload();
        $_SESSION['mensaje']="Se actualizo al envio correctamente";
        $_SESSION['icono']="success";
        ?>
        <script>
            window.location.reload();
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }else{
        session_start();
        $_SESSION['mensaje']="No se pudo editar el envio";
        $_SESSION['icono']="error";
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }
?>
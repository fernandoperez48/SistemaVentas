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
        $_SESSION['mensaje']="Se actualizo al envio correctamente";
        $_SESSION['icono']="success";
        header("Location: {$URL}/envios/"); // Redirecciona a la página de envíos
        exit(); // Finaliza la ejecución del script después de la redirección
    }else{
        session_start();
        $_SESSION['mensaje']="No se pudo editar el envio";
        $_SESSION['icono']="error";
        header("Location: {$URL}/envios/"); // Redirecciona a la página de envíos
        exit(); // Finaliza la ejecución del script después de la redirección
    }
?>
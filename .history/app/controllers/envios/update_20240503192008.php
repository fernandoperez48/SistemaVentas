<?php
include '../../config.php';

$id_envio = $_GET['id_envio'];
$nombre_cliente = $_GET['nombre_cliente'];
$fecha = $_GET['fecha'];
$direccion = $_GET['direccion'];
$precio = $_GET['precio'];
$estado = $_GET['estado'];

$sentencia = $pdo->prepare("UPDATE tb_envios SET 
            Direccion=:direccion,
            estado=:estado,
         WHERE idVenta=:id_envio"); 

    $sentencia->bindParam('nombre_cliente',$nombre_cliente);
    $sentencia->bindParam('fecha',$fecha);
    $sentencia->bindParam('direccion',$direccion);
    $sentencia->bindParam('precio',$precio);
    $sentencia->bindParam('estado',$estado);
    $sentencia->bindParam('id_envio',$id_envio);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se actualizo al envio correctamente";
        $_SESSION['icono']="success";
        //header('location: '.$URL.'/categorias/');
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }else{
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo editar el envio";
        $_SESSION['icono']="error";
       // header('location: '.$URL.'/categorias');
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/envios/';
        </script>
        <?php
    }
?>
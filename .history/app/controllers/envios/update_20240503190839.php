<?php
include '../../config.php';

$id_envio = $_GET['id_envio'];
$nombre_cliente = $_GET['nombre_cliente'];
$fecha = $_GET['fecha'];
$direccion = $_GET['direccion'];
$precio = $_GET['precio'];
$estado = $_GET['estado'];

$sentencia = $pdo->prepare("UPDATE tb_envios SET 
            nombre_cliente=:nombre_cliente,
            fecha=:fecha,
            direccion=:direccion,
            precio=:precio,
            estado=:estado,
            fyh_actualizacion=:fyh_actualizacion
         WHERE idVenta=:id_envio"); 

    $sentencia->bindParam('nombre_proveedor',$nombre_proveedor);
    $sentencia->bindParam('celular',$celular);
    $sentencia->bindParam('telefono',$telefono);
    $sentencia->bindParam('empresa',$empresa);
    $sentencia->bindParam('email',$email);
    $sentencia->bindParam('direccion',$direccion);
    $sentencia->bindParam('id_proveedor',$id_proveedor);
    $sentencia->bindParam('fyh_actualizacion',$fechaHora);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se actualizo al proveedor correctamente";
        $_SESSION['icono']="success";
        //header('location: '.$URL.'/categorias/');
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/proveedores/';
        </script>
        <?php
    }else{
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo registrar el proveedor";
        $_SESSION['icono']="error";
       // header('location: '.$URL.'/categorias');
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/proveedores/';
        </script>
        <?php
    }
?>
<?php
include '../../config.php';

$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

$sentencia = $pdo->prepare("INSERT INTO tb_proveedores(nombre_proveedor,celular,telefono,empresa,email,direccion,fyh_creacion) VALUES (:nombre_proveedor,:celular,:telefono,:empresa,:email,:direccion,:fyh_creacion);");

    $sentencia->bindParam('nombre_proveedor',$nombre_proveedor);
    $sentencia->bindParam('fyh_creacion',$fechaHora);
    $sentencia->bindParam('celular',$celular);
    $sentencia->bindParam('telefono',$telefono);
    $sentencia->bindParam('empresa',$empresa);
    $sentencia->bindParam('email',$email);
    $sentencia->bindParam('direccion',$direccion);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se registro el proveedor correctamente";
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
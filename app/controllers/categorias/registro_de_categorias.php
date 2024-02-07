<?php
include '../../config.php';
$nombre_categoria = $_GET['nombre_categoria'];

$sentencia = $pdo->prepare("INSERT INTO tb_acategorias(nombre_categoria,fyh_creacion) VALUES (:nombre_categoria,:fyh_creacion);");

    $sentencia->bindParam('nombre_categoria',$nombre_categoria);
    $sentencia->bindParam('fyh_creacion',$fechaHora);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se registro la categoria correctamente";
        $_SESSION['icono']="success";
        //header('location: '.$URL.'/categorias/');
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/categorias/';
        </script>
        <?php
    }else{
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo registrar la categoria";
        $_SESSION['icono']="error";
       // header('location: '.$URL.'/categorias');
       ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/categorias/';
        </script>
        <?php
    }
?>
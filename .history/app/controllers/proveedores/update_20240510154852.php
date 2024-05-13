<?php
include '../../config.php';

$id_proveedor = $_GET['id_proveedor'];
$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$cuit = $_GET['cuit'];
$iva = $_GET['iva'];
$comercial = $_GET['comercial'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$pais = $_GET['pais'];
$provincia = $_GET['provincia'];
$localidad = $_GET['localidad'];
$domicilio = $_GET['domicilio'];
$numero = $_GET['numero'];
$piso = $_GET['piso'];
$depto = $_GET['depto'];

$sentencia = $pdo->prepare("UPDATE tb_proveedores SET 
            nombre_proveedor=:nombre_proveedor,
            celular=:celular,
            telefono=:telefono,
            cuit=:cuit,
            iva=:iva,
            comercial=:comercial,
            empresa=:empresa,
            email=:email,
         WHERE id_proveedor=:id_proveedor"); 

    $sentencia->bindParam('nombre_proveedor',$nombre_proveedor);
    $sentencia->bindParam('celular',$celular);
    $sentencia->bindParam('telefono',$telefono);
    $sentencia->bindParam('empresa',$empresa);
    $sentencia->bindParam('email',$email);
    $sentencia->bindParam('direccion',$direccion);
    $sentencia->bindParam('id_proveedor',$id_proveedor);
    $sentencia->bindParam('fyh_actualizacion',$fechaHora);

    if($sentencia->execute()){

        // Actualizar la tabla de domicilios
        $sentencia_domicilio = $pdo->prepare("UPDATE tb_domicilios 
        SET pais=:pais,
            provincia=:provincia,
            localidad=:localidad,
            domicilio=:domicilio,
            numero=:numero,
            piso=:piso,
            depto=:depto
        WHERE id_domicilio=:id_domicilio");

        $sentencia_domicilio->bindParam(':pais', $pais);
        $sentencia_domicilio->bindParam(':provincia', $provincia);
        $sentencia_domicilio->bindParam(':localidad', $localidad);
        $sentencia_domicilio->bindParam(':domicilio', $domicilio);
        $sentencia_domicilio->bindParam(':numero', $numero);
        $sentencia_domicilio->bindParam(':piso', $piso);
        $sentencia_domicilio->bindParam(':depto', $depto);
        $sentencia_domicilio->bindParam(':id_proveedor', $id_proveedor);

        if ($sentencia_domicilio->execute()) {



        //echo "Guardado correctamente";
        session_start();
        //echo "Se registro la categoria correctamente";
        $_SESSION['mensaje']="Se actualizo al proveedor correctamente";
        $_SESSION['icono']="success";

    } else {
        session_start();
        $_SESSION['mensaje'] = "No se pudo actualizar el domicilio del proveedor";
        $_SESSION['icono'] = "error";
    }
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
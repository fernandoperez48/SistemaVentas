<?php
include '../../config.php';

$id_proveedor = $_GET['id_proveedor'];
$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$cuit = $_GET['cuit'];
//$iva = $_GET['iva'];
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
$id_domicilio = $_GET['id_domicilio'];

// Actualizar datos del proveedor
$sentencia_proveedor = $pdo->prepare("UPDATE tb_proveedores SET 
    nombre_proveedor=:nombre_proveedor,
    celular=:celular,
    telefono=:telefono,
    cuit=:cuit,
    responsable_comercial=:comercial,
    empresa=:empresa,
    email=:email,
WHERE id_proveedor=:id_proveedor");

$sentencia_proveedor->bindParam(':nombre_proveedor', $nombre_proveedor);
$sentencia_proveedor->bindParam(':celular', $celular);
$sentencia_proveedor->bindParam(':telefono', $telefono);
$sentencia_proveedor->bindParam(':cuit', $cuit);
//$sentencia_proveedor->bindParam(':iva', $iva);
$sentencia_proveedor->bindParam(':comercial', $comercial);
$sentencia_proveedor->bindParam(':empresa', $empresa);
$sentencia_proveedor->bindParam(':email', $email);
$sentencia_proveedor->bindParam(':id_proveedor', $id_proveedor);

// Actualizar datos del domicilio
$sentencia_domicilio = $pdo->prepare("UPDATE tb_domicilios SET 
    pais=:pais,
    provincia=:provincia,
    ciudad=:localidad,
    calle=:domicilio,
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
$sentencia_domicilio->bindParam(':id_domicilio', $id_domicilio);

// Iniciar sesión
session_start();

// Ejecutar las consultas
if ($sentencia_proveedor->execute() && $sentencia_domicilio->execute()) {
    $_SESSION['mensaje'] = "Se actualizó al proveedor correctamente";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "No se pudo actualizar al proveedor o su domicilio";
    $_SESSION['icono'] = "error";
}

// Redirigir
?>
<script>
    window.location.href = '<?php echo $URL; ?>/proveedores/';
</script>
<?php
exit();
?>

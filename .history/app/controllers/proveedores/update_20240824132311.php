<?php
include '../../config.php';

$id_proveedor = $_POST['id_proveedor'];
$nombre_proveedor = $_POST['nombre_proveedor'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];
$cuit = $_POST['cuit'];
$iva = $_POST['iva'];
$comercial = $_POST['comercial'];
$empresa = $_POST['empresa'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$domicilio = $_POST['domicilio'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$depto = $_POST['depto'];
$id_domicilio = $_POST['id_domicilio'];

// Actualizar datos del proveedor
$sql_proveedor = "UPDATE tb_proveedores SET 
    nombre_proveedor='$nombre_proveedor',
    celular='$celular',
    telefono='$telefono',
    cuit='$cuit',
    condicio_iva='$iva',
    responsable_comercial='$comercial',
    empresa='$empresa',
    email='$email'
WHERE id_proveedor='$id_proveedor'";

// Actualizar datos del domicilio
$sql_domicilio = "UPDATE tb_domicilios SET 
    pais='$pais',
    provincia='$provincia',
    ciudad='$localidad',
    calle='$domicilio',
    numero='$numero',
    piso='$piso',
    depto='$depto'
WHERE id_domicilio='$id_domicilio'";

// Iniciar sesión
session_start();

// Ejecutar las consultas
if ($mysqli->query($sql_proveedor) === true && $mysqli->query($sql_domicilio) === true) {
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
<?php
include '../../config.php';

$id_cliente = $_POST['id_cliente'];
$nombre_cliente = $_POST['nombre_cliente'];
$razon_social = $_POST['razon_social'];
$telefono = $_POST['telefono'];
$cuit = $_POST['cuit'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$domicilio = $_POST['domicilio'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$depto = $_POST['depto'];
$persona_autorizada = $_POST['persona_autorizada'];
$id_domicilio = $_POST['id_domicilio'];

// Actualizar datos del cliente
$sql_cliente = "UPDATE tb_empresas as e
    INNER JOIN tb_clientes AS c on c.id_empresa = e.id_empresa SET 
    e.cuit='$cuit',
    e.nombre='$nombre_cliente',
    e.razon_social='$razon_social',
    e.telefono='$telefono',
    e.persona_autorizada='$persona_autorizada',
    e.email='$email'
WHERE c.id_cliente='$id_cliente'";

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
if ($mysqli->query($sql_cliente) === true && $mysqli->query($sql_domicilio) === true) {
    $_SESSION['mensaje'] = "Se actualizó al cliente correctamente";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "No se pudo actualizar al cliente";
    $_SESSION['icono'] = "error";
}

// Redirigir
?>
<script>
    window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
</script>
<?php
exit();
?>
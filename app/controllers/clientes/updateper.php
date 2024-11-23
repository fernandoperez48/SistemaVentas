<?php
include '../../config.php';

$id_cliente = $_POST['id_cliente'];
$nombre_cliente = $_POST['nombre_cliente'];
$apellido_cliente = $_POST['apellido_cliente'];
$telefono = $_POST['telefono'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$domicilio = $_POST['domicilio'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$depto = $_POST['depto'];
$id_domicilio = $_POST['id_domicilio'];
$condicion_iva = $_POST['condicion_iva'];

// Actualizar datos del cliente
$sql_cliente = "UPDATE tb_personas as p
    INNER JOIN tb_clientes AS C on c.id_persona = p.id_persona SET     
    p.dni='$dni',
    p.nombre='$nombre_cliente',
    p.apellido='$apellido_cliente',
    p.telefono='$telefono',
    p.email='$email'
WHERE c.id_cliente='$id_cliente'";

$sql_condicion_iva = "UPDATE tb_clientes as cl
    INNER JOIN tb_condicion_iva AS cond_iva ON cl.condicion_iva = cond_iva.id SET 
    cl.condicion_iva='$condicion_iva'
WHERE cl.id_cliente='$id_cliente'";

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
if ($mysqli->query($sql_cliente) === true && $mysqli->query($sql_domicilio) === true && $mysqli->query($sql_condicion_iva) === true) {
    $_SESSION['mensaje'] = "Se actualizó al cliente correctamente";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "No se pudo actualizar al cliente";
    $_SESSION['icono'] = "error";
}

// Redirigir
?>
<script>
    window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
</script>
<?php
exit();
?>
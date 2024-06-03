<?php
include '../../config.php';

$id_cliente = $_POST['id_clienteU'];
$nombre_cliente= $_POST['nombre_clienteU'];
$apellido_cliente= $_POST['apellido_clienteU'];
$telefono = $_POST['telefonoU'];
$dni = $_POST['dniU'];
$email = $_POST['emailU'];
$pais = $_POST['paisU'];
$provincia = $_POST['provinciaU'];
$localidad = $_POST['localidadU'];
$domicilio = $_POST['domicilioU'];
$numero = $_POST['numeroU'];
$piso = $_POST['pisoU'];
$depto = $_POST['deptoU'];
$id_domicilio = $_POST['id_domicilio'];

// Actualizar datos del cliente
$sql_cliente = "UPDATE tb_clientes SET 
    dni='$dni',
    nombre='$nombre_cliente',
    apellido='$apellido_cliente',
    telefono='$telefono',
    email='$email'
WHERE id_cliente='$id_cliente'";

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
    window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
</script>
<?php
exit();
?>
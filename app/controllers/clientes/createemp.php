<?php
include '../../config.php';

$nombre_empresa = $_GET['nombre_empresa'];
$razon_social = $_GET['razon_social'];
$telefono = $_GET['telefono'];
$email = $_GET['email'];
$cuit = $_GET['cuit'];
$responsable_comercial = $_GET['responsable_comercial'];
$calle = $_GET['calle'];
$numero = $_GET['numero'];
$piso = $_GET['piso'];
$depto = $_GET['depto'];
$localidad = $_GET['localidad'];
$provincia = $_GET['provincia'];
$pais = $_GET['pais'];

$mysqli->begin_transaction(); // Iniciar transacción

try {
    // Inserta primero el domicilio en tb_domicilios
    $sql_domicilio = "INSERT INTO tb_domicilios(calle, numero, piso, depto, ciudad, provincia, pais) 
                      VALUES ('$calle', '$numero', '$piso', '$depto', '$localidad', '$provincia', '$pais')";
    $resultado_domicilio = $mysqli->query($sql_domicilio);

    if (!$resultado_domicilio) {
        throw new Exception("Error al insertar domicilio");
    }

    $id_domicilio = $mysqli->insert_id; // Obtén el ID del domicilio recién creado

    // Inserta los datos en tb_empresas incluyendo el id_domicilio
    $sql_empresa = "INSERT INTO tb_empresas(cuit, nombre, razon_social, telefono, email, persona_autorizada, id_domicilio) 
                    VALUES ('$cuit', '$nombre_empresa', '$razon_social', '$telefono', '$email', '$responsable_comercial', '$id_domicilio')";
    $resultado_empresa = $mysqli->query($sql_empresa);

    if (!$resultado_empresa) {
        throw new Exception("Error al insertar empresa");
    }

    $id_empresa = $mysqli->insert_id; // Obtén el ID de la empresa recién creada

    // Inserta en tb_clientes con el id_empresa
    $sql_cliente = "INSERT INTO tb_clientes(id_empresa) VALUES ('$id_empresa')";
    $resultado_cliente = $mysqli->query($sql_cliente);

    if (!$resultado_cliente) {
        throw new Exception("Error al insertar cliente");
    }

    $mysqli->commit(); // Confirma la transacción

    session_start();
    $_SESSION['mensaje'] = "Se registró el cliente correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
    </script>
<?php
} catch (Exception $e) {
    $mysqli->rollback(); // Revierte la transacción en caso de error
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar el cliente: " . $e->getMessage();
    $_SESSION['icono'] = "error";
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
    </script>
<?php
}
?>
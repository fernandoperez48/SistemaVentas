<?php
include '../../config.php';

$nombre_proveedor = $_GET['nombre_proveedor'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$cuit = $_GET['cuit'];
$condicion_iva = $_GET['condicion_iva'];
$calle = $_GET['calle'];
$numero = $_GET['numero'];
$piso = $_GET['piso'];
$depto = $_GET['depto'];
$localidad = $_GET['localidad'];
$provincia = $_GET['provincia'];
$pais = $_GET['pais'];
$responsable_comercial = $_GET['responsable_comercial'];
$celular = $_GET['celular'];

if (!empty($nombre_proveedor) && !empty($responsable_comercial) && !empty($celular)) {
    // Insertar en la tabla tb_proveedores
    $sql_proveedor = "INSERT INTO tb_proveedores(nombre_proveedor, telefono, empresa, email, cuit, condicion_iva, responsable_comercial, celular) 
                      VALUES ('$nombre_proveedor', '$telefono', '$empresa', '$email', '$cuit', '$condicion_iva', '$responsable_comercial', '$celular')";
    $resultado_proveedor = $mysqli->query($sql_proveedor);

    if ($resultado_proveedor) {
        $id_proveedor = $mysqli->insert_id;

        // Insertar en la tabla tb_domicilios
        $sql_domicilio = "INSERT INTO tb_domicilios(calle, numero, piso, depto, ciudad, provincia, pais) 
                          VALUES ('$calle', '$numero', '$piso', '$depto', '$localidad', '$provincia', '$pais')";
        $resultado_domicilio = $mysqli->query($sql_domicilio);

        if ($resultado_domicilio) {
            $id_domicilio = $mysqli->insert_id;

            // Actualizar el campo id_domicilio en la tabla tb_proveedores
            $sql_update_id_domicilio = "UPDATE tb_proveedores SET id_domicilio = '$id_domicilio' WHERE id_proveedor = '$id_proveedor'";
            $resultado_update_id_domicilio = $mysqli->query($sql_update_id_domicilio);

            if ($resultado_update_id_domicilio) {
                //echo "Guardado correctamente";
                session_start();
                $_SESSION['mensaje'] = "Se registró el proveedor correctamente";
                $_SESSION['icono'] = "success";
?>
                <script>
                    window.location.href = '<?php echo $URL; ?>/proveedores/';
                </script>
            <?php
            } else {
                //echo "No se pudo actualizar el proveedor";
                session_start();
                $_SESSION['mensaje'] = "No se pudo registrar el proveedor";
                $_SESSION['icono'] = "error";
            ?>
                <script>
                    window.location.href = '<?php echo $URL; ?>/proveedores/';
                </script>
            <?php
            }
        } else {
            //echo "No se pudo registrar el domicilio";
            session_start();
            $_SESSION['mensaje'] = "No se pudo registrar el proveedor";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                window.location.href = '<?php echo $URL; ?>/proveedores/';
            </script>
        <?php
        }
    } else {
        //echo "No se pudo registrar el proveedor";
        session_start();
        $_SESSION['mensaje'] = "No se pudo registrar el proveedor";
        $_SESSION['icono'] = "error";
        ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/proveedores/';
        </script>
    <?php
    }
} else {
    //echo "Faltan campos obligatorios";
    session_start();
    $_SESSION['mensaje'] = "Faltan campos obligatorios";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        window.location.href = '<?php echo $URL; ?>/proveedores/';
    </script>
<?php
}
?>
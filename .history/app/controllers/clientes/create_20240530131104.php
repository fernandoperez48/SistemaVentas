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

if (!empty($nombre_empresa)) {
    // Insertar en la tabla tb_empresas
    $sql_proveedor = "INSERT INTO tb_empresas(cuit, nombre, razon_social, telefono, email, persona_autorizada) 
                      VALUES ('$cuit',$nombre_empresa', '$razon_social', '$telefono', '$email','$responsable_comercial')";
    $resultado_proveedor = $mysqli->query($sql_proveedor);

            if ($resultado_proveedor) {
                $id_empresa = $mysqli->insert_id;

                // Insertar en la tabla tb_domicilios
                $sql_domicilio = "INSERT INTO tb_domicilios(calle, numero, piso, depto, ciudad, provincia, pais) 
                                VALUES ('$calle', '$numero', '$piso', '$depto', '$localidad', '$provincia', '$pais')";
                $resultado_domicilio = $mysqli->query($sql_domicilio);

                                if ($resultado_domicilio) {
                                    $id_domicilio = $mysqli->insert_id;

                                    // Actualizar el campo id_domicilio en la tabla tb_empresas
                                    $sql_update_id_domicilio = "UPDATE tb_empresas SET id_domicilio = '$id_domicilio' WHERE id_empresa = '$id_empresa'";
                                    $resultado_update_id_domicilio = $mysqli->query($sql_update_id_domicilio);

                                                if ($resultado_update_id_domicilio) {
                                                    //echo "Guardado correctamente";
                                                    session_start();
                                                    $_SESSION['mensaje'] = "Se registró el cliente correctamente";
                                                    $_SESSION['icono'] = "success";
                                                    ?>
                                                    <script>
                                                        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
                                                    </script>
                                                <?php
                                                } else {
                                                    //echo "No se pudo actualizar el cliente";
                                                    session_start();
                                                    $_SESSION['mensaje'] = "No se pudo registrar el cliente resultado_update_id_domicilio";
                                                    $_SESSION['icono'] = "error";
                                                ?>
                                                    <script>
                                                        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
                                                    </script>
                                                <?php
                                                }
                                } else {
                                    //echo "No se pudo registrar el domicilio";
                                    session_start();
                                    $_SESSION['mensaje'] = "No se pudo registrar el cliente resultado_domicilio";
                                    $_SESSION['icono'] = "error";
                                    ?>
                                    <script>
                                        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
                                    </script>
                                <?php
                                }
            } else {
                //echo "No se pudo registrar el proveedor";
                session_start();
                $_SESSION['mensaje'] = "No se pudo registrar el cliente resultado_proveedor";
                $_SESSION['icono'] = "error";
                ?>
                <script>
                    window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
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
        window.location.href = '<?php echo $URL; ?>/clientes/indexemp.php';
    </script>
<?php
}
?>
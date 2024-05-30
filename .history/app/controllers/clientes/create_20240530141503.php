<?php
include '../../config.php';

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$telefono = $_GET['telefono'];
$email = $_GET['email'];
$dni = $_GET['dni'];
$calle = $_GET['calle'];
$numero = $_GET['numero'];
$piso = $_GET['piso'];
$depto = $_GET['depto'];
$localidad = $_GET['localidad'];
$provincia = $_GET['provincia'];
$pais = $_GET['pais'];

    // Insertar en la tabla tb_personas
    $sql_proveedor = "INSERT INTO tb_personas(dni, nombre, apellido, telefono, email) 
                      VALUES ('$dni','$nombre', '$apellido', '$telefono', '$email')";
    $resultado_proveedor = $mysqli->query($sql_proveedor);

            if ($resultado_proveedor) {
                $id_persona = $mysqli->insert_id;

                    // Inserción en tb_clientes
                    $sql_clientes = "INSERT INTO tb_clientes(id_persona) VALUES ('$id_persona')";
                    $mysqli->query($sql_clientes);

                // Insertar en la tabla tb_domicilios
                $sql_domicilio = "INSERT INTO tb_domicilios(calle, numero, piso, depto, ciudad, provincia, pais) 
                                VALUES ('$calle', '$numero', '$piso', '$depto', '$localidad', '$provincia', '$pais')";
                $resultado_domicilio = $mysqli->query($sql_domicilio);

                                if ($resultado_domicilio) {
                                    $id_domicilio = $mysqli->insert_id;

                                    // Actualizar el campo id_domicilio en la tabla tb_personas
                                    $sql_update_id_domicilio = "UPDATE tb_personas SET id_domicilio = '$id_domicilio' WHERE id_persona = '$id_persona'";
                                    $resultado_update_id_domicilio = $mysqli->query($sql_update_id_domicilio);

                                                if ($resultado_update_id_domicilio) {
                                                    //echo "Guardado correctamente";
                                                    session_start();
                                                    $_SESSION['mensaje'] = "Se registró el cliente correctamente";
                                                    $_SESSION['icono'] = "success";
                                                    ?>
                                                    <script>
                                                        window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
                                                    </script>
                                                <?php
                                                } else {
                                                    //echo "No se pudo actualizar el cliente";
                                                    session_start();
                                                    $_SESSION['mensaje'] = "No se pudo registrar el cliente ";
                                                    $_SESSION['icono'] = "error";
                                                ?>
                                                    <script>
                                                        window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
                                                    </script>
                                                <?php
                                                }
                                } else {
                                    //echo "No se pudo registrar el domicilio";
                                    session_start();
                                    $_SESSION['mensaje'] = "No se pudo registrar el cliente ";
                                    $_SESSION['icono'] = "error";
                                    ?>
                                    <script>
                                        window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
                                    </script>
                                <?php
                                }
            } else {
                //echo "No se pudo registrar el proveedor";
                session_start();
                $_SESSION['mensaje'] = "No se pudo registrar el cliente ";
                $_SESSION['icono'] = "error";
                ?>
                <script>
                    window.location.href = '<?php echo $URL; ?>/clientes/indexper.php';
                </script>
            <?php
            }
?>
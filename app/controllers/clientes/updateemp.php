<?php
include '../../config.php';

// Recuperar los datos del formulario
$nombre = $_POST['nombre'];
$razon_social = $_POST['razon_social'];
$cuit = $_POST['cuit'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$persona_autorizada = $_POST['persona_autorizada'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$depto = $_POST['depto'];
$idEmpresa = $_POST['idEmpresa'];

if (!empty($_POST)) {
    // Iniciar la transacción
    $mysqli->begin_transaction();

    // Actualizar la tabla tb_empresas
    $sqlUpdateEmpresas = "UPDATE tb_empresas 
                          SET nombre = '$nombre',
                              razon_social = '$razon_social',
                              cuit = '$cuit',
                              telefono = '$telefono',
                              email = '$email',
                              persona_autorizada = '$persona_autorizada' 
                          WHERE id_empresa = '$idEmpresa'";
    $resultadoUpdateEmpresas = $mysqli->query($sqlUpdateEmpresas);

    // Actualizar la tabla tb_domicilios
    $sqlUpdateDomicilios = "UPDATE tb_domicilios 
                            SET calle = '$calle',
                                numero = '$numero',
                                piso = '$piso',
                                depto = '$depto' 
                            WHERE id_domicilio = (
                                SELECT id_domicilio 
                                FROM tb_empresas 
                                WHERE id_empresa = '$idEmpresa'
                            )";
    $resultadoUpdateDomicilios = $mysqli->query($sqlUpdateDomicilios);

    if ($resultadoUpdateEmpresas && $resultadoUpdateDomicilios) {
        // Confirmar la transacción
        $mysqli->commit();

        // Redireccionar después de la actualización
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: ' . $URL . 'clientes/indexemp.php');
    } else {
        // Revertir la transacción en caso de error
        $mysqli->rollback();
        echo "Error al actualizar el usuario";
    }
}

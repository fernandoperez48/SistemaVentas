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
    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Actualizar la tabla tb_empresas
        $sentenciaEmpresas = $pdo->prepare(
            "UPDATE tb_empresas
            SET nombre = :nombre,
                razon_social = :razon_social,
                cuit = :cuit,
                telefono = :telefono,
                email = :email,
                persona_autorizada = :persona_autorizada
            WHERE id_empresa = :idEmpresa"
        );

        $sentenciaEmpresas->bindParam(':nombre', $nombre);
        $sentenciaEmpresas->bindParam(':razon_social', $razon_social);
        $sentenciaEmpresas->bindParam(':cuit', $cuit);
        $sentenciaEmpresas->bindParam(':telefono', $telefono);
        $sentenciaEmpresas->bindParam(':email', $email);
        $sentenciaEmpresas->bindParam(':persona_autorizada', $persona_autorizada);
        $sentenciaEmpresas->bindParam(':idEmpresa', $idEmpresa);
        $sentenciaEmpresas->execute();

        // Actualizar la tabla tb_domicilios
        $sentenciaDomicilios = $pdo->prepare(
            "UPDATE tb_domicilios
            SET calle = :calle,
                numero = :numero,
                piso = :piso,
                depto = :depto
            WHERE id_domicilio = (
                SELECT id_domicilio
                FROM tb_empresas
                WHERE id_empresa = :idEmpresa
            )"
        );

        $sentenciaDomicilios->bindParam(':calle', $calle);
        $sentenciaDomicilios->bindParam(':numero', $numero);
        $sentenciaDomicilios->bindParam(':piso', $piso);
        $sentenciaDomicilios->bindParam(':depto', $depto);
        $sentenciaDomicilios->bindParam(':idEmpresa', $idEmpresa);
        $sentenciaDomicilios->execute();

        // Confirmar la transacción
        $pdo->commit();

        // Redireccionar después de la actualización
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: ' . $URL . 'clientes/indexemp.php');
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $pdo->rollBack();
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
}

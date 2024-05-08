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

    $sentenciapro = $pdo->prepare("INSERT INTO tb_proveedores(nombre_proveedor,telefono,
empresa,email,cuit,condicion_iva,responsable_comercial,celular) 
VALUES (:nombre_proveedor,:telefono,:empresa,:email,:cuit,:condicion_iva,:responsable_comercial,:celular);");

    $sentenciapro->bindParam('nombre_proveedor', $nombre_proveedor);
    $sentenciapro->bindParam('telefono', $telefono);
    $sentenciapro->bindParam('empresa', $empresa);
    $sentenciapro->bindParam('email', $email);
    $sentenciapro->bindParam('cuit', $cuit);
    $sentenciapro->bindParam('condicion_iva', $condicion_iva);
    $sentenciapro->bindParam('responsable_comercial', $responsable_comercial);
    $sentenciapro->bindParam('celular', $celular);
    $sentenciapro->execute();

    $id_proveedor = $pdo->lastInsertId();

    // sentencia domicilio 
    $sentenciadom = $pdo->prepare("INSERT INTO tb_domicilios(calle,numero,piso,depto,ciudad,provincia,pais) 
 VALUES (:calle,:numero,:piso,:depto,:ciudad,:provincia,:pais);");

    $sentenciadom->bindParam('calle', $calle);
    $sentenciadom->bindParam('numero', $numero);
    $sentenciadom->bindParam('piso', $piso);
    $sentenciadom->bindParam('depto', $depto);
    $sentenciadom->bindParam('ciudad', $localidad);
    $sentenciadom->bindParam('provincia', $provincia);
    $sentenciadom->bindParam('pais', $pais);
    $sentenciadom->execute();

    $id_domicilio = $pdo->lastInsertId();

    // Sentencia id_domicilio de tabla proveedores
    // Sentencia para actualizar el campo id_domicilio en la tabla tb_proveedores
    $sentencia_id_domicilio = $pdo->prepare("UPDATE tb_proveedores SET id_domicilio = :id_domicilio WHERE id_proveedor = :id_proveedor");

    // Vincular los parámetros
    $sentencia_id_domicilio->bindParam(':id_domicilio', $id_domicilio);
    $sentencia_id_domicilio->bindParam(':id_proveedor', $id_proveedor);

    // Ejecutar la sentencia
    $sentencia_id_domicilio->execute();

    //echo "Guardado correctamente";
    session_start();
    //echo "Se registro el proveedor correctamente";
    $_SESSION['mensaje'] = "Se registro el proveedor correctamente";
    $_SESSION['icono'] = "success";
    //header('location: '.$URL.'/proveedor/');
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/proveedores/';
    </script>
<?php
} else {
    //echo "No se guardo correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar el proveedor";
    $_SESSION['icono'] = "error";
    // header('location: '.$URL.'/categorias');
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/proveedores/';
    </script>
<?php
}
?>
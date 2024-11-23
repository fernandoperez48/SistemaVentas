<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';

include '../app/controllers/clientes/listado_de_clientesper.php';
include '../app/controllers/clientes/listado_condicion_iva.php';
// Incluir el archivo de la clase del modal
include_once 'ModalUpdatePer.php';
include_once 'ModalCreatePer.php';
include_once 'ModalViewPer.php';
include_once 'ModalDeletePer.php';
include_once 'Reporte.php';

?>

<div class="content-wrapper" style="background-color:gray">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Clientes
                        <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:#fFB347">
                            <h3 class="card-title">Clientes - personas regitradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="border-color: black;">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th>
                                            <center>Id de Cliente</center>
                                        </th>
                                        <th>
                                            <center>Nombre y Apellido</center>
                                        </th>
                                        <th>
                                            <center>DNI</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($clientesper_datos as $clientesper_datos) {
                                        $nombre_iva = $clientesper_datos['nombre_iva'];
                                        $id_cliente = $clientesper_datos['id_cliente'];
                                        $id_domicilio = $clientesper_datos['id_domicilio']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $clientesper_datos['id_cliente']; ?>
                                            </td>
                                            <td><?php echo $clientesper_datos['nombre'] . ' ' . $clientesper_datos['apellido']; ?></td>
                                            <td><?php echo $clientesper_datos['dni']; ?></td>
                                            <td><?php echo $clientesper_datos['telefono']; ?></td>
                                            <td><?php echo $clientesper_datos['email']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i>Ver</a>
                                                        <!-- modal para ver clientes personas-->
                                                        <?php echo ModalViewPer::render($id_cliente, $clientesper_datos); ?>

                                                    </div>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_cliente; ?>"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        <!-- modal para actualizar clientes personas-->
                                                        <?php echo ModalUpdatePer::render($id_cliente, $clientesper_datos, $id_domicilio, $condicion_iva_datos); ?>
                                                        <div id="respuesta_update<?php echo $id_cliente; ?>"></div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_cliente; ?>"><i class="fa fa-trash"></i>Borrar</a>
                                                        <!-- modal para eliminar clientes personas-->
                                                        <?php echo ModalDeletePer::render($id_cliente, $clientesper_datos); ?>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <!-- modal para registrar usuarios-->
                                    <?php echo ModalCreatePer::render($condicion_iva_datos); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<!-- Java Script para la tabla-->
<?php echo Reporte::render(); ?>
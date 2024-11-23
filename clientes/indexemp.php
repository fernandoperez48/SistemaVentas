<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesemp.php';

include_once 'ModalUpdateEmp.php';
include_once 'ModalCreateEmp.php';
include_once 'ModalViewEmp.php';
include_once 'ModalDeleteEmp.php';
include_once 'ReporteEmp.php';
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
                <!-- modal para crear clientes personas-->
                <?php echo ModalCreateEmp::render(); ?>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Clientes - empresas regitradas</h3>

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
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>Razon Social</center>
                                        </th>
                                        <th>
                                            <center>CUIT</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Persona Autorizada</center>
                                        </th>

                                        <th>
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($clientesemp_datos as $clientesemp_datos) {
                                        $id_cliente = $clientesemp_datos['id_cliente'];
                                        $id_domicilio = $clientesemp_datos['id_domicilio']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $clientesemp_datos['id_cliente']; ?>
                                            </td>
                                            <td><?php echo $clientesemp_datos['nombre']; ?></td>
                                            <td><?php echo $clientesemp_datos['razon_social']; ?></td>
                                            <td><?php echo $clientesemp_datos['cuit']; ?></td>
                                            <td><?php echo $clientesemp_datos['telefono']; ?></td>
                                            <td><?php echo $clientesemp_datos['email']; ?></td>
                                            <td><?php echo $clientesemp_datos['persona_autorizada']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">

                                                        <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i>Ver</a>
                                                        <!-- modal para crear clientes empresas-->
                                                        <?php echo ModalViewEmp::render($id_cliente, $clientesemp_datos); ?>


                                                        <a type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_cliente; ?>"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        <!-- modal para actualizar clientes empresas-->
                                                        <?php echo ModalUpdateEmp::render($id_cliente, $clientesemp_datos, $id_domicilio); ?>
                                                        <div id="respuesta_update<?php echo $id_cliente; ?>"></div>


                                                        <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_cliente; ?>"><i class="fa fa-trash"></i>Borrar</a>
                                                        <!-- modal para eliminar clientes empresas-->
                                                        <?php echo ModalDeleteEmp::render($id_cliente, $clientesemp_datos); ?>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

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
<?php echo ReporteEmp::render(); ?>
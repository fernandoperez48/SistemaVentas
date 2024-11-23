<?php include '../app/config.php';
include '../layaout/sesion.php';
if ($id_rol == "5") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/paises/listado_de_paises.php';
include_once 'ModalEditarProv.php';
include_once 'ModalCreateProv.php';
include_once 'ModalVerProv.php';
include_once 'ModalDeshabilitarProv.php';
include_once 'Reporte.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Proveedores
                        <button <?php if ($rol_sesion != "Administrador" || $id_usuarios_sesion == "4") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>


                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Proveedores registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Proveedor</center>
                                        </th>
                                        <th>
                                            <center>Celular</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Empresa</center>
                                        </th>
                                        <th>
                                            <center>Cuit</center>
                                        </th>
                                        <th>
                                            <center>Comercial</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th class="actions">
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($proveedores_datos as $proveedores_datos) {
                                        $id_proveedor = $proveedores_datos['id_proveedor'];
                                        $nombre_proveedor = $proveedores_datos['nombre_proveedor'];
                                        $id_domicilio = $proveedores_datos['id_domicilio'];
                                        $estado = $proveedores_datos['estado']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $nombre_proveedor; ?></td>
                                            <td>
                                                <a href="http://wa.me/+54<?php echo $proveedores_datos['celular']; ?>" target="_blank" class="btn btn-success">
                                                    <i class="fa fa-phone"></i>
                                                    <?php echo $proveedores_datos['celular']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $proveedores_datos['telefono']; ?></td>
                                            <td><?php echo $proveedores_datos['empresa']; ?></td>
                                            <td><?php echo $proveedores_datos['cuit']; ?></td>
                                            <td><?php echo $proveedores_datos['responsable_comercial']; ?></td>
                                            <td><?php echo $proveedores_datos['email']; ?></td>
                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_proveedor; ?>">
                                                        <i class="fa fa-eye"></i>
                                                        Ver
                                                    </button>

                                                    <!-- modal para ver proveedores-->
                                                    <?php echo ModalVerProv::render($id_proveedor, $nombre_proveedor, $proveedores_datos); ?>
                                                </div>

                                                <?php if ($rol_sesion == "Administrador" || $id_rol == 4) { ?>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_proveedor; ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            Editar
                                                        </button>
                                                        <!-- modal para actualizar proveedores-->
                                                        <?php echo ModalEditarProv::render($id_proveedor, $nombre_proveedor, $proveedores_datos, $id_domicilio); ?>
                                                        <div id="respuesta_update<?php echo $id_proveedor; ?>"></div>
                                                    </div>

                                                    <div class="btn-group">
                                                        <?php if ($proveedores_datos['estado'] == 'habilitado') { ?>
                                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_proveedor; ?>">
                                                                <i class="fa fa-trash"></i>
                                                                Deshabilitar
                                                            </button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_proveedor; ?>">
                                                                <i class="fa fa-trash"></i>
                                                                Habilitar
                                                            </button>
                                                        <?php } ?>
                                                        <!-- modal para dehabilitar proveedores-->
                                                        <?php echo ModalDeshabilitarProv::render($id_proveedor, $nombre_proveedor, $proveedores_datos, $estado); ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <!-- modal para crear proveedores-->
                                    <?php echo ModalCreateProv::render($id_proveedor, $nombre_proveedor, $proveedores_datos, $estado); ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <?php include '../layaout/mensajes.php'; ?>
    <?php include '../layaout/parte2.php'; ?>


    <!-- /.modal-dialog -->
</div>



<!-- SCRIPTSSS DE LA TABLA-->
<!-- Table example1 -->
<?php echo Reporte::render(); ?>
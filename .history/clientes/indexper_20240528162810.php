<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesper.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Clientes</h1>
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
                            <h3 class="card-title">Clientes - personas regitradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
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
                                        $id_cliente = $clientesper_datos['id_cliente']; ?>
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

                                                    <!-- modal para ver clientes-->
                                                    <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:#088da5; color:white">
                                                                    <h4 class="modal-title">Datos del proveedor</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celu<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="tel<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>CUIT <b>*</b></label>
                                                                                <input type="text" id="cui<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Condición IVA <b>*</b></label>
                                                                                <input type="text" id="iv<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['iva']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Comercial </label>
                                                                                <input type="text" id="com<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="emp<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="ema<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Pais<b>*</b></label>
                                                                                <input type="text" id="pai<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Provincia<b>*</b></label>
                                                                                <input type="text" id="prov<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Localidad </label>
                                                                                <input type="text" id="loc<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Domicilio<b>*</b></label>
                                                                                <input type="text" id="dom<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nro<b>*</b></label>
                                                                                <input type="text" id="num<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Piso </label>
                                                                                <input type="text" id="pis<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Depto<b>*</b></label>
                                                                                <input type="text" id="dpto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_depto<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </div>

                                                        <a href="updateper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        <a href="deleteper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i>Borrar</a>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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

<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 to 0 of 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": /* Ajuste de botones */ [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                    }, {
                        extend: 'csv',
                    }, {
                        extend: 'excel',
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
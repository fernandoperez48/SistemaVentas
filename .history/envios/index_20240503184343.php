<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/envios/listado_de_envios.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Envios</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Envios registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nro Venta</center>
                                        </th>
                                        <th>
                                            <center>Cliente</center>
                                        </th>
                                        <th>
                                            <center>Fecha compra</center>
                                        </th>
                                        <th>
                                            <center>Dirección Cliente</center>
                                        </th>
                                        <th>
                                            <center>Dirección Envio</center>
                                        </th>
                                        <th>
                                            <center>Precio</center>
                                        </th>
                                        <th>
                                            <center>Estado</center>
                                        </th>
                                        
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($envios_datos as $envios_datos) { 
                                        $id_envio = $envios_datos['IdVenta']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $contador += 1; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['nro_venta']; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['fyh_creacion']; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['calle'] . ' ' . $envios_datos['numero']; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['Direccion']; ?>
                                            </td>
                                            <td>
                                                <?php echo '$'.$envios_datos['total_pagado']; ?>
                                            </td>
                                            <td>
                                                <?php echo $envios_datos['estado']; ?>
                                            </td>
                                            <td>
                                                <center>
                                                <div class="btn-group">
                                                    <a href="update.php?id=<?php echo $id_envio; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                    <a href="delete.php?id=<?php echo $id_envio; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_envio; ?>">
                                                        <i class="fa fa-trash"></i>
                                                        Borrar
                                                    </button>
                                                    <!-- modal para borrar Envios-->
                                                    <div class="modal fade" id="modal-delete<?php echo $id_envio; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:red; color:white">
                                                                    <h4 class="modal-title">¿Esta seguro de eliminar al envio?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nombre del cliente <b>*</b></label>
                                                                                <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Fecha compra <b>*</b></label>
                                                                                <input type="text" id="Fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Direccion de envio</label>
                                                                                <input type="text" id="Direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Total Pagado<b>*</b></label>
                                                                                <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$'.$envios_datos['total_pagado']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Estado </label>
                                                                                <input type="text" id="estado<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['estado']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_envio; ?>">Eliminar</button>
                                                                    <div id="respuesta_delete<?php echo $id_envio; ?>"></div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                    <script>
                                                        $('#btn_delete<?php echo $id_envio; ?>').click(function() {

                                                            var id_envio = '<?php echo $id_envio; ?>';

                                                            var url2 = "../app/controllers/envios/delete.php";
                                                            $.get(url2, {
                                                                id_envio: id_envio
                                                            }, function(datos) {
                                                                $('#respuesta_delete<?php echo $id_envio; ?>').html(datos);
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                </center>
                                            </td>
                                            <td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                                </table>
                            </div>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
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

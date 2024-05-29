<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesemp.php';

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
                            <h3 class="card-title">Clientes - empresas regitradas</h3>

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
                                        $id_cliente = $clientesemp_datos['id_cliente']; ?>
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

                                                         <!-- modal para ver clientes-->
                                                         <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos de la empresa</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre</label>
                                                                                        <input type="text" id="nombre<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['nombre']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Razon social</label>
                                                                                        <input type="text" id="rz<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['apellido']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Telefono</label>
                                                                                        <input type="number" id="tel<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['telefono'] ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>DNI</label>
                                                                                        <input type="text" id="dni<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['dni']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Email</label>
                                                                                        <input type="text" id="email<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['email']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Pais </label>
                                                                                        <input type="text" id="pais<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['pais']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Provincia</label>
                                                                                        <input type="text" id="prov<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['provincia']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Localidad </label>
                                                                                        <input type="text" id="loc<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['ciudad']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Domicilio<b>*</b></label>
                                                                                        <input type="text" id="dom<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['calle']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nro<b>*</b></label>
                                                                                        <input type="text" id="num<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['numero']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Piso </label>
                                                                                        <input type="text" id="pis<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['piso']; ?>" disabled>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Depto<b>*</b></label>
                                                                                        <input type="text" id="dpto<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['depto']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>

                                                        <a href="updateemp.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        <a href="deleteemp.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i>Borrar</a>
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
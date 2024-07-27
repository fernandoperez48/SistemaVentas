<?php
include 'app/config.php';
include 'layaout/sesion.php';
if ($id_rol == "5") {
    header('Location: index.php');
}
include 'layaout/parte1.php';
include 'app/controllers/almacen/listado_de_productos.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Productos en stock criticos

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
                            <h3 class="card-title">Productos critico con menor stock que el minimo</h3>


                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th>
                                            <center>Id Producto</center>
                                        </th>
                                        <th>
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>Stock Actualr</center>
                                        </th>
                                        <th>
                                            <center>Stock Minimo</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($productos_datos as $producto) {
                                        $id_producto = $producto['id_producto'];
                                        $nombre = $producto['nombre'];
                                        $stock = $producto['stock'];
                                        $stock_minimo = $producto['stock_minimo'];

                                        // Verificar si el stock actual es menor que el stock mínimo
                                        if ($stock < $stock_minimo) { ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $id_producto; ?></center>
                                                </td>
                                                <td><?php echo $nombre; ?></td>
                                                <td>
                                                    <?php echo $stock; ?>
                                                </td>
                                                <td><?php echo $stock_minimo; ?></td>
                                            </tr>
                                    <?php
                                        }
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Productos critico con mayor stock que el máximo</h3>


                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th>
                                            <center>Id Producto</center>
                                        </th>
                                        <th>
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>Stock Actualr</center>
                                        </th>
                                        <th>
                                            <center>Stock Minimo</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($productos_datos as $producto) {
                                        $id_producto = $producto['id_producto'];
                                        $nombre = $producto['nombre'];
                                        $stock = $producto['stock'];
                                        $stock_maximo = $producto['stock_maximo'];


                                        // Verificar si el stock actual es mayor que el stock mínimo
                                        if ($stock > $stock_maximo) { ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $id_producto; ?></center>
                                                </td>
                                                <td><?php echo $nombre; ?></td>
                                                <td>
                                                    <?php echo $stock; ?>
                                                </td>
                                                <td><?php echo $stock_minimo; ?></td>
                                            </tr>
                                    <?php
                                        }
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
        <!-- Main content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <?php include 'layaout/mensajes.php'; ?>
    <?php include 'layaout/parte2.php'; ?>

</div>



<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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
                    text: 'Exportar',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        text: 'Imprimir',
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'


                }
            ],
            // "columnDefs": [{
            //     "targets": -1,
            //     "className": "no-export",
            //     "searchable": false
            // }]

            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
<script>
    $(function() {
        $("#example2").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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
                    text: 'Exportar',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }, {
                        text: 'Imprimir',
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.actions)'
                        }
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'


                }
            ],
            // "columnDefs": [{
            //     "targets": -1,
            //     "className": "no-export",
            //     "searchable": false
            // }]

            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
<!-- FIN SCRIPTSSS DE LA TABLA-->
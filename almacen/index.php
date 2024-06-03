<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Productos</h1>
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
                            <h3 class="card-title">Productos registrados</h3>

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
                                                <center>Codigo</center>
                                            </th>
                                            <th>
                                                <center>Categoria</center>
                                            </th>
                                            <th>
                                                <center>Imagen</center>
                                            </th>
                                            <th>
                                                <center>Nombre</center>
                                            </th>
                                            <th>
                                                <center>Descripcion</center>
                                            </th>
                                            <th>
                                                <center>Stock</center>
                                            </th>
                                            <th>
                                                <center>Precio Compra</center>
                                            </th>
                                            <th>
                                                <center>Precio Venta</center>
                                            </th>
                                            <th>
                                                <center>Fecha Compra</center>
                                            </th>
                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($productos_datos as $productos_datos) {
                                            $id_producto = $productos_datos['id_producto']; ?>
                                            <tr>
                                                <td>
                                                    <?php echo $productos_datos['id_producto']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['codigo']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['nombre_categoria']; ?>
                                                </td>
                                                <td>

                                                    <img src="<?php echo $URL . "/almacen/img_productos" . $productos_datos['imagen']; ?>" width="50px">

                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['nombre']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['descripcion']; ?>
                                                </td>
                                                <?php
                                                $stock_actual = $productos_datos['stock'];
                                                $stock_maximo = $productos_datos['stock_maximo'];
                                                $stock_minimo = $productos_datos['stock_minimo'];
                                                if ($stock_actual < $stock_minimo) { ?>
                                                    <td class="text-danger">
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                } else if ($stock_actual > $stock_maximo) { ?>
                                                    <td class="text-success">
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                } else { ?>
                                                    <td>
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <center><?php echo $productos_datos['precio_compra']; ?></center>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['precio_venta']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['fecha_ultimo_ingreso']; ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            <a href="show.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>Ver</a>
                                                            <a href="update.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                            <a href="delete.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
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
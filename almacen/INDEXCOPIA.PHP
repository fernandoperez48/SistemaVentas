<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
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
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Productos registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- <div class="card col-md-12">
                                <div class="card-header" style="background-color:#ffe8cd">
                                    <h3 class="card-title">Filtros</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                
                                <div class="card-body collapse">
                                    <div class="card col-md-2">
                                        <div class="card-header" style="background-color:#ffe8cd">
                                            <h3 class="card-title">Filtros de Precios</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body collapse show">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div>
                                                        <div class="col-md-6">
                                                            <input type="checkbox" id="priceCompra" checked> Precio Compra
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="checkbox" id="priceVenta"> Precio Venta
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row container-fluid">
                                                    <div class="form-group col-md-5">
                                                        <label for="minPrice">Precio mínimo:</label>
                                                        <input type="number" id="minPrice" class="form-control" placeholder="Precio mínimo">
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label for="maxPrice">Precio máximo:</label>
                                                        <input type="number" id="maxPrice" class="form-control" placeholder="Precio máximo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead style="background-color: gray;">
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
                                                <center>Proveedor</center>
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
                                                <center>Talle</center>
                                            </th>
                                            <th>
                                                <center>Color</center>
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
                                                    <?php echo $productos_datos['nombre_proveedor']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Asumiendo que $productos_datos['imagen'] contiene el valor del campo 'imagen'
                                                    $imageSrc = empty($productos_datos['imagen']) || is_null($productos_datos['imagen']) ? $URL . '/almacen/img/img_productossinimagen.jpg' : $URL . '/almacen/img/img_productos' . $productos_datos['imagen'];
                                                    ?>
                                                    <img src="<?php echo $imageSrc; ?>" width="50px" height="50px" data-toggle="modal" data-target="#imageModal<?php echo $productos_datos['id_producto']; ?>">
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="imageModal<?php echo $productos_datos['id_producto']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel<?php echo $productos_datos['id_producto']; ?>">Imagen del Producto</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="<?php echo $imageSrc; ?>" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <?php echo $productos_datos['nombre']; ?>
                                                </td>
                                                <?php
                                                $descripcion = $productos_datos['descripcion'];
                                                $maxLength = 60; // Número máximo de caracteres que deseas mostrar

                                                if (strlen($descripcion) > $maxLength) {
                                                    $descripcion = substr($descripcion, 0, $maxLength) . '...'; // Agrega '...' al final si el texto es más largo
                                                }
                                                ?>
                                                <td>
                                                    <?php echo $descripcion; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['talle']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['color']; ?>
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
                                                    <center>$ <?php echo $productos_datos['precio_compra']; ?></center>
                                                </td>
                                                <td>$ <?php echo $productos_datos['precio_venta']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['fecha_ultimo_ingreso']; ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            <a href="show.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>Ver</a>
                                                            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Encargado de compras") { ?>
                                                                <a href="update.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                            <?php } ?>
                                                            <?php if ($rol_sesion == "Administrador") { ?>
                                                                <a href="delete.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
                                                            <?php } ?>
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
    $(document).ready(function() {
        var table = $("#example1").DataTable({
            "pageLength": 5,
            searching: true,

            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
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
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [{
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
            "dom": '<"top"lfB><"filter-price">rt<"bottom"ip><"clear">'
        });

        // Añadir inputs en los encabezados de las columnas
        $('#example1 thead tr').clone(true).appendTo('#example1 thead');
        $('#example1 thead tr:eq(1) th').each(function() {
            var title = $(this).text().trim();

            // Especificar qué columnas no deberían tener filtros
            if (title !== 'Nro' && title !== 'Imagen' && title !== 'Acciones') {
                $(this).html('<input type="text" placeholder="Ingresar ' + '" style="width: 80%; box-sizing: border-box;" />');
            } else {
                $(this).html(''); // Deja la celda vacía para "Nro" y "Imagen"
            }

            $('input', this).on('keyup change', function() {
                table.column($(this).parent().index() + ':visible').search(this.value).draw();
            });
        });



        // Añadir los botones a DataTables
        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
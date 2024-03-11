<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/compras/listado_de_compras.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Compras</h1>
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
                            <h3 class="card-title">Compras registradas</h3>

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
                                                <center>Nro de la compra</center>
                                            </th>
                                            <th>
                                                <center>Producto</center>
                                            </th>
                                            <th>
                                                <center>Fecha de compra</center>
                                            </th>
                                            <th>
                                                <center>Proveedor</center>
                                            </th>
                                            <th>
                                                <center>Comprobante</center>
                                            </th>
                                            <th>
                                                <center>Usuario</center>
                                            </th>
                                            <th>
                                                <center>Precio Compra</center>
                                            </th>
                                            <th>
                                                <center>Cantidad</center>
                                            </th>

                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($compras_datos as $compras_datos) {
                                            $id_compra = $compras_datos['id_compra']; ?>
                                            <tr>
                                                <td>
                                                    <?php echo $contador += 1; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['nro_compra']; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-producto<?php echo $id_compra; ?>">
                                                    <?php echo $compras_datos['nombre_producto']; ?>
                                                    </button>

                                                    <!-- modal para visualizar producto-->
                                                    <div class="modal fade" id="modal-producto<?php echo $id_compra; ?>">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color:#446DF6; color:white">
                                                                        <h4 class="modal-title">Datos del producto</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-9">
                                                                            <div class="row">
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="">Codigo</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['codigo']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                    <label for="">Nombre del producto</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['nombre']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                    <label for="">Descripcion del producto</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['descripcion']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            </div>

                                                                            <div class="row">
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Stock</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['stock']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Stock minimo</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['stock_minimo']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                    <label for="">Stock maximo</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['stock_maximo']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                    <label for="">Fecha de ingreso</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['fecha_ingreso']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Precio compra</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['precio_compra_producto']?>" disabled>
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Precio venta</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['precio_venta_producto']?>" disabled>
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Categoria</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['nombre_categoria']?>" disabled>
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="">Usuario</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['nombre_usuarios_producto']?>" disabled>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                    <label for="">Imagen del producto</label>
                                                                                    <img src="<?php echo $URL."/almacen/img_productos".$compras_datos['imagen'] ;?>" width="100%" >
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                            
                                                                           
                                                                            </div>
                                
                                                                        
                                                                        
                                                                        

                                               


                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['fecha_compra']; ?>
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-proveedor<?php echo $id_compra; ?>">
                                                <?php echo $compras_datos['nombre_proveedor']; ?>
                                                    </button>
                                                    
                                                    <div class="modal fade" id="modal-proveedor<?php echo $id_compra; ?>">
                                                            <div class="modal-dialog ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color:#446DF6; color:white">
                                                                        <h4 class="modal-title">Datos del proveedor</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre del Proveedor</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['nombre_proveedor']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group
                                                                            ">
                                                                                    <label for="">Empresa</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['empresa']?>" disabled>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Telefono del proveedor</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['telefono_proveedor']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group
                                                                            ">
                                                                                    <label for="">Celular</label>
                                                                                    <a href="https://wa.me/54<?php echo $compras_datos['celular_proveedor']?>" target="_blank" class="btn btn-success">
                                                                                    <i class="fa fa-phone"></i>
                                                                                    <?php echo $compras_datos['celular_proveedor']?>
                                                                                    </a>
                                                                                    
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Email</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['email_proveedor']?>" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group
                                                                            ">
                                                                                    <label for="">Direccion</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $compras_datos['direccion_proveedor']?>" disabled>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                            
                                                                        </div>
                                                                        
                                                                            </div>
                                                                            </div>
                                                                            
                                                                           
                                                                            </div>
                                
                                                                        
                                                                        
                                                                        

                                               


                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>

                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['comprobante']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['nombres_usuario']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['precio_compra']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compras_datos['cantidad']; ?>
                                                </td>
                                                <center>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="show.php?id=<?php echo $id_compra; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>Ver</a>
                                                            <a href="update.php?id=<?php echo $id_compra; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                            <a href="delete.php?id=<?php echo $id_compra; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Compras",
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
<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';

include '../app/controllers/almacen/cargar_producto.php';


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Datos del producto: <?php echo $nombre; ?></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-danger">
                    <div class="card-header" style="background-color:orange">
                        <h3 class="card-title">Datos del Producto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    golass
                    <div class="card-body" style="display: block;">
                        gola
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Codigo:</label>
                                                    <input type="text" class="form-control" value="<?php echo $codigo; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Categoria:</label>
                                                    <div style="display: flex;">
                                                        <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre del producto:</label>
                                                    <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Descripcion del producto:</label>
                                                    <textarea name="descripcion" id="" cols="40" rows="5" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="row container-fluid justify-content-between">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Talle:</label>
                                                        <input type="text" name="talle" value="<?php echo $talle; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Color:</label>
                                                        <input type="text" name="color" value="<?php echo $color; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Proveedor:</label>
                                                        <input type="text" name="proveedor" value="<?php echo $proveedor; ?>" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row container-fluid justify-content-between">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number" name="stock" class="form-control" value="<?php echo $stock; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Stock minimo:</label>
                                                        <input type="number" name="stock_minimo" class="form-control" disabled value="<?php echo $stock_minimo; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Stock maximo:</label>
                                                        <input type="number" name="stock_maximo" class="form-control" disabled value="<?php echo $stock_maximo; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Fecha de carga:</label>
                                                        <input type="date" name="fecha_carga" class="form-control" disabled value="<?php echo $fecha_carga; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row container-fluid justify-content-between">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="number" name="precio_compra" class="form-control" disabled value="<?php echo $precio_compra; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="number" name="precio_venta" class="form-control" disabled value="<?php echo $precio_venta; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Fecha del ultimo ingreso :</label>
                                                        <input type="date" name="fecha_ultimo_ingreso" class="form-control" disabled value="<?php echo $fecha_ultimo_ingreso; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Imagen del producto:</label>
                                                        <center>
                                                            <img src="<?php echo $URL . '/almacen/img/img_productos' . $productos_datos['imagen']; ?>" width="150px" data-toggle="modal" data-target="#imageModal">
                                                        </center>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="imageModalLabel">Imagen del Producto</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <center>
                                                                    <img src="<?php echo $URL . '/almacen/img/img_productos' . $productos_datos['imagen']; ?>" class="img-fluid">
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario: </label><?php echo $email ?>
                                                <input type="text" class="form-control" value="<?php echo $email ?>" hidden>
                                                <input type="text" name="id_usuario" value="<?php echo $id_usuario ?>" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a href="index.php" class="btn btn-secondary">Volver</a>

                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

</div>

<!-- Main content -->

<!-- /.content-wrapper -->
<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>
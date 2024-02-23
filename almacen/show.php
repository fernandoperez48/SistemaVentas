<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';

include '../app/controllers/almacen/cargar_producto.php';


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos del Producto</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Codigo:</label>
                                                <input type="text" class="form-control" value="<?php echo $codigo; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Categoria:</label>
                                                <div style="display: flex;">
                                                    
                                                    <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Imagen del producto:</label>
                                                    <center>
                                                        <img src="<?php echo $URL."/almacen/img_productos".$productos_datos['imagen'] ;?>" width="200px">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $email ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del producto:</label>
                                                <textarea name="descripcion" id="" cols="30" rows="3" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                            </div>
                                        </div>
                                    </div>








                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" name="stock" class="form-control" value="<?php echo $stock; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock minimo:</label>
                                                <input type="number" name="stock_minimo" class="form-control" disabled value="<?php echo $stock_minimo; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock maximo:</label>
                                                <input type="number" name="stock_maximo" class="form-control" disabled value="<?php echo $stock_maximo; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="number" name="precio_compra" class="form-control" disabled value="<?php echo $precio_compra; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio venta:</label>
                                                <input type="number" name="precio_venta" class="form-control" disabled value="<?php echo $precio_venta; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso:</label>
                                                <input type="date" name="fecha_ingreso" class="form-control" disabled value="<?php echo $fecha_ingreso; ?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <br>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                          
                        </div>
                       
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
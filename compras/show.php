<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';

include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/compras/cargar_compra.php';
?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Compra nro <?php echo $nro_compra; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la compra</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                   
                                    
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row" style="font-size:12px">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" id="id_producto" hidden>
                                                <label for="">Codigo:</label>
                                                <input type="text" value="<?php echo $codigo; ?>" class="form-control" id="codigo" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Categoria:</label>
                                                <div style="display: flex;">

                                                    <input type="text" value="<?php echo $nombre_categoria;?>" class="form-control" id="categoria" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" value="<?php echo $nombre_producto; ?>" name="nombre" id="nombre_producto" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del producto:</label>
                                                <center>
                                                    <img src="<?php echo $URL."/almacen/img_productos".$imagen?>" id="img_producto" width="50%">
                                                </center>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" value="<?php echo $nombre_usuarios_producto; ?>" class="form-control" id="usuario_producto" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del producto:</label>
                                                <textarea name="descripcion" id="descripcion_producto" cols="30" rows="3" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" value="<?php echo $stock; ?>" name="stock" class="form-control" id="stock" disabled style="background-color: #d1c53b;">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock minimo:</label>
                                                <input type="number" value="<?php echo $stock_minimo; ?>" name="stock_minimo" class="form-control" disabled id="stock_minimo">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock maximo:</label>
                                                <input type="number" value="<?php echo $stock_maximo; ?>" name="stock_maximo" class="form-control" disabled id="stock_maximo">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="number" value="<?php echo $precio_compra_producto; ?>" name="precio_compra" class="form-control" disabled id="precio_compra">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio venta:</label>
                                                <input type="number" value="<?php echo $precio_venta_producto; ?>" name="precio_venta" class="form-control" disabled id="precio_venta">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso:</label>
                                                <input type="date" value="<?php echo $fecha_ingreso; ?>" name="fecha_ingreso" class="form-control" disabled id="fecha_ingreso">
                                            </div>
                                        </div>


                                    </div>

                                    <hr>
                                    <div style="display:flex">
                                        <h5>Datos del Proveedor</h5>
                                        <div style="width: 20px;"></div>
                                        
                                        <!-- /.modal-content -->
                                    </div>

                                    <hr>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nombre del proveedor </label>
                                                    <input type="text" value="<?php echo $nombre_proveedor; ?>" id="id_proveedor" class="form-control" disabled>
                                                    <input type="text" id="id_proveedor" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="number" value="<?php echo $celular_proveedor; ?>" id="celular" class="form-control" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Telefono</label>
                                                    <input type="number" value="<?php echo $telefono_proveedor; ?>" id="telefono" class="form-control" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Empresa<b>*</b></label>
                                                    <input type="email" value="<?php echo $empresa_proveedor; ?>" id="empresa" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email </label>
                                                    <input type="text" value="<?php echo $email_proveedor; ?>" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Direccion</label>
                                                    <input type="text" value="<?php echo $direccion_proveedor; ?>" id="direccion" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-3">



                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle de la compra</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Numero de la compra</label>
                                                <input type="text" style="text-align: center;" class="form-control" value="<?php echo $id_compra_get; ?>" disabled>
                                                <input type="text" id="nro_compra" value="<?php echo $id_compra_get; ?>" hidden>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Fecha de la compra</label>
                                                <input type="date" value="<?php echo $fecha_compra; ?>" class="form-control" id="fecha_compra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comprobante de la compra</label>
                                                <input type="text" value="<?php echo $comprobante; ?>" class="form-control" id="comprobante" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Precio de la compra</label>
                                                <input type="text" value="<?php echo $precio_compra; ?>" class="form-control" id="precio_compra_controlador" style="text-align: center;" disabled>
                                            </div>
                                        </div>                                       

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Cantidad de la compra</label>
                                                <input type="number" value="<?php echo $cantidad; ?>" style="text-align: center;" class="form-control" id="cantidad_compra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $email_session; ?>" disabled>
                                                <input type="text" id="id_usuario" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                   
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                   

                </div>
            </div>

        </div>
    </div>
    <!-- Main content -->

    <!-- /.content-wrapper -->
    <?php include '../layaout/mensajes.php'; ?>
    <?php include '../layaout/parte2.php'; ?>

   
<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/listado_de_ventas.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo Envio</h1>
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
                        <h3 class="card-title">Llene los datos...</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->

                    <!-- inicio -->
                    <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fas fa-search"></i>
                                    Buscar Venta
                                </button>


                                <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->
                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#446DF6; color:white">
                                                <h4 class="modal-title">Busqueda de ventas</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <center>Nro</center>
                                                                </th>
                                                                <th>
                                                                    <center>Seleccionar</center>
                                                                </th>
                                                                <th>
                                                                    <center>Nro Venta</center>
                                                                </th>
                                                                <th>
                                                                    <center>Productos</center>
                                                                </th>
                                                                <th>
                                                                    <center>Cliente</center>
                                                                </th>
                                                                <th>
                                                                    <center>Total Pagado</center>
                                                                </th>
                                                                <th>
                                                                    <center>Fecha</center>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $contador = 0;
                                                            foreach ($ventas_datos as $ventas_datos) {
                                                                $id_venta = $ventas_datos['nro_venta']; ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $contador += 1; ?>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-info" id="btn_seleccionar<?php echo $ventas_datos['nro_venta']; ?>">Seleccionar</button>
                                                                        <script>
                                                                            $("#btn_seleccionar<?php echo $ventas_datos['nro_venta']; ?>").click(function() {
                                                                                $("#codigo_venta").val("<?php echo $ventas_datos['nro_venta']; ?>"); 
                                                                               $('#cantidad').focus();


                                                                                $("#modal-buscar_producto").modal("hide");
                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $ventas_datos['nro_venta']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <center>
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta; ?>">
                                                                                <i class="fa fa-shopping-basket"></i> Productos
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="Modal_productos<?php echo $id_venta; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header" style="background-color: #08c2ec">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $ventas_datos['nro_venta']; ?></h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-bordered table-sm table-hover table-striped">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Nro</th>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Producto</th>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Detalle</th>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Cantidad</th>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Precio Unitario</th>
                                                                                                            <th style="background-color: #e7e7e7; text-align:center;">Precio Subtotal</th>

                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php
                                                                                                        $contador_carrito = 0;
                                                                                                        $cantidad_total = 0;
                                                                                                        $precio_unitario_total = 0;
                                                                                                        $precio_total = 0;
                                                                                                        $nro_venta = $ventas_datos['nro_venta'];
                                                                                                        $sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                                                                                                                        from tb_carrito as carr 
                                                                                                                        inner join tb_almacen as pro on carr.id_producto = pro.id_producto 
                                                                                                                        where nro_venta = '$nro_venta' 
                                                                                                                        order by carr.id_carrito";
                                                                                                        $query_carrito = $pdo->prepare($sql_carrito);
                                                                                                        $query_carrito->execute();
                                                                                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                                                                                        foreach ($carrito_datos as $carrito_datos) {
                                                                                                            $id_carrito = $carrito_datos['id_carrito'];
                                                                                                            $contador_carrito = $contador_carrito + 1;
                                                                                                            $cantidad_total = $cantidad_total + $carrito_datos['cantidad'];
                                                                                                            $precio_unitario_total = $precio_unitario_total + $carrito_datos['precio_venta'];
                                                                                                            $precio_total = $precio_total + ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
                                                                                                        ?>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <center><?php echo $contador_carrito; ?></center>
                                                                                                                    <input type="text" value="<?php echo $carrito_datos['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <center><?php echo $carrito_datos['nombre_producto']; ?></center>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <center><?php echo $carrito_datos['descripcion']; ?></center>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito_datos['cantidad']; ?></span></center>
                                                                                                                    <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito_datos['stock']; ?>" hidden>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <center><?php echo $carrito_datos['precio_venta']; ?></center>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <center>
                                                                                                                        <?php
                                                                                                                        $cantidad = floatval($carrito_datos['cantidad']);
                                                                                                                        $precio_venta = floatval($carrito_datos['precio_venta']);
                                                                                                                        echo $subtotal = $cantidad * $precio_venta;
                                                                                                                        ?>
                                                                                                                    </center>
                                                                                                                </td>

                                                                                                            </tr>
                                                                                                        <?php
                                                                                                        }
                                                                                                        ?>

                                                                                                        <tr>
                                                                                                            <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                                                                                            <th>
                                                                                                                <center>
                                                                                                                    <?php
                                                                                                                    echo $cantidad_total;
                                                                                                                    ?>
                                                                                                                </center>
                                                                                                            </th>
                                                                                                            <th>
                                                                                                                <center>
                                                                                                                    <?php
                                                                                                                    echo $precio_unitario_total;
                                                                                                                    ?>
                                                                                                                </center>
                                                                                                            </th>
                                                                                                            <th style="background-color: yellow;">
                                                                                                                <center>
                                                                                                                    <?php
                                                                                                                    echo $precio_total;
                                                                                                                    ?>
                                                                                                                </center>
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div> <!-- Button trigger modal -->


                                                                        </center>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $ventas_datos['nombre'].' ' .$ventas_datos['apellido']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo '$' . $ventas_datos['total_pagado']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $ventas_datos['fyh_creacion']; ?>
                                                                    </td>

                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <br><br>

                            </div>


                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="../app/controllers/envios/create.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $email_session ?>" disabled>
                                                <input type="text" name="id_usuario" value="<?php echo $id_usuarios_sesion ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del Envio:</label>
                                                <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>          
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Codigo Venta</label>
                                                <input type="text" name="codigo_venta" value="" id="codigo_venta" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Direccion de envio</label>
                                                <input type="text" name="Direccion" id="Direccion" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de Envio:</label>
                                                <input type="date" name="fecha_envio" id="fecha_envio" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" name="estado" id="estado">
                                                <option value="Pendiente de envio">Pendiente de envío</option>
                                                <option value="Enviado">Enviado</option>
                                                <option value="Entregado">Entregado</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <br>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        </form>
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
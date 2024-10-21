<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/mostrar_ventas_con_anuladas.php';
include '../app/controllers/ventas/listado_de_ventas.php';




?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Ventas realizadas</h1>
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
                            <h3 class="card-title">Ventas registradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th>
                                                <center>Nro</center>
                                            </th>
                                            <th>
                                                <center>Nro de venta</center>
                                            </th>
                                            <th>
                                                <center>Productos</center>
                                            </th>
                                            <th>
                                                <center>Cliente</center>
                                            </th>
                                            <th>
                                                <center>Total pagado</center>
                                            </th>
                                            <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) { ?>
                                                <th>
                                                    <center>Estado</center>
                                                </th>
                                            <?php } ?>
                                            <th>
                                                <center>Factura</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) {

                                            $contador = 0;
                                            foreach ($ventas_datos as $venta) {
                                                $id_venta = $venta['nro_venta'];
                                                $id_cliente = $venta['id_cliente'];
                                                $nombreApellido = $venta['nombre'] . ' ' . $venta['apellido'];
                                                $contador++;
                                        ?>
                                                <tr>
                                                    <td>
                                                        <center> <?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $venta['nro_venta']; ?></center>
                                                    </td>
                                                    <td><!-- INICIO DE BOTON PRODUCTOS -->
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
                                                                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $id_venta; ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" id="searchInput<?php echo $venta['nro_venta']; ?>" class="form-control" placeholder="Buscar...">
                                                                                    </div>
                                                                                    <div class="col-md-6 text-right">
                                                                                        <span id="recordCount<?php echo $venta['nro_venta']; ?>"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <table id="tabla_productos<?php echo $venta['nro_venta']; ?>" class="table table-bordered table-sm table-hover table-striped">
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
                                                                                        $nro_venta = $venta['nro_venta'];
                                                                                        $sql_carrito = "SELECT carr.*, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                                                                FROM tb_carrito as carr 
                                                                INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                                                                WHERE nro_venta = '$nro_venta' 
                                                                ORDER BY carr.id_carrito";
                                                                                        $resultado_carrito = $mysqli->query($sql_carrito);

                                                                                        if ($resultado_carrito) {
                                                                                            $carrito_datos = $resultado_carrito->fetch_all(MYSQLI_ASSOC);

                                                                                            foreach ($carrito_datos as $carrito) {
                                                                                                $id_carrito = $carrito['id_carrito'];
                                                                                                $contador_carrito++;
                                                                                                $cantidad_total += $carrito['cantidad'];
                                                                                                $precio_unitario_total += $carrito['precio_venta'];
                                                                                                $precio_total += ($carrito['cantidad'] * $carrito['precio_venta']);
                                                                                        ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <center><?php echo $contador_carrito; ?></center>
                                                                                                        <input type="text" value="<?php echo $carrito['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><?php echo $carrito['nombre_producto']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><?php echo $carrito['descripcion']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito['cantidad']; ?></span></center>
                                                                                                        <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito['stock']; ?>" hidden>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center>$ <?php echo $carrito['precio_venta']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center>$ <?php echo $subtotal = floatval($carrito['cantidad']) * floatval($carrito['precio_venta']); ?></center>
                                                                                                    </td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        } else {
                                                                                            echo "Error en la consulta: " . $mysqli->error;
                                                                                        }
                                                                                        ?>

                                                                                        <tr class="total-row">
                                                                                            <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                                                                            <th>
                                                                                                <center><?php echo $cantidad_total; ?></center>
                                                                                            </th>
                                                                                            <th>
                                                                                                <center>$ <?php echo $precio_unitario_total; ?></center>
                                                                                            </th>
                                                                                            <th style="background-color: yellow;">
                                                                                                <center>$ <?php echo $precio_total; ?></center>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i> <?php echo $nombreApellido ?></a>
                                                                <!-- modal para ver clientes-->
                                                                <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header" style="background-color:#088da5; color:white">
                                                                                <h4 class="modal-title">Datos del cliente</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <?php { ?>
                                                                                <div class="modal-body">

                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Nombre y Apellido</label>
                                                                                                <input type="text" value="<?php echo $nombreApellido ?>" class="form-control text-center" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <?php if (!empty($venta['cuit'])) : ?>
                                                                                                    <label>CUIT</label>
                                                                                                <?php else : ?>
                                                                                                    <label>DNI</label>
                                                                                                <?php endif; ?>
                                                                                                <input type="text" value="<?php echo $venta['cuitDni'] ?>" class="form-control text-center" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <label>Telefono</label>
                                                                                                <input type="number" class="form-control text-center" value="<?php echo $venta['telefono'] ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Email</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['email']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <?php if (!empty($venta['cuit'])) { ?>
                                                                                                    <label>Persona Autorizada</label>
                                                                                                    <input type="text" class="form-control text-center" value="<?php echo $venta['persona_autorizada']; ?>" disabled>
                                                                                                <?php } else { ?>
                                                                                                    <!-- Adding an empty div to maintain structure -->
                                                                                                    <div style="visibility: hidden;">
                                                                                                        <label>Hidden Label</label>
                                                                                                        <input type="text" class="form-control text-center" value="" disabled>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <hr>
                                                                                    <h5>Datos Domicilio</h5>

                                                                                    <div class="row justify-content-between">
                                                                                        <div class=" col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Calle</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['calle']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Nro</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['numero']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Piso </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['piso']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Depto</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['depto']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Localidad </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['ciudad']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Provincia</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['provincia']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Pais </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $venta['pais']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>$ <?php echo $venta['total_pagado']; ?></center>
                                                    </td>
                                                    <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) { ?>
                                                        <td>
                                                            <center>

                                                                <?php if ($venta['estado'] != 'anulada') { ?>
                                                                    <button type="button" class="btn btn-danger" onclick="anularVenta('<?php echo $venta['nro_venta']; ?>')">
                                                                        <i class="fa fa-ban"></i> Anular
                                                                    </button>
                                                                <?php } else { ?>
                                                                    <button type="button" class="btn btn-danger" disabled>
                                                                        <i class="fa fa-check-circle"></i> Anulada
                                                                    </button>
                                                                <?php } ?>

                                                            </center>
                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                            <script>
                                                                function anularVenta(nro_venta) {
                                                                    if (confirm("¿Está seguro de que desea anular esta venta?")) {
                                                                        $.ajax({
                                                                            url: '../app/controllers/ventas/anular_venta.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                nro_venta: nro_venta
                                                                            },
                                                                            success: function(response) {
                                                                                alert(response); // Mostrar mensaje de éxito o error
                                                                                location.reload(); // Recargar la página para ver los cambios
                                                                            },
                                                                            error: function(xhr, status, error) {
                                                                                console.error('Error:', error);
                                                                                alert('Ocurrió un error al intentar anular la venta.');
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                            </script>
                                                        </td>
                                                        <td>
                                                            <center><a href="factura1.php?nro_venta=<?php echo $nro_venta;?>" class="btn btn-success"><i class="fa fa-print"> Imprimir</i></a></center>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                        } else {
                                            $contador = 0;
                                            foreach ($mostrar_ventas_datos as $listado_con_anuladas_venta) {
                                                $id_venta = $listado_con_anuladas_venta['nro_venta'];
                                                $id_cliente = $listado_con_anuladas_venta['id_cliente'];
                                                $nombreApellido = $listado_con_anuladas_venta['nombre'] . ' ' . $listado_con_anuladas_venta['apellido'];
                                                $contador++;
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center> <?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $listado_con_anuladas_venta['nro_venta']; ?></center>
                                                    </td>
                                                    <td><!-- INICIO DE BOTON PRODUCTOS -->
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
                                                                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $id_venta; ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="table-responsive">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" id="searchInput<?php echo $listado_con_anuladas_venta['nro_venta']; ?>" class="form-control" placeholder="Buscar...">
                                                                                    </div>
                                                                                    <div class="col-md-6 text-right">
                                                                                        <span id="recordCount<?php echo $listado_con_anuladas_venta['nro_venta']; ?>"></span>
                                                                                    </div>
                                                                                </div>
                                                                                <table id="tabla_productos<?php echo $listado_con_anuladas_venta['nro_venta']; ?>" class="table table-bordered table-sm table-hover table-striped">
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
                                                                                        $nro_venta = $listado_con_anuladas_venta['nro_venta'];
                                                                                        $sql_carrito = "SELECT carr.*, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                                                                FROM tb_carrito as carr 
                                                                INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                                                                WHERE nro_venta = '$nro_venta' 
                                                                ORDER BY carr.id_carrito";
                                                                                        $resultado_carrito = $mysqli->query($sql_carrito);

                                                                                        if ($resultado_carrito) {
                                                                                            $carrito_datos = $resultado_carrito->fetch_all(MYSQLI_ASSOC);

                                                                                            foreach ($carrito_datos as $carrito) {
                                                                                                $id_carrito = $carrito['id_carrito'];
                                                                                                $contador_carrito++;
                                                                                                $cantidad_total += $carrito['cantidad'];
                                                                                                $precio_unitario_total += $carrito['precio_venta'];
                                                                                                $precio_total += ($carrito['cantidad'] * $carrito['precio_venta']);
                                                                                        ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <center><?php echo $contador_carrito; ?></center>
                                                                                                        <input type="text" value="<?php echo $carrito['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><?php echo $carrito['nombre_producto']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><?php echo $carrito['descripcion']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito['cantidad']; ?></span></center>
                                                                                                        <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito['stock']; ?>" hidden>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center>$ <?php echo $carrito['precio_venta']; ?></center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <center>$ <?php echo $subtotal = floatval($carrito['cantidad']) * floatval($carrito['precio_venta']); ?></center>
                                                                                                    </td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        } else {
                                                                                            echo "Error en la consulta: " . $mysqli->error;
                                                                                        }
                                                                                        ?>

                                                                                        <tr class="total-row">
                                                                                            <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                                                                            <th>
                                                                                                <center><?php echo $cantidad_total; ?></center>
                                                                                            </th>
                                                                                            <th>
                                                                                                <center>$ <?php echo $precio_unitario_total; ?></center>
                                                                                            </th>
                                                                                            <th style="background-color: yellow;">
                                                                                                <center>$ <?php echo $precio_total; ?></center>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i> <?php echo $nombreApellido ?></a>
                                                                <!-- modal para ver clientes-->
                                                                <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header" style="background-color:#088da5; color:white">
                                                                                <h4 class="modal-title">Datos del cliente</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <?php { ?>
                                                                                <div class="modal-body">

                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Nombre y Apellido</label>
                                                                                                <input type="text" value="<?php echo $nombreApellido ?>" class="form-control text-center" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <?php if (!empty($listado_con_anuladas_venta['cuit'])) : ?>
                                                                                                    <label>CUIT</label>
                                                                                                <?php else : ?>
                                                                                                    <label>DNI</label>
                                                                                                <?php endif; ?>
                                                                                                <input type="text" value="<?php echo $listado_con_anuladas_venta['cuitDni'] ?>" class="form-control text-center" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <label>Telefono</label>
                                                                                                <input type="number" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['telefono'] ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Email</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['email']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <?php if (!empty($venta['cuit'])) { ?>
                                                                                                    <label>Persona Autorizada</label>
                                                                                                    <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['persona_autorizada']; ?>" disabled>
                                                                                                <?php } else { ?>
                                                                                                    <!-- Adding an empty div to maintain structure -->
                                                                                                    <div style="visibility: hidden;">
                                                                                                        <label>Hidden Label</label>
                                                                                                        <input type="text" class="form-control text-center" value="" disabled>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <hr>
                                                                                    <h5>Datos Domicilio</h5>

                                                                                    <div class="row justify-content-between">
                                                                                        <div class=" col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Calle</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['calle']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Nro</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['numero']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Piso </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['piso']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group">
                                                                                                <label>Depto</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['depto']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Localidad </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['ciudad']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Provincia</label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['provincia']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label>Pais </label>
                                                                                                <input type="text" class="form-control text-center" value="<?php echo $listado_con_anuladas_venta['pais']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>$ <?php echo $listado_con_anuladas_venta['total_pagado']; ?></center>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
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
<!-- /.content -->
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los elementos de búsqueda y conteo de registros por cada modal de productos
        <?php foreach ($ventas_datos as $ventas_datos) { ?>
            const searchInput<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('searchInput<?php echo $ventas_datos['nro_venta']; ?>');
            const tabla_productos<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('tabla_productos<?php echo $ventas_datos['nro_venta']; ?>').getElementsByTagName('tbody')[0];
            const recordCount<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('recordCount<?php echo $ventas_datos['nro_venta']; ?>');

            searchInput<?php echo $ventas_datos['nro_venta']; ?>.addEventListener('keyup', function() {
                const filter = searchInput<?php echo $ventas_datos['nro_venta']; ?>.value.toLowerCase();
                let visibleRows = 0;

                Array.from(tabla_productos<?php echo $ventas_datos['nro_venta']; ?>.getElementsByTagName('tr')).forEach(function(row) {
                    if (row.classList.contains('total-row')) {
                        return;
                    }
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    Array.from(cells).forEach(function(cell) {
                        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                        }
                    });

                    if (match) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                recordCount<?php echo $ventas_datos['nro_venta']; ?>.textContent = `Productos encontrados: ${visibleRows}`;
            });

            // Inicializa el contador de registros excluyendo la fila de total
            const initialCount<?php echo $ventas_datos['nro_venta']; ?> = Array.from(tabla_productos<?php echo $ventas_datos['nro_venta']; ?>.getElementsByTagName('tr')).filter(row => !row.classList.contains('total-row')).length;
            recordCount<?php echo $ventas_datos['nro_venta']; ?>.textContent = `Cantidad de Productos: ${initialCount<?php echo $ventas_datos['nro_venta']; ?>}`;
        <?php } ?>
    });
</script>
<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/envios/listado_de_envios.php';
include '../app/controllers/ventas/listado_de_ventas.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Envios
                        <a <?php if ($rol_sesion != "Administrador" || $id_usuarios_sesion == "4") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" href="<?php echo $URL ?>/envios/create.php">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </a>
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
                            <h3 class="card-title">Envios registrados</h3>

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
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th><center>Nro</center></th>
                                            <th><center>Nro Venta</center></th>
                                            <th><center>Cliente</center></th>
                                            <th><center>Fecha compra</center></th>
                                            <th><center>Dirección Cliente</center></th>
                                            <th><center>Dirección Envio</center></th>
                                            <th><center>Precio</center></th>
                                            <th><center>Estado</center></th>
                                            <th><center>Cargado por</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                    </thead>
                                    <tbody id= "envios-body">
                                        <?php
                                        $contador = 0;
                                        foreach ($envios_datos as $envios_datos) {
                                            $id_envio = $envios_datos['IdVenta']; ?>
                                            <tr>
                                                <td>
                                                    <?php echo $contador += 1; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_envio; ?>">
                                                        <i class="fa fa-shopping-basket"></i>
                                                        <?php echo $envios_datos['nro_venta']; ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['fyh_creacion']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['calle'] . ' ' . $envios_datos['numero']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['Direccion']; ?>
                                                </td>
                                                <td>
                                                    <?php echo '$' . $envios_datos['total_pagado']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['estado']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $envios_datos['nombre_usuario']; ?>
                                                </td>
                                                <td>
                                                    <center>


                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_envio; ?>">
                                                                <i class="fa fa-pencil-alt"></i>
                                                                Editar
                                                            </button>
                                                            <!-- modal para actualizar proveedores-->
                                                            <div class="modal fade" id="modal-update<?php echo $id_envio; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                            <h4 class="modal-title">Actualizacion del envio</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre del cliente</label>
                                                                                        <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Fecha compra</label>
                                                                                        <input type="text" id="fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Direccion de envio</label>
                                                                                        <input type="text" id="direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_direccion<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Total Pagado</label>
                                                                                        <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="estado">Estado <b>*</b></label>
                                                                                        <select class="form-control" name="estado" id="estado<?php echo $id_envio; ?>" value="<?php echo $envios_datos['estado']; ?>">
                                                                                            <option value="Pendiente de envio">Pendiente de envío</option>
                                                                                            <option value="Enviado">Enviado</option>
                                                                                            <option value="Entregado">Entregado</option>
                                                                                        </select>
                                                                                        <small style="color:red; display:none" id="lbl_estado<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-success" id="btn_update<?php echo $id_envio; ?>">Actualizar</button>
                                                                            <div id="respuesta_update"></div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <script>
                                                                $('#btn_update<?php echo $id_envio; ?>').click(function() {

                                                                    var id_envio = '<?php echo $id_envio; ?>';
                                                                    var direccion = $('#direccion<?php echo $id_envio; ?>').val();
                                                                    var estado = $('#estado<?php echo $id_envio; ?>').val();

                                                                    if (direccion == '') {
                                                                        $('#direccion<?php echo $id_envio; ?>').focus();
                                                                        $('#lbl_direccion<?php echo $id_envio; ?>').css('display', 'block');
                                                                    } else if (estado == '') {
                                                                        $('#estado<?php echo $id_envio; ?>').focus();
                                                                        $('#lbl_estado<?php echo $id_envio; ?>').css('display', 'block');
                                                                    } else {
                                                                        var url = "../app/controllers/envios/update.php";
                                                                        $.get(url, {
                                                                            id_envio: id_envio,
                                                                            direccion: direccion,
                                                                            estado: estado
                                                                        }, function(datos) {
                                                                            $('#respuesta_update').html(datos);
                                                                        });
                                                                    }


                                                                });
                                                            </script>
                                                        </div>


                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_envio; ?>">
                                                                <i class="fa fa-trash"></i>
                                                                Borrar
                                                            </button>
                                                            <!-- modal para borrar Envios-->
                                                            <div class="modal fade" id="modal-delete<?php echo $id_envio; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:red; color:white">
                                                                            <h4 class="modal-title">¿Esta seguro de eliminar al envio?</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre del cliente <b>*</b></label>
                                                                                        <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_nombre<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Fecha compra <b>*</b></label>
                                                                                        <input type="text" id="Fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Direccion de envio<b>*</b></label>
                                                                                        <input type="text" id="Direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Total Pagado<b>*</b></label>
                                                                                        <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Estado <b>*</b></label>
                                                                                        <input type="text" id="estado<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['estado']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>




                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_envio; ?>">Eliminar</button>
                                                                            <div id="respuesta_delete<?php echo $id_envio; ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>

                                                            <!-- modal buscar producto-->

                                                            <div class="modal fade" id="Modal_productos<?php echo $id_envio; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #08c2ec">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $envios_datos['nro_venta']; ?></h5>
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
                                                                                        $nro_venta = $envios_datos['nro_venta'];
                                                                                        $sql_carrito = "SELECT *, pro.nombre AS nombre_producto, pro.descripcion AS descripcion, pro.precio_venta AS precio_venta, pro.stock AS stock, pro.id_producto AS id_producto 
                                                                                                                    FROM tb_carrito AS carr 
                                                                                                                    INNER JOIN tb_almacen AS pro ON carr.id_producto = pro.id_producto 
                                                                                                                    WHERE nro_venta = '$nro_venta' 
                                                                                                                    ORDER BY carr.id_carrito";

                                                                                        $resultado_carrito = $mysqli->query($sql_carrito);

                                                                                        if ($resultado_carrito) {
                                                                                            while ($carrito_datos = $resultado_carrito->fetch_assoc()) {
                                                                                                $id_carrito = $carrito_datos['id_carrito'];
                                                                                                $contador_carrito += 1;
                                                                                                $cantidad_total += $carrito_datos['cantidad'];
                                                                                                $precio_unitario_total += $carrito_datos['precio_venta'];
                                                                                                $precio_total += ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
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
                                                                                        } else {
                                                                                            echo "Error al ejecutar la consulta: " . $mysqli->error;
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

                                                            <!-- fin modal buscar producto -->

                                                            <script>
                                                                $('#btn_delete<?php echo $id_envio; ?>').click(function() {

                                                                    var id_envio = '<?php echo $id_envio; ?>';

                                                                    var url2 = "../app/controllers/envios/delete.php";
                                                                    $.get(url2, {
                                                                        id_envio: id_envio
                                                                    }, function(datos) {
                                                                        $('#respuesta_delete<?php echo $id_envio; ?>').html(datos);
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </center>
                                                </td>
                                                <td>
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

<!-- Inicio endpoint -->
<script>
        fetch('http://localhost:3000/api/envios')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('envios-body');
                data.forEach((envios, index) => {
                    const row = `
                        <tr>
                            <td><center>${index + 1}</center></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_envio; ?>">
                                    <i class="fa fa-shopping-basket"></i>
                                        ${envios.nro_venta}
                                </button>
                            </td>
                            <td>${envios.nombre} ${envios.apellido}</td>
                            <td>${envios.fyh_creacion}</td>
                            <td>${envios.calle} ${envios.numero}</td>
                            <td>${envios.Direccion}</td>
                            <td>$${envios.total_pagado}</td>
                            <td>${envios.estado}</td>
                            <td>${envios.nombre_usuario}</td>
                            <td><center>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_envio; ?>">
                                                                <i class="fa fa-pencil-alt"></i>
                                                                Editar
                                                            </button>
                                                            <!-- modal para actualizar proveedores-->
                                                            <div class="modal fade" id="modal-update<?php echo $id_envio; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                            <h4 class="modal-title">Actualizacion del envio</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre del cliente</label>
                                                                                        <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Fecha compra</label>
                                                                                        <input type="text" id="fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Direccion de envio</label>
                                                                                        <input type="text" id="direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_direccion<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Total Pagado</label>
                                                                                        <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="estado">Estado <b>*</b></label>
                                                                                        <select class="form-control" name="estado" id="estado<?php echo $id_envio; ?>" value="<?php echo $envios_datos['estado']; ?>">
                                                                                            <option value="Pendiente de envio">Pendiente de envío</option>
                                                                                            <option value="Enviado">Enviado</option>
                                                                                            <option value="Entregado">Entregado</option>
                                                                                        </select>
                                                                                        <small style="color:red; display:none" id="lbl_estado<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-success" id="btn_update<?php echo $id_envio; ?>">Actualizar</button>
                                                                            <div id="respuesta_update"></div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <script>
                                                                $('#btn_update<?php echo $id_envio; ?>').click(function() {

                                                                    var id_envio = '<?php echo $id_envio; ?>';
                                                                    var direccion = $('#direccion<?php echo $id_envio; ?>').val();
                                                                    var estado = $('#estado<?php echo $id_envio; ?>').val();

                                                                    if (direccion == '') {
                                                                        $('#direccion<?php echo $id_envio; ?>').focus();
                                                                        $('#lbl_direccion<?php echo $id_envio; ?>').css('display', 'block');
                                                                    } else if (estado == '') {
                                                                        $('#estado<?php echo $id_envio; ?>').focus();
                                                                        $('#lbl_estado<?php echo $id_envio; ?>').css('display', 'block');
                                                                    } else {
                                                                        var url = "../app/controllers/envios/update.php";
                                                                        $.get(url, {
                                                                            id_envio: id_envio,
                                                                            direccion: direccion,
                                                                            estado: estado
                                                                        }, function(datos) {
                                                                            $('#respuesta_update').html(datos);
                                                                        });
                                                                    }


                                                                });
                                                            </script>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_envio; ?>">
                                                                <i class="fa fa-trash"></i>
                                                                Borrar
                                                            </button>
                                                            <!-- modal para borrar Envios-->
                                                            <div class="modal fade" id="modal-delete<?php echo $id_envio; ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:red; color:white">
                                                                            <h4 class="modal-title">¿Esta seguro de eliminar al envio?</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre del cliente <b>*</b></label>
                                                                                        <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_nombre<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Fecha compra <b>*</b></label>
                                                                                        <input type="text" id="Fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Direccion de envio<b>*</b></label>
                                                                                        <input type="text" id="Direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Total Pagado<b>*</b></label>
                                                                                        <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Estado <b>*</b></label>
                                                                                        <input type="text" id="estado<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['estado']; ?>" disabled>
                                                                                        <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>




                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_envio; ?>">Eliminar</button>
                                                                            <div id="respuesta_delete<?php echo $id_envio; ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>

                                                            <!-- modal buscar producto-->

                                                            <div class="modal fade" id="Modal_productos<?php echo $id_envio; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color: #08c2ec">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $envios_datos['nro_venta']; ?></h5>
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
                                                                                        $nro_venta = $envios_datos['nro_venta'];
                                                                                        $sql_carrito = "SELECT *, pro.nombre AS nombre_producto, pro.descripcion AS descripcion, pro.precio_venta AS precio_venta, pro.stock AS stock, pro.id_producto AS id_producto 
                                                                                                                    FROM tb_carrito AS carr 
                                                                                                                    INNER JOIN tb_almacen AS pro ON carr.id_producto = pro.id_producto 
                                                                                                                    WHERE nro_venta = '$nro_venta' 
                                                                                                                    ORDER BY carr.id_carrito";

                                                                                        $resultado_carrito = $mysqli->query($sql_carrito);

                                                                                        if ($resultado_carrito) {
                                                                                            while ($carrito_datos = $resultado_carrito->fetch_assoc()) {
                                                                                                $id_carrito = $carrito_datos['id_carrito'];
                                                                                                $contador_carrito += 1;
                                                                                                $cantidad_total += $carrito_datos['cantidad'];
                                                                                                $precio_unitario_total += $carrito_datos['precio_venta'];
                                                                                                $precio_total += ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
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
                                                                                        } else {
                                                                                            echo "Error al ejecutar la consulta: " . $mysqli->error;
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

                                                            <!-- fin modal buscar producto -->

                                                            <script>
                                                                $('#btn_delete<?php echo $id_envio; ?>').click(function() {

                                                                    var id_envio = '<?php echo $id_envio; ?>';

                                                                    var url2 = "../app/controllers/envios/delete.php";
                                                                    $.get(url2, {
                                                                        id_envio: id_envio
                                                                    }, function(datos) {
                                                                        $('#respuesta_delete<?php echo $id_envio; ?>').html(datos);
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                            </center></td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => console.error('Error al cargar los proveedores:', error));
    </script>
<!-- fin endpoint -->

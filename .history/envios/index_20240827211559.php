<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/envios/listado_de_envios.php';
include '../app/controllers/ventas/listado_de_ventas.php';
?>

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
                const id_envio = envios.IdVenta; // Tomamos el ID de cada envío desde la API
                const row = `
                    <tr>
                        <td><center>${index + 1}</center></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos${id_envio}">
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
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update${id_envio}">
                                    <i class="fa fa-pencil-alt"></i>
                                    Editar
                                </button>                            
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete${id_envio}">
                                    <i class="fa fa-trash"></i>
                                    Borrar
                                </button>
                            </div>
                        </center></td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);

                                // Crear modal de edición dinámicamente
                    const modalUpdate = `
                    <div class="modal fade" id="modal-update${id_envio}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:darkgreen; color:white">
                                    <h4 class="modal-title">Actualización del envío</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre del cliente</label>
                                                <input type="text" id="nombre_cliente${id_envio}" value="${envios.nombre} ${envios.apellido}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha compra</label>
                                                <input type="text" id="fecha${id_envio}" class="form-control" value="${envios.fyh_creacion}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dirección de envío</label>
                                                <input type="text" id="direccion${id_envio}" class="form-control" value="${envios.Direccion}">
                                                <small style="color:red; display:none" id="lbl_direccion${id_envio}">* Este campo es requerido</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Pagado</label>
                                                <input type="text" id="precio${id_envio}" class="form-control" value="$${envios.total_pagado}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estado">Estado <b>*</b></label>
                                                <select class="form-control" name="estado" id="estado${id_envio}">
                                                    <option value="Pendiente de envio" ${envios.estado === 'Pendiente de envio' ? 'selected' : ''}>Pendiente de envío</option>
                                                    <option value="Enviado" ${envios.estado === 'Enviado' ? 'selected' : ''}>Enviado</option>
                                                    <option value="Entregado" ${envios.estado === 'Entregado' ? 'selected' : ''}>Entregado</option>
                                                </select>
                                                <small style="color:red; display:none" id="lbl_estado${id_envio}">* Este campo es requerido</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success" id="btn_update${id_envio}">Actualizar</button>
                                    <div id="respuesta_update"></div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                `;

                document.body.insertAdjacentHTML('beforeend', modalUpdate);

                const modalDelete = `
                <!-- Modal para eliminar envío -->
                <div class="modal fade" id="modal-delete${id_envio}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:red; color:white">
                                <h4 class="modal-title">¿Está seguro de eliminar el envío?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del cliente</label>
                                            <input type="text" id="nombre_cliente${id_envio}" value="${envios.nombre} ${envios.apellido}" class="form-control" disabled>
                                            <small style="color:red; display:none" id="lbl_nombre${id_envio}">* Este campo es requerido</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha compra</label>
                                            <input type="text" id="fecha${id_envio}" class="form-control" value="${envios.fyh_creacion}" disabled>
                                            <small style="color:red; display:none" id="lbl_fecha${id_envio}">* Este campo es requerido</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Dirección de envío</label>
                                            <input type="text" id="direccion${id_envio}" class="form-control" value="${envios.Direccion}" disabled>
                                            <small style="color:red; display:none" id="lbl_direccion${id_envio}">* Este campo es requerido</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Pagado</label>
                                            <input type="text" id="precio${id_envio}" class="form-control" value="$${envios.total_pagado}" disabled>
                                            <small style="color:red; display:none" id="lbl_precio${id_envio}">* Este campo es requerido</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" id="estado${id_envio}" class="form-control" value="${envios.estado}" disabled>
                                            <small style="color:red; display:none" id="lbl_estado${id_envio}">* Este campo es requerido</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btn_delete${id_envio}">Eliminar</button>
                                <div id="respuesta_delete${id_envio}"></div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalDelete);

            const modalBuscarProductos = `
            <!-- Modal para buscar producto -->
            <div class="modal fade" id="modal-productos${id_envio}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #08c2ec">
                            <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro ${envios_datos.nro_venta}</h5>
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
                                    <tbody id="tbody-productos${id_envio}">
                                        ${productos.map((producto, index) => `
                                            <tr>
                                                <td>
                                                    <center>${index + 1}</center>
                                                    <input type="text" value="${producto.id_producto}" id="id_producto${index + 1}" hidden>
                                                </td>
                                                <td>
                                                    <center>${producto.nombre_producto}</center>
                                                </td>
                                                <td>
                                                    <center>${producto.descripcion}</center>
                                                </td>
                                                <td>
                                                    <center><span id="cantidad_carrito${index + 1}">${producto.cantidad}</span></center>
                                                    <input type="text" id="stock_de_inventario${index + 1}" value="${producto.stock}" hidden>
                                                </td>
                                                <td>
                                                    <center>${producto.precio_venta}</center>
                                                </td>
                                                <td>
                                                    <center>${(producto.cantidad * producto.precio_venta).toFixed(2)}</center>
                                                </td>
                                            </tr>`).join('')}
                                        <tr>
                                            <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                            <th>
                                                <center>${cantidad_total}</center>
                                            </th>
                                            <th>
                                                <center>${precio_unitario_total}</center>
                                            </th>
                                            <th style="background-color: yellow;">
                                                <center>${precio_total.toFixed(2)}</center>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalBuscarProductos);



            });
        })
        .catch(error => console.error('Error al cargar los envíos:', error));
</script>

<!-- fin endpoint -->

<!-- update -->
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

<!-- delete -->
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

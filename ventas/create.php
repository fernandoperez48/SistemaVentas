<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesper.php';
include '../app/controllers/clientes/listado_de_clientesemp.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/ventas/listado_de_ventas.php';
// Incluir el archivo de helper para manejar la preferencia de MercadoPago
include_once 'mercadopago.php';

include_once 'ModalBuscarClientePersona.php';
include_once 'ModalBuscarClienteEmpresa.php';
include_once 'ModalBuscarProducto.php';
include_once 'TablaCarritoActual.php';
include_once 'ReporteDeCreate.php';

?>
<div class="content-wrapper" style="background-color:gray">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="card card-outline card-danger">
                            <div class="card-header" style="background-color:orange">
                                <!-- se cuenta la cantidad de ventas de la tabla correspondiente
                                 y se le agrega un numero mas para indicar qué numero de venta sera la próxima -->
                                <?php
                                $contador_de_ventas = 0;
                                foreach ($ventas_datos as $ventas_datos) {
                                    $contador_de_ventas = $contador_de_ventas + 1;
                                }
                                ?>
                                <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Venta N°
                                    <input type="text" value="<?php echo $contador_de_ventas + 1 ?>" style="text-align: center;" disabled>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <b>Carrito</b>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fas fa-search"></i>
                                    Buscar Producto
                                </button>
                                <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->
                                <?php
                                // Renderizar el modal utilizando la clase ModalProductos
                                echo ModalBuscarProducto::render($productos_datos, $URL, $contador_de_ventas);
                                ?>
                                <br>
                                <br>
                                <br><br>

                                <div class="table-responsive">
                                    <!-- tabla de productos en el carrito -->
                                    <?php
                                    // Renderizar la tabla y capturar el HTML y el total de precio
                                    $resultadoTabla = TablaCarritoActual::render($contador_de_ventas, $mysqli);

                                    // Muestra la tabla usando el HTML renderizado
                                    echo $resultadoTabla['html'];

                                    // Accede al valor de $precio_total que se calculó en `TablaCarritoActual`
                                    $precio_total = $resultadoTabla['precio_total'];
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- SECTOR SELECCIONAR CLIENTE  -->
                                <div class="card card-outline card-danger">
                                    <div class="card-header" style="background-color:orange">
                                        <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del Cliente</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <b>Carrito</b>
                                        <div style="text-align: center;">
                                            <H5> BUSQUEDA DE CLIENTES</H5>
                                        </div>
                                        <div class="card" style="margin-top: 0px;">
                                            <div class=" card-header">
                                                <h3 class="card-title">Buscar por tipo de cliente... </h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <ul class="nav nav-pills flex-column">

                                                    <li class="nav-item">
                                                        <a class="nav-link">
                                                            <i class="far fa-circle text-danger"></i>
                                                            Personas
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_clienteper" style="margin-left: 30px;">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link">
                                                            <i class="far fa-circle text-warning"></i> Empresas
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_clienteemp" style="margin-left: 26px;">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- MODAL BUSCAR CLIENTE PERSONA     MODAL BUSCAR CLIENTE PERSONA     MODAL BUSCAR CLIENTE PERSONA -->
                                        <?php
                                        // Renderizar el modal utilizando la clase ModalProductos
                                        echo ModalBuscarClientePersona::render($clientesper_datos);
                                        ?>
                                        <!-- MODAL BUSCAR CLIENTE EMPRESA     MODAL BUSCAR CLIENTE EMPRESA     MODAL BUSCAR CLIENTE EMPRESA -->
                                        <?php
                                        // Renderizar el modal utilizando la clase ModalProductos
                                        echo ModalBuscarClienteEmpresa::render($clientesemp_datos);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" id="id_cliente" hidden>
                                                    <label for="">Nombre del Cliente</label>
                                                    <input type="text" class="form-control" id="nombre_cliente">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">DNI - CUIT del Cliente</label>
                                                <input type="text" class="form-control" id="nit_ci_cliente">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Telefono del Cliente</label>
                                                <input type="text" class="form-control" id="celular_cliente">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Email del Cliente</label>
                                                <input type="text" class="form-control" id="email_cliente">
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    var cliente = localStorage.getItem('cliente');
                                                    if (cliente) {
                                                        cliente = JSON.parse(cliente);
                                                        $("#id_cliente").val(cliente.id_cliente);
                                                        $("#nombre_cliente").val(cliente.nombre_cliente);
                                                        $("#nit_ci_cliente").val(cliente.nit_ci_cliente);
                                                        $("#celular_cliente").val(cliente.celular_cliente);
                                                        $("#email_cliente").val(cliente.email_cliente);
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-outline card-danger">
                                    <div class="card-header" style="background-color:orange">
                                        <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Registrar venta</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Monto a cancelar</label>
                                            <input type="text" class="form-control" id="total_a_cancelar" style="text-align:center; background-color:yellow" value=<?php echo $precio_total; ?> disabled>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Total pagado</label>
                                                    <input type="text" class="form-control" id="total_pagado">
                                                    <script>
                                                        $("#total_pagado").keyup(function() {
                                                            var total_a_cancelar = $("#total_a_cancelar").val();
                                                            var total_pagado = $("#total_pagado").val();
                                                            var cambio = parseFloat(total_pagado) - parseFloat(total_a_cancelar);
                                                            $("#cambio").val(cambio);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Cambio</label>
                                                    <input type="text" class="form-control" id="cambio" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="wallet_container"></div>
                                        <div class="form-group">
                                            <button id="btn_guardar_venta" class="btn btn-primary btn-block">
                                                Guardar venta
                                            </button>
                                            <div id="respuesta_registro_venta"></div>
                                            <?php
                                            $nombres_usuario_js = $nombres_sesion;
                                            ?>
                                            <script>
                                                $("#total_pagado").keyup(function() {
                                                    var total_a_cancelar = parseFloat($("#total_a_cancelar").val()) || 0;
                                                    var total_pagado = parseFloat($("#total_pagado").val()) || 0;

                                                    if (isNaN(total_pagado) || total_pagado < total_a_cancelar) {
                                                        $("#cambio").val('Monto insuficiente');
                                                    } else {
                                                        var cambio = total_pagado - total_a_cancelar;
                                                        $("#cambio").val(cambio.toFixed(2));
                                                    }
                                                });

                                                $("#btn_guardar_venta").click(function() {
                                                    var nro_venta = "<?php echo $contador_de_ventas + 1; ?>";
                                                    var id_cliente = $("#id_cliente").val();
                                                    var total_a_cancelar = parseFloat($("#total_a_cancelar").val()) || 0;
                                                    var total_pagado = parseFloat($("#total_pagado").val()) || 0;
                                                    var usuario = "<?php echo $nombres_usuario_js; ?>";

                                                    if (id_cliente === "") {
                                                        alert("Seleccione un cliente");
                                                    } else if (parseInt(<?php echo $precio_total; ?>) === 0) {
                                                        alert("Seleccione productos");
                                                    } else if (total_pagado < total_a_cancelar) {
                                                        alert("El monto pagado es insuficiente para completar la venta");
                                                    } else {
                                                        guardar_venta();
                                                    }

                                                    function guardar_venta() {
                                                        var url = "../app/controllers/ventas/registro_de_ventas.php";
                                                        $.get(url, {
                                                            nro_venta: nro_venta,
                                                            id_cliente: id_cliente,
                                                            total_a_cancelar: total_a_cancelar,
                                                            usuario: usuario
                                                        }, function(datos) {
                                                            $('#respuesta_registro_venta').html(datos);
                                                        });
                                                        localStorage.removeItem('cliente');
                                                    }
                                                });
                                            </script>
                                            <script>
                                                // Función para inicializar el pago en el contenedor wallet_container
                                                $(document).ready(function() {
                                                    // Obtener el total actualizado (de donde estés calculando el total en tu carrito)
                                                    let total_a_cancelar = parseFloat($("#total_a_cancelar").val()) || 0;

                                                    // Llamada AJAX a mercadopago.php para obtener la preferencia
                                                    // Llamada AJAX para crear la preferencia con el total actualizado
                                                    $.ajax({
                                                        url: 'mercadopago.php', // Ruta al archivo PHP
                                                        method: 'POST',
                                                        data: {
                                                            total_a_cancelar: total_a_cancelar
                                                        },
                                                        success: function(preference_id) {
                                                            // Inicializar el widget de MercadoPago con el ID de preferencia recibido
                                                            const mp = new MercadoPago('APP_USR-3b85ceec-220c-4a9b-836a-3f780d0b812e', {
                                                                locale: 'es-MX'
                                                            });

                                                            // Crear el widget de MercadoPago dentro del div wallet_container
                                                            mp.bricks().create("wallet", "wallet_container", {
                                                                initialization: {
                                                                    preferenceId: preference_id, // ID de preferencia generado
                                                                    redirectMode: 'modal'
                                                                },
                                                                customization: {
                                                                    texts: {
                                                                        action: 'buy',
                                                                        valueProp: 'security_safety'
                                                                    }
                                                                }
                                                            });
                                                        },
                                                        error: function() {
                                                            alert("Error al generar la preferencia de pago con MercadoPago.");
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!--  FIN DE WRAAPPER DE PARTE1.PHP -->

<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>
<?php
// Llamar al método estático render de la clase Reporte -->
echo ReporteDeCreate::render();
?>



<!--modal para visualizar el formulario para agregar clientes -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color:darkorange; color:white">
                <h4 class="modal-title">Nuevo Cliente </h4>
                <div style="width: 10px;"></div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                    <div class="form-group">
                        <label for="">Nombre del cliente</label>
                        <input type="text" name="nombre_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nit/CI del cliente</label>
                        <input type="text" name="nit_ci_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Celular del cliente</label>
                        <input type="text" name="celular_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Correo del cliente</label>
                        <input type="email" name="email_cliente" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guardar cliente</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
        </div>
    </div>
</div>
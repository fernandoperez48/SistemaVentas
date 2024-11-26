<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesper.php';
include '../app/controllers/clientes/listado_de_clientesemp.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/ventas/listado_de_presupuestos.php';
// Incluir el archivo de helper para manejar la preferencia de MercadoPago
include_once 'mercadopago.php';

include_once 'ModalBuscarClientePersona.php';
include_once 'ModalBuscarClienteEmpresa.php';
include_once 'ModalBuscarProducto.php';
include_once 'TablaPresupuestoActual.php';
include_once 'ReporteDeCreate.php';

?>


<div class="content-wrapper" style="background-color:gray">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Presupuestos</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">

                            <div class="card card-outline card-danger">
                                <div class="card-header" style="background-color:orange">

                                    <?php
                                    $contador_de_presupuestos = 0;
                                    foreach ($presupuestos_datos as $presupuestos_datos) {
                                        $contador_de_presupuestos = $contador_de_presupuestos + 1;
                                    }
                                    ?>
                                    <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Presupuesto N°
                                        <input type="text" value="<?php echo $contador_de_presupuestos + 1 ?>" style="text-align: center;" disabled>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <b>Pedido de presupuesto</b>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                        <i class="fas fa-search"></i>
                                        Buscar Producto
                                    </button>
                                    <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->
                                    <?php
                                    // Renderizar el modal utilizando la clase ModalProductos
                                    echo ModalBuscarProducto::render($productos_datos, $URL, $contador_de_presupuestos);
                                    ?>
                                    <br>
                                    <br>
                                    <br><br>

                                    <div class="table-responsive">
                                        <!-- tabla de productos en el carrito -->
                                        <?php
                                        // Renderizar la tabla y capturar el HTML y el total de precio
                                        $resultadoTabla = TablaPresupuestoActual::render($contador_de_presupuestos, $mysqli);

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
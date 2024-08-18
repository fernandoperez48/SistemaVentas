<?php
ini_set('display_errors', 1);
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "EyD" || $rol_sesion == "Vendedor" || $rol_sesion == "Almacen") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/compras/listado_de_compras.php';
include '../app/controllers/almacen/listado_de_productos_por_proveedor.php';
include '../app/controllers/almacen/funcionListar.php'; ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de una nueva compra</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="card card-outline card-danger">
                            <div class="card-header" style="background-color:orange">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- se cuenta la cantidad de compras de la tabla correspondiente
                                            y se le agrega un numero mas para indicar qué numero de compra sera la próxima -->
                                            <?php
                                            $contador_de_compras = 0;
                                            foreach ($compras_datos as $compras_datos) {
                                                $contador_de_compras = $contador_de_compras + 1;
                                            }
                                            ?>
                                            <div style="display: flex;">
                                                <div class="card-title"><i class="fa fa-shopping-bag" style="margin-right: 5px; margin-top: 5px;"></i>

                                                    Compra N°
                                                    <input type="text" value="<?php echo $contador_de_compras + 1 ?>" style="text-align: center; margin-left:15px;" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div style="display: flex;">
                                                    <label for="">
                                                        <h4>Proveedor:</h4>
                                                    </label>


                                                    <select name="id_proveedor" id="id_proveedor" style="margin-left: 10px;" required onchange="updateProveedor()">
                                                        <option value="">Seleccionar proveedor</option> <!--Opción por defecto -->
                                                        <?php foreach ($proveedores_datos as $proveedor) { ?>
                                                            <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <a href="<?php echo $URL; ?>/proveedores" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="display: flex;">
                                <h4><b>Detalle de la Compra</b></h4>
                                <button type="button" class="btn btn-primary" id="btn-buscar-producto" style="margin-left: 15px;">
                                    <i class="fas fa-search"></i> Buscar Producto
                                </button>


                            </div>
                            <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->

                            <?php
                            if (session_status() === PHP_SESSION_NONE) {
                                session_start();
                            }

                            $id_proveedorDelSelect = isset($_SESSION['id_proveedorDelSelect']) ? $_SESSION['id_proveedorDelSelect'] : '';

                            // // Verifica el valor de $id_proveedorDelSelect
                            echo 'Ultimo proveedor seleccionado: ' . $id_proveedorDelSelect . '<br>';

                            // if (empty($id_proveedorDelSelect)) {
                            //     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_proveedor'])) {
                            //         $id_proveedorDelSelect = $_POST['id_proveedor'];
                            //         $_SESSION['id_proveedorDelSelect'] = $id_proveedorDelSelect;
                            //     } else {
                            //         echo 'No se ha seleccionado un proveedor válido.';
                            //         // Puedes manejar este caso de manera específica, por ejemplo, redirigir o mostrar un mensaje de error
                            //         // exit; // Descomentar si deseas detener la ejecución en caso de error
                            //     }
                            // }

                            // Aquí puedes usar $id_proveedorDelSelect para listar productos
                            $productosXproveedor_datos = ListarProductosXProveedor($mysqli, $id_proveedorDelSelect);
                            ?>
                            <div class="modal fade" id="modal-buscar_producto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color:#446DF6; color:white">
                                            <h4 class="modal-title">Busqueda del producto</h4>
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
                                                                <center>Seleccionar</center>
                                                            </th>
                                                            <th>
                                                                <center>Codigo</center>
                                                            </th>
                                                            <th>
                                                                <center>Categoria</center>
                                                            </th>
                                                            <th>
                                                                <center>Imagen</center>
                                                            </th>
                                                            <th>
                                                                <center>Nombre</center>
                                                            </th>
                                                            <th>
                                                                <center>Descripcion</center>
                                                            </th>
                                                            <th>
                                                                <center>Stock</center>
                                                            </th>
                                                            <th>
                                                                <center>Ultimo Precio Compra</center>
                                                            </th>
                                                            <th>
                                                                <center>Fecha Ingreso</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 0;

                                                        foreach ($productosXproveedor_datos as $productosXproveedor_datos) {
                                                            $id_producto = $productosXproveedor_datos['id_producto']; ?>
                                                            <tr>
                                                                <td>
                                                                    <button class="btn btn-info" id="btn_seleccionar<?php echo $productosXproveedor_datos['id_producto']; ?>">Seleccionar</button>
                                                                    <script>
                                                                        $("#btn_seleccionar<?php echo $productosXproveedor_datos['id_producto']; ?>").click(function() {
                                                                            $("#id_producto").val("<?php echo $productosXproveedor_datos['id_producto']; ?>");
                                                                            $("#producto").val("<?php echo $productosXproveedor_datos['nombre']; ?>");
                                                                            $("#detalle").val("<?php echo $productosXproveedor_datos['descripcion']; ?>");
                                                                            $("#ultimo_precio").val("<?php echo $productosXproveedor_datos['precio_compra']; ?>");
                                                                            $('#cantidad').focus();
                                                                            //$("#modal-buscar_producto").modal("hide");
                                                                        });
                                                                    </script>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['codigo']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['nombre_categoria']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    // Asumiendo que $productosXproveedor_datos['imagen'] contiene el valor del campo 'imagen'
                                                                    if (empty($productosXproveedor_datos['imagen']) || is_null($productosXproveedor_datos['imagen'])) {
                                                                        // Si el valor de imagen está vacío o es NULL, muestra la imagen predeterminada
                                                                        echo '<img src="' . $URL . '/almacen/img/img_productossinimagen.jpg" width="50px">';
                                                                    } else {
                                                                        // Si el valor de imagen no está vacío ni es NULL, muestra la imagen correspondiente
                                                                        echo '<img src="' . $URL . '/almacen/img/img_productos' . $productosXproveedor_datos['imagen'] . '" width="50px">';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['nombre']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['descripcion']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['stock']; ?>
                                                                </td>
                                                                <td>
                                                                    $ <?php echo $productosXproveedor_datos['precio_compra']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $productosXproveedor_datos['fecha_ultimo_ingreso']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" id="id_producto" hidden>
                                                            <label for="">Producto</label>
                                                            <input type="text" id="producto" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Detalle</label>
                                                            <input type="text" id="detalle" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="text" id="cantidad" class="form-control">
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function allowOnlyNumbers(input) {
                                                            input.value = input.value.replace(/[^0-9]/g, '');
                                                        }

                                                        document.getElementById('cantidad').addEventListener('input', function(e) {
                                                            allowOnlyNumbers(e.target);
                                                        });
                                                    </script>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio Unitario</label>
                                                            <input type="text" id="precio_unitario" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="text" id="id_proveedor" class="form-control" value="<?php echo $id_proveedorDelSelect; ?>" hidden>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button style="float: right;" id="btn_registrar_detalle_compra" class="btn btn-primary">Registrar</button>
                                                <div id="respuesta_detalle_compra"></div>



                                                <br><br>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover table-striped" id="tabla_compra_en_curso">
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th style=" text-align:center;">Codigo</th>
                                            <th style="text-align:center;">Producto</th>
                                            <th style="text-align:center;">Detalle</th>
                                            <th style="text-align:center;">Proveedor</th>
                                            <th style="text-align:center;">Categoria</th>
                                            <th style="text-align:center;">Cantidad</th>
                                            <th style="text-align:center;">Precio Unitario</th>
                                            <th style="text-align:center;">Precio Subtotal</th>
                                            <th style="text-align:center;">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador_detalle_compras = 0;
                                        $cantidad_total = 0;
                                        $precio_unitario_total = 0;
                                        $precio_total = 0;

                                        $sql_detalle_compras = "SELECT *, 
                                            pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.codigo as codigo, 
                                            pr.nombre_proveedor as nombre_proveedor,
                                            cat.nombre_categoria as nombre_categoria
                                            FROM tb_detalle_compras AS detcom
                                            INNER JOIN tb_almacen AS pro ON detcom.id_producto = pro.id_producto 
                                            INNER JOIN tb_proveedores AS pr ON pro.id_proveedor = pr.id_proveedor
                                            INNER JOIN tb_acategorias AS cat ON cat.id_categoria = pro.id_categoria
                                            WHERE nro_compra = " . ($contador_de_compras + 1) . " 
                                            ORDER BY detcom.id_detalle_compras";

                                        $resultado_detalle_compras = $mysqli->query($sql_detalle_compras);
                                        if ($resultado_detalle_compras) {
                                            while ($detalle_compras_datos = $resultado_detalle_compras->fetch_assoc()) {
                                                $id_detalle_compras = $detalle_compras_datos['id_detalle_compras'];
                                                $contador_detalle_compras++;
                                                $cantidad_total += $detalle_compras_datos['cantidad_producto'];
                                                $precio_unitario_total += $detalle_compras_datos['precio_unitario'];
                                                $precio_total += ($detalle_compras_datos['cantidad_producto'] * $detalle_compras_datos['precio_unitario']);
                                        ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['codigo']; ?></center>
                                                        <input type="text" value="<?php echo $detalle_compras_datos['id_producto']; ?>" id="id_producto<?php echo $contador_detalle_compras; ?>" hidden>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_producto']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['descripcion']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_proveedor']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_categoria']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><span id="cantidad_detalle_compras<?php echo $contador_detalle_compras; ?>"><?php echo $detalle_compras_datos['cantidad_producto']; ?></span></center>
                                                        <input type="text" id="stock_de_inventario<?php echo $contador_detalle_compras; ?>" value="<?php echo $detalle_compras_datos['stock']; ?>" hidden>
                                                    </td>
                                                    <td>
                                                        <center>$ <?php echo number_format($detalle_compras_datos['precio_unitario'], 2, ',', '.'); ?></center>
                                                    </td>

                                                    </td>
                                                    <td>
                                                        <center>$ <?php
                                                                    $cantidad_producto = floatval($detalle_compras_datos['cantidad_producto']);
                                                                    $precio_unitario = floatval($detalle_compras_datos['precio_unitario']);
                                                                    echo $subtotal = $cantidad_producto * $precio_unitario;
                                                                    ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <form action="../app/controllers/compras/borrar_detalle_compras.php" method="post">
                                                            <center>
                                                                <input type="text" name="id_detalle_compras" value="<?php echo $id_detalle_compras; ?>" hidden>
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                                            </center>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "Error: " . $mysqli->error;
                                        }
                                        ?>



                                        <tr>
                                            <th colspan="5" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                            <th>
                                                <center>
                                                    <?php
                                                    echo $cantidad_total;
                                                    ?>
                                                </center>
                                            </th>
                                            <th>
                                                <center>$ <?php
                                                            echo $precio_unitario_total;
                                                            ?>
                                                </center>
                                            </th>
                                            <th style="background-color: yellow;">
                                                <center>$ <?php
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="card card-outline card-danger">

                        <div class="card-header" style="background-color:orange">
                            <div class="row">
                                <div class="card-title"><i class="fa fa-shopping-bag" style="margin-right: 5px; margin-top: 5px;"></i>
                                    Detalle de la Compra
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class=" col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha de pago/operación</label>
                                        <input type="date" class="form-control" id="fecha_operacion" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha de ingreso de la mercadería</label>
                                        <input type="date" class="form-control" id="ingreso_mercaderia">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Comprobante de la compra</label>
                                        <input type="text" class="form-control" id="comprobante">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Costo de la compra</label>
                                        <input type="text" class="form-control" id="precio_compra_controlador" style="text-align: center;">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $email_session; ?>" disabled>
                                        <input type="text" id="id_usuario" hidden>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="btn_guardar_compra">
                                        <i class="fas fa-save"></i>
                                        Guardar compra
                                    </button>
                                </div>
                            </div>
                            <div id="respuesta_create">
                                <!-- Aquí se mostrará la respuesta del guardado de la compra -->
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="explicacionModal" tabindex="-1" aria-labelledby="explicacionModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="explicacionModalLabel">Explicación de la Diferencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea id="explicacion_diferencia" class="form-control" rows="3" placeholder="Explique el motivo de la diferencia entre precio total y costo de la compra"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="btn_continuar">Continuar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            // Definir los arrays donde almacenaremos los datos

                            $consulta_detalle_compras = "SELECT detcom.id_producto as id_producto, 
                            detcom.cantidad_producto as cantidad_producto
                            FROM tb_detalle_compras as detcom                                                    
                            WHERE detcom.nro_compra = " . ($contador_de_compras + 1);

                            $res_detalle_compras = $mysqli->query($consulta_detalle_compras);

                            if ($res_detalle_compras) {
                                $detalle_compras_datos = $res_detalle_compras->fetch_all(MYSQLI_ASSOC);
                                $id_productos = [];
                                $cantidades = [];
                                foreach ($detalle_compras_datos as $detalle_compras) {
                                    $id_productos[] = $detalle_compras['id_producto'];
                                    $cantidades[] = $detalle_compras['cantidad_producto'];
                                }
                                // Convertir los arrays a formato JSON para pasarlos al script JavaScript
                                $id_productos_json = json_encode($id_productos);
                                $cantidades_json = json_encode($cantidades);
                            }
                            // Pasar el contador de compras a JavaScript
                            $nro_compra_js = $contador_de_compras + 1;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->

        <!-- /.content-wrapper -->
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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Productos",
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


                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });

            $(function() {
                $("#example2").DataTable({
                    /* cambio de idiomas de datatable */
                    "pageLength": 5,
                    language: {
                        "emptyTable": "No hay información",
                        "decimal": "",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Proveedores",
                        "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Proveedores",
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
            $(document).ready(function() {
                var precioTotal = <?php echo json_encode($precio_total); ?>;

                // Obtener el valor del proveedor seleccionado de la sesión
                var id_proveedorDelSelect = "<?php echo $id_proveedorDelSelect; ?>";

                // Establecer el valor del select con el valor obtenido de la sesión
                document.getElementById('id_proveedor').value = id_proveedorDelSelect;

                // Variable global para almacenar el valor original del proveedor
                var proveedorOriginal;

                function updateProveedor() {
                    var select = document.getElementById('id_proveedor');
                    var id_proveedorDelSelect = select.value;
                    let nro_compra = <?php echo $nro_compra_js; ?>;


                    // Verificar si hay registros con el número de compra
                    $.post('../app/controllers/compras/consultar_registros.php', {
                        nro_compra: nro_compra
                    }, function(response) {
                        var result = JSON.parse(response);

                        if (result.exists) {
                            // Si hay registros, pedir confirmación
                            if (confirm("Si elige otro proveedor, se reiniciará el proceso de compra. ¿Desea continuar?")) {
                                // Si el usuario confirma, eliminar los registros
                                $.post('../app/controllers/compras/limpiar_tabla.php', {
                                    nro_compra: nro_compra
                                }, function(deleteResponse) {
                                    var deleteResult = JSON.parse(deleteResponse);
                                    if (deleteResult.success) {
                                        console.log('Compra en curso eliminada con éxito.');
                                        // Proceder con la actualización del proveedor
                                        actualizarProveedor(select.value);
                                    } else {
                                        alert('Error al intentar eliminar los registros.');
                                    }
                                });
                            } else {
                                // Si el usuario cancela, restablecer el proveedor seleccionado al original
                                window.location.reload();
                                console.log('El usuario canceló la acción de cambio de proveedor.');
                            }
                        } else {
                            // Si no hay registros, proceder con la actualización del proveedor directamente
                            actualizarProveedor(id_proveedorDelSelect);
                        }
                    });
                }

                function actualizarProveedor(id_proveedor) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../app/controllers/almacen/actualizar_proveedor.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log('Proveedor actualizado:', xhr.responseText);
                            if (xhr.responseText.includes('Proveedor actualizado')) {
                                // Recarga la página para reflejar los cambios
                                window.location.reload();
                            }
                        }
                    };
                    xhr.send('id_proveedor=' + encodeURIComponent(id_proveedor));
                }

                // Agregar el evento change al select de proveedores
                $('#id_proveedor').change(updateProveedor);

                $('#proveedor_select').change(function() {
                    var id_proveedor = $(this).val(); // Obtiene el valor del proveedor seleccionado
                    console.log("ID del proveedor seleccionado:", id_proveedor); // Imprime el valor en la consola del navegador
                    // Realiza una petición Ajax enviando solo el valor del proveedor seleccionado
                    var url = "../app/controllers/almacen/listado_de_productos_por_proveedor.php";

                    $.get(url, {
                            id_proveedor: id_proveedor
                        })
                        .done(function(response) {
                            console.log("Respuesta del servidor:", response); // Imprime la respuesta del servidor en la consola del navegador
                        })
                        .fail(function(xhr, status, error) {
                            console.error("Error en la solicitud AJAX:", error); // Imprime un mensaje de error en la consola del navegador si la solicitud AJAX falla
                        });
                });

                var comprobantesExistentes = [];

                // Función para cargar los comprobantes existentes
                function cargarComprobantes() {
                    $.ajax({
                        url: "../app/controllers/compras/listado_de_comprobantes.php",
                        method: "GET",
                        success: function(data) {
                            comprobantesExistentes = JSON.parse(data);
                        },
                        error: function(error) {
                            console.log("Error al cargar comprobantes:", error);
                        }
                    });
                }

                cargarComprobantes();

                function calcularDiferenciaYPorcentaje() {
                    var precioCompra = document.getElementById('precio_compra_controlador').value;
                    var diferencia = precioCompra - precioTotal;
                    var porcentaje = (diferencia / precioTotal) * 100;
                    return {
                        diferencia,
                        porcentaje
                    };
                }

                function allowOnlyNumbersAndComma(input) {
                    // Permitir solo números, comas y puntos
                    var value = input.value.replace(/[^0-9,.]/g, '');

                    // Si hay más de una coma o punto, permitir solo la primera ocurrencia
                    var hasComma = value.indexOf(',') !== -1;
                    var hasPoint = value.indexOf('.') !== -1;

                    if (hasComma && value.indexOf(',') !== value.lastIndexOf(',')) {
                        value = value.slice(0, value.lastIndexOf(','));
                    }
                    if (hasPoint && value.indexOf('.') !== value.lastIndexOf('.')) {
                        value = value.slice(0, value.lastIndexOf('.'));
                    }

                    // Si hay tanto una coma como un punto, eliminar uno de ellos (priorizamos la coma)
                    if (hasComma && hasPoint) {
                        value = value.replace('.', '');
                    }

                    input.value = value;
                }

                document.getElementById('precio_unitario').addEventListener('input', function(e) {
                    allowOnlyNumbersAndComma(e.target);
                });

                $("#btn_registrar_detalle_compra").click(function() {
                    var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
                    var id_producto = $("#id_producto").val();
                    var cantidad = $("#cantidad").val();
                    var precio_unitario = $("#precio_unitario").val().replace(',', '.'); // Convertir comas a puntos
                    var id_proveedor = $("#id_proveedor").val();

                    if (id_producto == "") {
                        alert("Seleccione un producto");
                    } else if (cantidad == "") {
                        alert("Ingrese la cantidad");
                    } else if (precio_unitario == "") {
                        alert("Ingrese el precio unitario");
                    } else if (precio_unitario == 0 || precio_unitario === "0") {
                        alert("El precio unitario no puede ser 0");
                    } else {
                        var url = "../app/controllers/compras/registrar_detalle_compra.php";
                        $.get(url, {
                            nro_compra: nro_compra,
                            id_producto: id_producto,
                            cantidad: cantidad,
                            precio_unitario: precio_unitario,
                            id_proveedor: id_proveedor
                        }, function(datos) {
                            $('#respuesta_detalle_compra').html(datos);
                            $("#modal-buscar_producto").modal('hide');
                        });
                    }
                });

                $("#btn-buscar-producto").click(function(event) {
                    var id_proveedor = $("#id_proveedor").val();
                    console.log("ID del proveedor seleccionado: ", id_proveedor); // Línea de depuración
                    if (!id_proveedor) {
                        event.preventDefault(); // Evita que el modal se abra
                        alert("Debes seleccionar un proveedor");
                    } else {
                        $('#modal-buscar_producto').modal('show'); // Abre el modal
                    }
                });

                document.getElementById('btn_continuar').addEventListener('click', function() {
                    var explicacion = document.getElementById('explicacion_diferencia').value;

                    if (explicacion.trim() === '') {
                        alert('Por favor, complete la explicación de la diferencia.');
                    } else {
                        $('#explicacionModal').modal('hide');
                        guardarCompra(explicacion, true); // Pasamos la explicación y un flag para evitar la verificación
                    }
                });

                function guardarCompra(explicacion = '', explicacionIngresada = false) { // Añadimos un parámetro para evitar la verificación
                    var nro_compra = <?php echo $nro_compra_js; ?>;
                    var id_productos = <?php echo $id_productos_json; ?>;
                    var cantidades = <?php echo $cantidades_json; ?>;
                    var id_proveedor = $("#id_proveedor").val();
                    var fecha_operacion = $("#fecha_operacion").val();
                    var ingreso_mercaderia = $("#ingreso_mercaderia").val();
                    var comprobante = $("#comprobante").val();
                    var precio_compra = $("#precio_compra_controlador").val();
                    var id_usuario = '<?php echo $id_usuarios_sesion ?>';
                    var resultado = ''; // Inicializamos la variable resultado

                    // Verificar si el comprobante ya existe
                    if (comprobantesExistentes.includes(comprobante)) {
                        $('#comprobante').focus();
                        alert("Ese comprobante ya existe.");
                    } else if (nro_compra == "") {
                        $('#nro_compra').focus();
                        alert("Debe llenar el campo de compra.");
                    } else if (id_proveedor == "") {
                        $('#id_proveedor').focus();
                        alert("Debe llenar el campo proveedor.");
                    } else if (id_productos.length === 0 || cantidades.length === 0) {
                        // Verificar si la lista de productos o cantidades está vacía
                        alert("Debe seleccionar al menos un producto.");
                    } else if (fecha_operacion == "") {
                        $('#fecha_operacion').focus();
                        alert("Debe llenar el campo de fecha de pago/operación.");
                    } else if (ingreso_mercaderia == "") {
                        $('#ingreso_mercaderia').focus();
                        alert("Debe llenar el campo ingreso de mercadería.");
                    } else if (comprobante == "") {
                        $('#comprobante').focus();
                        alert("Debe llenar el campo N° de comprobante.");
                    } else if (precio_compra == "") {
                        $('#precio_compra_controlador').focus();
                        alert("Debe llenar el campo Costo de la compra.");
                    } else if (parseFloat(precio_compra) <= 0) {
                        $('#precio_compra_controlador').focus();
                        alert("El costo de la compra debe ser un valor positivo.");
                    } else {
                        var {
                            diferencia,
                            porcentaje
                        } = calcularDiferenciaYPorcentaje();

                        if (!explicacionIngresada && diferencia != 0) { //aca digo que si explicacionIngresada es falsa y diferencia distinto de cero
                            var mensaje = `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%. Por favor, explique la diferencia.`;
                            alert(mensaje);
                            $('#explicacionModal').modal('show');
                        } else {
                            var url = "../app/controllers/compras/create.php";
                            resultado = explicacionIngresada ? `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%.` : '---SIN DESCUENTO O RECARGA---';
                            $.get(url, {
                                nro_compra: nro_compra,
                                id_proveedor: id_proveedor,
                                fecha_operacion: fecha_operacion,
                                ingreso_mercaderia: ingreso_mercaderia,
                                comprobante: comprobante,
                                precio_compra: precio_compra,
                                id_usuario: id_usuario,
                                resultado: resultado,
                                explicacion_diferencia: explicacion, // Añadido   
                                id_productos: JSON.stringify(id_productos),
                                cantidades: JSON.stringify(cantidades)
                            }, function(datos) {
                                $('#respuesta_create').html(datos);
                                if (datos.includes("La compra se ha registrado exitosamente.")) {
                                    location.reload();
                                }
                            });
                        }
                    }
                }

                function allowOnlyNumbers(input) {
                    input.value = input.value.replace(/[^0-9]/g, '');
                }

                document.getElementById('cantidad').addEventListener('input', function(e) {
                    allowOnlyNumbers(e.target);
                });

                document.getElementById('precio_compra_controlador').addEventListener('input', function(e) {
                    allowOnlyNumbers(e.target);
                });

                document.getElementById('precio_unitario').addEventListener('input', function(e) {
                    allowOnlyNumbers(e.target);
                });

                function allowOnlyNumbers(input) {
                    // Permitir solo números y una coma o un punto
                    var value = input.value.replace(/[^0-9,.]/g, '');
                    // Si hay más de una coma o punto, permitir solo la primera ocurrencia
                    var hasComma = value.indexOf(',') !== -1;
                    var hasPoint = value.indexOf('.') !== -1;
                    if (hasComma && value.indexOf(',') !== value.lastIndexOf(',')) {
                        value = value.slice(0, value.lastIndexOf(','));
                    }
                    if (hasPoint && value.indexOf('.') !== value.lastIndexOf('.')) {
                        value = value.slice(0, value.lastIndexOf('.'));
                    }
                    input.value = value;
                }

                $("#btn_guardar_compra").click(function() {
                    guardarCompra(); // Primero llama a guardarCompra, se encargará de la diferencia si es necesario
                });
            });
        </script>

    </div>
</div>
</div>
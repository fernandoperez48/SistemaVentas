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

<div class="content-wrapper">
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
                        <div class="card card-outline card-primary">
                            <div class="card-header">
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto" style="margin-left: 15px;">
                                    <i class="fas fa-search"></i>
                                    Buscar Producto
                                </button>

                            </div>
                            <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->

                            <?php
                            if (session_status() === PHP_SESSION_NONE) {
                                session_start();
                            }

                            if (isset($_SESSION['id_proveedorDelSelect'])) {
                                $id_proveedorDelSelect = $_SESSION['id_proveedorDelSelect'];
                            } else {
                                $id_proveedorDelSelect = ''; // O algún valor por defecto o mensaje de error
                            }

                            // Verifica el valor de $id_proveedorDelSelect
                            echo 'Ultimo proveedor seleccionado: ' . $id_proveedorDelSelect . '<br>';

                            if (empty($id_proveedorDelSelect)) {
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_proveedor'])) {
                                    $id_proveedorDelSelect = $_POST['id_proveedor'];
                                    $_SESSION['id_proveedorDelSelect'] = $id_proveedorDelSelect;
                                } else {
                                    echo 'No se ha seleccionado un proveedor válido.';
                                    // Puedes manejar este caso de manera específica, por ejemplo, redirigir o mostrar un mensaje de error
                                    // exit; // Descomentar si deseas detener la ejecución en caso de error
                                }
                            }

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
                                                                    <?php echo $productosXproveedor_datos['precio_compra']; ?>
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
                                                <script>
                                                    $("#btn_registrar_detalle_compra").click(function() {
                                                        var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
                                                        var id_producto = $("#id_producto").val();
                                                        var cantidad = $("#cantidad").val();
                                                        var precio_unitario = $("#precio_unitario").val();
                                                        var id_proveedor = $("#id_proveedor").val();
                                                        if (id_producto == "") {
                                                            alert("Seleccione un producto");
                                                        } else if (cantidad == "") {
                                                            alert("Ingrese la cantidad");
                                                        } else if (precio_unitario == "") {
                                                            alert("Ingrese el precio unitario");
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
                                                                $("#modal-buscar_producto").modal('hide'); // Cierra el modal
                                                            });
                                                        }
                                                    });
                                                </script>

                                                <br><br>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7; text-align:center;">Codigo</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Producto</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Detalle</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Proveedor</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Categoria</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Cantidad</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Precio Subtotal</th>
                                            <th style="background-color: #e7e7e7; text-align:center;">Accion</th>
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
                                                        <center><?php echo $detalle_compras_datos['precio_unitario']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="card-title"><i class="fa fa-shopping-bag" style="margin-right: 5px; margin-top: 5px;"></i>
                                    Detalle de la compra
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Fecha de pago/operación</label>
                                        <input type="date" class="form-control" id="fecha_operacion">
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
                            <div id="respuesta_create"></div>


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


                            <script>
                                $(document).ready(function() {
                                    var nro_compra = <?php echo $nro_compra_js; ?>;
                                    var id_productos = <?php echo $id_productos_json; ?>;
                                    var cantidades = <?php echo $cantidades_json; ?>;

                                    console.log("Nro Compra: ", nro_compra);
                                    console.log("ID Productos: ", id_productos);
                                    console.log("Cantidades: ", cantidades);

                                    $("#btn_guardar_compra").click(function() {
                                        var id_proveedor = $("#id_proveedor").val();
                                        var fecha_operacion = $("#fecha_operacion").val();
                                        var ingreso_mercaderia = $("#ingreso_mercaderia").val();
                                        var comprobante = $("#comprobante").val();
                                        var precio_compra = $("#precio_compra_controlador").val();
                                        var id_usuario = '<?php echo $id_usuarios_sesion ?>';

                                        if (nro_compra == "") {
                                            $('#nro_compra').focus();
                                            alert("Debe llenar todos los campos de compra.");
                                        } else if (id_proveedor == "") {
                                            $('#id_proveedor').focus();
                                            alert("Debe llenar todos los campos de proveedor.");
                                        } else if (fecha_operacion == "") {
                                            $('#fecha_operacion').focus();
                                            alert("Debe llenar todos los campos de operación.");
                                        } else if (ingreso_mercaderia == "") {
                                            $('#ingreso_mercaderia').focus();
                                            alert("Debe llenar todos los campos de mercadería.");
                                        } else if (comprobante == "") {
                                            $('#comprobante').focus();
                                            alert("Debe llenar todos los campos de comprobante.");
                                        } else if (precio_compra == "") {
                                            $('#precio_compra_controlador').focus();
                                            alert("Debe llenar todos los campos de costo.");
                                        } else if (id_usuario == "") {
                                            $('#id_usuario').focus();
                                            alert("Debe llenar todos los campos de usuario.");
                                        } else {
                                            var url = "../app/controllers/compras/create.php";
                                            $.get(url, {
                                                nro_compra: nro_compra,
                                                id_proveedor: id_proveedor,
                                                fecha_operacion: fecha_operacion,
                                                ingreso_mercaderia: ingreso_mercaderia,
                                                comprobante: comprobante,
                                                precio_compra: precio_compra,
                                                id_usuario: id_usuario,
                                                id_productos: JSON.stringify(id_productos),
                                                cantidades: JSON.stringify(cantidades)
                                            }, function(datos) {
                                                $('#respuesta_create').html(datos);
                                                // Si la respuesta contiene el mensaje de éxito, refresca la página
                                                if (datos.includes("La compra se ha registrado exitosamente.")) {

                                                    location.reload();
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>



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
            });
        </script>
        <script>
            function updateProveedor() {
                var select = document.getElementById('id_proveedor');
                var id_proveedorDelSelect = select.value;

                console.log('Valor del proveedor seleccionado:', id_proveedorDelSelect);

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
                xhr.send('id_proveedor=' + encodeURIComponent(id_proveedorDelSelect));
            }
        </script>
        <script>
            // Obtener el valor del proveedor seleccionado de la sesión
            var id_proveedorDelSelect = "<?php echo $id_proveedorDelSelect; ?>";

            // Establecer el valor del select con el valor obtenido de la sesión
            document.getElementById('id_proveedor').value = id_proveedorDelSelect;
        </script>
    </div>
</div>
</div>
<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "Vendedor") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Reportes de Gestion de Proveedores
                        <!-- <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button> -->
                    </h1>


                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- /.content-wrapper -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grafico de tortas - Cantidad de Productos por Proveedor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- ACA EL GRAFICO PAPÁ DASLFMASDKLFNA      ACAA           GJADFOGJADIOGJADIOÑGJ-->

                        <div class="card-body">
                            <div id="container"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grafico de tortas - Cantidad de compras (operaciones) por Proveedor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- ACA EL GRAFICO PAPÁ DASLFMASDKLFNA      ACAA           GJADFOGJADIOGJADIOÑGJ-->

                        <div class="card-body">
                            <div id="container2"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grafico de tortas - Cantidad de compras en dinero por Proveedor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- ACA EL GRAFICO PAPÁ DASLFMASDKLFNA      ACAA           GJADFOGJADIOGJADIOÑGJ-->

                        <div class="card-body">
                            <div id="container3"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
    </div>
    <!-- Page specific script -->
    <?php include '../layaout/mensajes.php'; ?>
    <?php include '../layaout/parte2.php'; ?>

    <!-- SCRIPTSSS DE GRAFICO-->

    <!--  Volumen en porcetaje de Productos por Proveedores -->
    <script type="text/javascript">
        Highcharts.chart("container", {
            chart: {
                type: "pie"
            },
            title: {
                text: "Volumen en porcentaje de Productos por Proveedores" // Replace with a dynamic title
            },
            tooltip: {
                valueSuffix: "%",
                format: "{point.name}: {point.y:.1f}%" // Nombre con un decimal
            },
            subtitle: {
                text: 'FA INSUMOS'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -30,
                        format: "{point.percentage:.1f}%",
                        style: {
                            fontSize: "1.2em",
                            textOutline: "none",
                            opacity: 1.7
                        },
                        filter: {
                            operator: ">",
                            property: "percentage",
                            value: 1
                        }
                    }]
                }
            },
            series: [{
                name: "Proveedores",
                colorByPoint: true,
                data: [
                    <?php
                    // total de proveedores
                    $stmt_total_proveedores = $mysqli->query("SELECT id_proveedor, nombre_proveedor FROM tb_proveedores");
                    $proveedores = $stmt_total_proveedores->fetch_all(MYSQLI_ASSOC);

                    $stmt_total = $mysqli->query("SELECT COUNT(*) AS total FROM tb_almacen");
                    $total = $stmt_total->fetch_assoc()['total'];

                    // completo con objetos el array
                    $porcentajes = [];
                    foreach ($proveedores as $proveedor) {
                        $id_proveedor = $proveedor['id_proveedor'];
                        $nombre_proveedor = $proveedor['nombre_proveedor'];

                        $stmt_proveedor = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM tb_almacen WHERE id_proveedor = ?");
                        $stmt_proveedor->bind_param('i', $id_proveedor);
                        $stmt_proveedor->execute();
                        $cantidad = $stmt_proveedor->get_result()->fetch_assoc()['cnt'];

                        if ($total > 0) {
                            $porcentaje = ($cantidad / $total) * 100;
                        } else {
                            $porcentaje = 0;
                        }
                        $porcentaje_dos_decimales = number_format($porcentaje, 2);
                        $porcentajes[] = ['name' => $nombre_proveedor, 'y' => $porcentaje];
                    }

                    // recorro el array y le meto el código
                    $primera = true;
                    foreach ($porcentajes as $proveedor) {
                        if (!$primera) {
                            echo ',';
                        }
                        $primera = false;
                        echo json_encode($proveedor);
                    }
                    ?>
                ]
            }]
        });
    </script>


    <!--  Volumen en porcetaje de compras operacion por Proveedores -->
    <script type="text/javascript">
        Highcharts.chart("container2", {
            chart: {
                type: "pie"
            },
            title: {
                text: "Volumen en porcetaje de Compras (operacion) por Proveedores" // Replace with a dynamic title
            },
            tooltip: {
                valueSuffix: "%",
                format: "{point.name}: {point.y:.1f}%" // Nombre con un decimal
            },
            subtitle: {
                text: 'FA INSUMOS'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -30,
                        format: "{point.percentage:.1f}%",
                        style: {
                            fontSize: "1.2em",
                            textOutline: "none",
                            opacity: 1.7
                        },
                        filter: {
                            operator: ">",
                            property: "percentage",
                            value: 1
                        }
                    }]
                }
            },
            series: [{
                name: "Proveedores",
                colorByPoint: true,
                data: [
                    <?php


                    $stmt_total_proveedores = $mysqli->query("SELECT id_proveedor, nombre_proveedor FROM tb_proveedores");
                    $proveedores = $stmt_total_proveedores->fetch_all(MYSQLI_ASSOC);

                    $stmt_total = $mysqli->query("SELECT COUNT(*) AS total FROM tb_compras");
                    $total = $stmt_total->fetch_assoc()['total'];

                    $porcentajes = [];
                    foreach ($proveedores as $proveedor) {
                        $id_proveedor = $proveedor['id_proveedor'];
                        $nombre_proveedor = $proveedor['nombre_proveedor'];

                        $stmt_proveedor = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM tb_compras WHERE id_proveedor = ?");
                        $stmt_proveedor->bind_param('i', $id_proveedor);
                        $stmt_proveedor->execute();
                        $cantidad = $stmt_proveedor->get_result()->fetch_assoc()['cnt'];

                        if ($total > 0) {
                            $porcentaje = ($cantidad / $total) * 100;
                        } else {
                            $porcentaje = 0;
                        }
                        $porcentaje_dos_decimales = number_format($porcentaje, 2);
                        $porcentajes[] = ['name' => $nombre_proveedor, 'y' => $porcentaje];
                    }
                    $primera = true;
                    foreach ($porcentajes as $proveedor) {
                        if (!$primera) {
                            echo ',';
                        }
                        $primera = false;
                        echo json_encode($proveedor);
                    }
                    ?>
                ]
            }]
        });
    </script>


    <!--  Volumen en porcetaje de compras en pesos por Proveedores -->
    <script type="text/javascript">
        Highcharts.chart("container3", {
            chart: {
                type: "pie"
            },
            title: {
                text: "Volumen en Porcentaje de compras en pesos a Proveedor"
            },
            tooltip: {
                pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
            },
            subtitle: {
                text: 'FA INSUMOS'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: {
                        enabled: true,
                        format: "{point.name}: {point.percentage:.1f}%"
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Proveedores",
                colorByPoint: true,
                data: [
                    <?php
                    // Consulta para obtener el total gastado por cada proveedor
                    $sql_total_gastado = "SELECT 
                    proveedores.nombre_proveedor AS nombre,
                    COALESCE(SUM(detalle.cantidad_producto * detalle.precio_unitario), 0) AS total_gastado
                FROM 
                    tb_proveedores AS proveedores
                LEFT JOIN 
                    tb_detalle_compras AS detalle ON proveedores.id_proveedor = detalle.id_proveedor
                GROUP BY 
                    proveedores.id_proveedor";

                    $resultado_total_gastado = $mysqli->query($sql_total_gastado);

                    // Inicializar el arreglo para almacenar los datos
                    $total_gastado_proveedores = array();
                    $proveedores_sin_compras = array();

                    // Obtener los datos del total gastado por proveedor
                    while ($proveedor = $resultado_total_gastado->fetch_assoc()) {
                        $total_gastado_proveedores[] = $proveedor;

                        // Verificar si el proveedor no tiene compras
                        if ($proveedor['total_gastado'] == 0) {
                            $proveedores_sin_compras[] = $proveedor['nombre'];
                        }
                    }

                    // Calcular el total gastado en todas las compras
                    $total_gastado_total = array_sum(array_column($total_gastado_proveedores, 'total_gastado'));

                    // Calcular el porcentaje de gasto para cada proveedor
                    $primera = true;
                    foreach ($total_gastado_proveedores as $proveedor) {
                        $porcentaje = ($proveedor['total_gastado'] / $total_gastado_total) * 100;
                        $porcentaje_dos_decimales = number_format($porcentaje, 2);
                        if (!$primera) {
                            echo ',';
                        }
                        $primera = false;
                        echo '{ name: "' . $proveedor['nombre'] . '", y: ' . $porcentaje_dos_decimales . '}';
                    }
                    ?>
                ]
            }]
        });

        // Mostrar la leyenda de proveedores sin compras
        <?php if (!empty($proveedores_sin_compras)) { ?>
            document.addEventListener('DOMContentLoaded', function() {
                var container = document.createElement('div');
                container.innerHTML = '<strong>Proveedores sin compras:</strong> <?php echo implode(" -- ", $proveedores_sin_compras); ?>';
                document.body.appendChild(container);
            });
        <?php } ?>
    </script>





    <script src="../code/highcharts.js"></script>
    <script src="../code/modules/exporting.js"></script>
    <script src="../code/modules/accessibility.js"></script>
    <!--  FIN SCRIPTSSS DE GRAFICO-->
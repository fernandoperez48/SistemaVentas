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
                        <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
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
                            <div id="container2"></div>

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
                text: "Volumen en porcetaje de Productos por Proveedores" // Replace with a dynamic title
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
                    $stmt_total_proveedores = $pdo->query("SELECT COUNT(*) AS total_proveedores FROM tb_proveedores");
                    $total_proveedores = $stmt_total_proveedores->fetchColumn();

                    $stmt_total = $pdo->query("SELECT COUNT(*) AS total FROM tb_almacen");
                    $total = $stmt_total->fetchColumn();
                    // completo con objetos el array
                    $porcentajes = [];
                    for ($i = 1; $i <= $total_proveedores; $i++) {
                        $stmt_proveedor = $pdo->prepare("SELECT COUNT(*) AS cnt FROM tb_almacen WHERE id_proveedor = ?");
                        $stmt_proveedor->execute([$i]);
                        $cantidad = $stmt_proveedor->fetchColumn();

                        // nombre segun $i
                        $stmt_nombre_proveedor = $pdo->prepare("SELECT nombre_proveedor FROM tb_proveedores WHERE id_proveedor = ?");
                        $stmt_nombre_proveedor->execute([$i]);
                        $nombre_proveedor = $stmt_nombre_proveedor->fetchColumn();

                        //$porcentaje = ($cantidad / $total) * 100;
                        // uso el nombre segun $I
                        $porcentaje = ($cantidad / $total) * 100;
                        $porcentaje_dos_decimales = number_format($porcentaje, 2);
                        $porcentajes[] = ['name' => $nombre_proveedor, 'y' => $porcentaje];
                    }

                    // recorro el array y le meto el codigo q no entiendo
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

    <!--  Volumen en porcetaje de Productos por Proveedores -->
    <script type="text/javascript">
        Highcharts.chart("container2", {
            chart: {
                type: "pie"
            },
            title: {
                text: "Volumen en porcetaje de Compras en $pesos por Proveedores" // Replace with a dynamic title
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
                    $stmt_total_proveedores = $pdo->query("SELECT COUNT(*) AS total_proveedores FROM tb_proveedores");
                    $total_proveedores = $stmt_total_proveedores->fetchColumn();

                    $stmt_total = $pdo->query("SELECT COUNT(*) AS total FROM tb_almacen");
                    $total = $stmt_total->fetchColumn();
                    // completo con objetos el array
                    $porcentajes = [];
                    for ($i = 1; $i <= $total_proveedores; $i++) {
                        $stmt_proveedor = $pdo->prepare("SELECT COUNT(*) AS cnt FROM tb_almacen WHERE id_proveedor = ?");
                        $stmt_proveedor->execute([$i]);
                        $cantidad = $stmt_proveedor->fetchColumn();

                        // nombre segun $i
                        $stmt_nombre_proveedor = $pdo->prepare("SELECT nombre_proveedor FROM tb_proveedores WHERE id_proveedor = ?");
                        $stmt_nombre_proveedor->execute([$i]);
                        $nombre_proveedor = $stmt_nombre_proveedor->fetchColumn();

                        //$porcentaje = ($cantidad / $total) * 100;
                        // uso el nombre segun $I
                        $porcentaje = ($cantidad / $total) * 100;
                        $porcentaje_dos_decimales = number_format($porcentaje, 2);
                        $porcentajes[] = ['name' => $nombre_proveedor, 'y' => $porcentaje];
                    }

                    // recorro el array y le meto el codigo q no entiendo
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


    <script src="../code/highcharts.js"></script>
    <script src="../code/modules/exporting.js"></script>
    <script src="../code/modules/accessibility.js"></script>
    <!--  FIN SCRIPTSSS DE GRAFICO-->
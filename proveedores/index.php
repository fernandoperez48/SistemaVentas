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
                    <h1 class="m-0">Listado de Proveedores
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

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Proveedores registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre del proveedor</center>
                                        </th>
                                        <th>
                                            <center>Celular</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Empresa</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Direccion</center>
                                        </th>
                                        <th class="actions">
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($proveedores_datos as $proveedores_datos) {
                                        $id_proveedor = $proveedores_datos['id_proveedor'];
                                        $nombre_proveedor = $proveedores_datos['nombre_proveedor']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $nombre_proveedor; ?></td>
                                            <td>
                                                <a href="http://wa.me/+54<?php echo $proveedores_datos['celular']; ?>" target="_blank" class="btn btn-success">
                                                    <i class="fa fa-phone"></i>
                                                    <?php echo $proveedores_datos['celular']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $proveedores_datos['telefono']; ?></td>
                                            <td><?php echo $proveedores_datos['empresa']; ?></td>
                                            <td><?php echo $proveedores_datos['email']; ?></td>
                                            <td><?php echo $proveedores_datos['direccion']; ?></td>

                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_proveedor; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                        Editar
                                                    </button>
                                                    <!-- modal para actualizar proveedores-->
                                                    <div class="modal fade" id="modal-update<?php echo $id_proveedor; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                    <h4 class="modal-title">Actualizacion del proveedor</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre_proveedor<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control">
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celular<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="telefono<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="empresa<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="email<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Direccion<b>*</b></label>
                                                                                <input type="text" id="direccion<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['direccion']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_direccion<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-success" id="btn_update<?php echo $id_proveedor; ?>">Actualizar</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <script>
                                                        $('#btn_update<?php echo $id_proveedor; ?>').click(function() {

                                                            var id_proveedor = '<?php echo $id_proveedor; ?>';
                                                            var nombre_proveedor = $('#nombre_proveedor<?php echo $id_proveedor; ?>').val();
                                                            var celular = $('#celular<?php echo $id_proveedor; ?>').val();
                                                            var telefono = $('#telefono<?php echo $id_proveedor; ?>').val();
                                                            var empresa = $('#empresa<?php echo $id_proveedor; ?>').val();
                                                            var email = $('#email<?php echo $id_proveedor; ?>').val();
                                                            var direccion = $('#direccion<?php echo $id_proveedor; ?>').val();



                                                            if (nombre_proveedor == '') {
                                                                $('#nombre_proveedor<?php echo $id_proveedor; ?>').focus();
                                                                $('#lbl_nombre<?php echo $id_proveedor; ?>').css('display', 'block');
                                                            } else if (celular == '') {
                                                                $('#celular<?php echo $id_proveedor; ?>').focus();
                                                                $('#lbl_celular<?php echo $id_proveedor; ?>').css('display', 'block');
                                                            } else if (empresa == '') {
                                                                $('#empresa<?php echo $id_proveedor; ?>').focus();
                                                                $('#lbl_empresa<?php echo $id_proveedor; ?>').css('display', 'block');
                                                            } else if (direccion == '') {
                                                                $('#direccion<?php echo $id_proveedor; ?>').focus();
                                                                $('#lbl_direccion<?php echo $id_proveedor; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/proveedores/update.php";
                                                                $.get(url, {
                                                                    id_proveedor: id_proveedor,
                                                                    nombre_proveedor: nombre_proveedor,
                                                                    celular: celular,
                                                                    telefono: telefono,
                                                                    empresa: empresa,
                                                                    email: email,
                                                                    direccion: direccion
                                                                }, function(datos) {
                                                                    $('#respuesta').html(datos);
                                                                });
                                                            }


                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_proveedor; ?>"></div>
                                                </div>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_proveedor; ?>">
                                                        <i class="fa fa-trash"></i>
                                                        Borrar
                                                    </button>
                                                    <!-- modal para borrar proveedores-->
                                                    <div class="modal fade" id="modal-delete<?php echo $id_proveedor; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:red; color:white">
                                                                    <h4 class="modal-title">¿Esta seguro de eliminar al proveedor?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre_proveedor<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celular<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="telefono<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="empresa<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="email<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Direccion<b>*</b></label>
                                                                                <input type="text" id="direccion<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['direccion']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_direccion<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_proveedor; ?>">Eliminar</button>
                                                                    <div id="respuesta_delete<?php echo $id_proveedor; ?>"></div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                    <script>
                                                        $('#btn_delete<?php echo $id_proveedor; ?>').click(function() {

                                                            var id_proveedor = '<?php echo $id_proveedor; ?>';

                                                            var url2 = "../app/controllers/proveedores/delete.php";
                                                            $.get(url2, {
                                                                id_proveedor: id_proveedor
                                                            }, function(datos) {
                                                                $('#respuesta_delete<?php echo $id_proveedor; ?>').html(datos);
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
    </div>

    <!-- /.content-wrapper -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grafico de tortas</h3>
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

    <!-- Page specific script -->
    <?php include '../layaout/mensajes.php'; ?>
    <?php include '../layaout/parte2.php'; ?>

    <!-- modal para registrar proveedores-->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color:blue; color:white">
                    <h4 class="modal-title">Creacion de un nuevo proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre del proveedor <b>*</b></label>
                                <input type="text" id="nombre_proveedor" class="form-control">
                                <small style="color:red; display:none" id="lbl_nombre">* Este campo es requerido</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Celular <b>*</b></label>
                                <input type="number" id="celular" class="form-control">
                                <small style="color:red; display:none" id="lbl_celular">* Este campo es requerido</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="number" id="telefono" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Empresa<b>*</b></label>
                                <input type="email" id="empresa" class="form-control">
                                <small style="color:red; display:none" id="lbl_empresa">* Este campo es requerido</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="text" id="email" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Direccion<b>*</b></label>
                                <input type="text" id="direccion" class="form-control">
                                <small style="color:red; display:none" id="lbl_direccion">* Este campo es requerido</small>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
                </div>
                <div id="respuesta"></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <!-- SCRIPTSSS DE LA TABLA-->
    <script>
        $('#btn_create').click(function() {
            var nombre_proveedor = $('#nombre_proveedor').val();
            var celular = $('#celular').val();
            var telefono = $('#telefono').val();
            var empresa = $('#empresa').val();
            var email = $('#email').val();
            var direccion = $('#direccion').val();

            if (nombre_proveedor == '') {
                $('#nombre_proveedor').focus();
                $('#lbl_nombre').css('display', 'block');
            } else if (celular == '') {
                $('#celular').focus();
                $('#lbl_celular').css('display', 'block');
            } else if (empresa == '') {
                $('#empresa').focus();
                $('#lbl_empresa').css('display', 'block');
            } else if (direccion == '') {
                $('#direccion').focus();
                $('#lbl_direccion').css('display', 'block');
            } else {
                var url = "../app/controllers/proveedores/create.php";
                $.get(url, {
                    nombre_proveedor: nombre_proveedor,
                    celular: celular,
                    telefono: telefono,
                    empresa: empresa,
                    email: email,
                    direccion: direccion
                }, function(datos) {
                    $('#respuesta').html(datos);
                });
            }


        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
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
                            exportOptions: {
                                columns: ':not(.actions)'
                            }
                        }, {
                            extend: 'csv',
                            exportOptions: {
                                columns: ':not(.actions)'
                            }
                        }, {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':not(.actions)'
                            }
                        }, {
                            text: 'Imprimir',
                            extend: 'print',
                            exportOptions: {
                                columns: ':not(.actions)'
                            }
                        }]
                    },
                    {
                        extend: 'colvis',
                        text: 'Visor de columnas'


                    }
                ],
                // "columnDefs": [{
                //     "targets": -1,
                //     "className": "no-export",
                //     "searchable": false
                // }]

                /*Fin de ajuste de botones*/
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
    <!-- FIN SCRIPTSSS DE LA TABLA-->




    <!-- SCRIPTSSS DE GRAFICO-->
    <script type="text/javascript">
        Highcharts.chart("container", {
            chart: {
                type: "pie"
            },
            title: {
                text: "Volumen en porcetaje de Productos por Proveedores" // Replace with a dynamic title
            },
            tooltip: {
                valueSuffix: "%"
            },
            subtitle: {
                text: 'Source: <a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
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
                        distance: -40,
                        format: "{point.percentage:.1f}%",
                        style: {
                            fontSize: "1.2em",
                            textOutline: "none",
                            opacity: 0.7
                        },
                        filter: {
                            operator: ">",
                            property: "percentage",
                            value: 10
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

                        $porcentaje = ($cantidad / $total) * 100;
                        // uso el nombre segun $I
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
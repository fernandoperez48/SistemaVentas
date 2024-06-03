<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesper.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Clientes</h1>
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
                            <h3 class="card-title">Clientes - personas regitradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Id de Cliente</center>
                                        </th>
                                        <th>
                                            <center>Nombre y Apellido</center>
                                        </th>
                                        <th>
                                            <center>DNI</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Domicilio</center>
                                        </th>
                                        <th>
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($clientesper_datos as $clientesper_datos) {
                                        $id_cliente = $clientesper_datos['id_cliente']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $clientesper_datos['id_cliente']; ?>
                                            </td>
                                            <td><?php echo $clientesper_datos['nombre'] . ' ' . $clientesper_datos['apellido']; ?></td>
                                            <td><?php echo $clientesper_datos['dni']; ?></td>
                                            <td><?php echo $clientesper_datos['telefono']; ?></td>
                                            <td><?php echo $clientesper_datos['email']; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($clientesper_datos['id_domicilio'])) {
                                                    $id_domicilio = $clientesper_datos['id_domicilio'];
                                                    $sql_domicilio = "SELECT d.calle, d.numero, d.piso, d.depto 
                      FROM tb_domicilios AS d 
                      WHERE d.id_domicilio = $id_domicilio";

                                                    $query_domicilio = $mysqli->query($sql_domicilio);

                                                    if ($query_domicilio) {
                                                        $domicilio_datos = $query_domicilio->fetch_assoc();

                                                        // Imprimir la calle y el número
                                                        echo $domicilio_datos['calle'] . ' ' . $domicilio_datos['numero'] . ' ';

                                                        // Verificar y agregar "Piso" si el valor de piso no está vacío
                                                        if (!empty($domicilio_datos['piso'])) {
                                                            echo 'Piso ' . $domicilio_datos['piso'] . ' ';
                                                        }

                                                        // Verificar y agregar "Depto" si el valor de depto no está vacío
                                                        if (!empty($domicilio_datos['depto'])) {
                                                            echo 'Depto ' . $domicilio_datos['depto'];
                                                        }
                                                    } else {
                                                        echo "Error al ejecutar la consulta";
                                                    }
                                                } else {
                                                    echo "No hay domicilio";
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a href="showper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-info"><i class="fa fa-eye"></i>Ver</a>
                                                        <a href="updateper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        <a href="deleteper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Borrar</a>
                                                    </div>
                                                </center>
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
    </div>

    <!-- Main content -->
</div>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 to 0 of 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
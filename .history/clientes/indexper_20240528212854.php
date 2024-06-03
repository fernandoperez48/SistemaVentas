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

                            <table id="example1" class="table table-bordered table-striped" style="border-color: black;">
                                <thead style="background-color: gray;">
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
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($clientesper_datos as $clientesper_datos) {
                                        $id_cliente = $clientesper_datos['id_cliente'];
                                        $id_domicilio = $clientesper_datos['id_domicilio']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $clientesper_datos['id_cliente']; ?>
                                            </td>
                                            <td><?php echo $clientesper_datos['nombre'] . ' ' . $clientesper_datos['apellido']; ?></td>
                                            <td><?php echo $clientesper_datos['dni']; ?></td>
                                            <td><?php echo $clientesper_datos['telefono']; ?></td>
                                            <td><?php echo $clientesper_datos['email']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i>Ver</a>

                                                         <!-- modal para ver clientes-->
                                                            <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos del cliente</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre</label>
                                                                                        <input type="text" id="nombre<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['nombre']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Apellido</label>
                                                                                        <input type="text" id="apellido<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['apellido']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Telefono</label>
                                                                                        <input type="number" id="tel<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['telefono'] ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>DNI</label>
                                                                                        <input type="text" id="dni<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['dni']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Email</label>
                                                                                        <input type="text" id="email<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['email']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Pais </label>
                                                                                        <input type="text" id="pais<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['pais']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Provincia</label>
                                                                                        <input type="text" id="prov<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['provincia']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Localidad </label>
                                                                                        <input type="text" id="loc<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['ciudad']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Domicilio<b>*</b></label>
                                                                                        <input type="text" id="dom<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['calle']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nro<b>*</b></label>
                                                                                        <input type="text" id="num<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['numero']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Piso </label>
                                                                                        <input type="text" id="pis<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['piso']; ?>" disabled>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Depto<b>*</b></label>
                                                                                        <input type="text" id="dpto<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['depto']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_cliente; ?>"><i class="fa fa-pencil-alt"></i>Editar</a>

                                                            <!-- modal para actualizar clientes-->
                                                            <div class="modal fade" id="modal-update<?php echo $id_cliente; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                            <h4 class="modal-title">Actualizacion del cliente</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre del cliente <b>*</b></label>
                                                                                        <input type="text" id="nombre_clienteU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['nombre']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_nombreU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                        <label>Apellido del cliente <b>*</b></label>
                                                                                        <input type="text" id="apellido_clienteU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['apellido']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_apellidoU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Telefono</label>
                                                                                        <input type="number" id="telefonoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['telefono']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>DNI <b>*</b></label>
                                                                                        <input type="text" id="dniU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['dni']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_dniU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Email </label>
                                                                                        <input type="text" id="emailU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['email']; ?>">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Pais<b>*</b></label>
                                                                                        <input type="text" id="paisU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['pais']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_paisU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Provincia<b>*</b></label>
                                                                                        <input type="text" id="provinciaU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['provincia']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_provinciaU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Localidad </label>
                                                                                        <input type="text" id="localidadU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['ciudad']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_localidadU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Domicilio<b>*</b></label>
                                                                                        <input type="text" id="domicilioU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['calle']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_domicilioU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nro<b>*</b></label>
                                                                                        <input type="text" id="numeroU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['numero']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_numeroU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Piso </label>
                                                                                        <input type="text" id="pisoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['piso']; ?>">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Depto<b>*</b></label>
                                                                                        <input type="text" id="deptoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['depto']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-success" id="btn_update<?php echo $id_cliente; ?>">Actualizar</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <script>
                                                                $('#btn_update<?php echo $id_cliente; ?>').click(function() {
                                                                    console.log("Script cargado y ejecutándose");
                                                                    var id_cliente = '<?php echo $id_cliente; ?>';
                                                                    var nombre_cliente = $('#nombre_clienteU<?php echo $id_cliente; ?>').val();
                                                                    var apellido_cliente = $('#apellido_clienteU<?php echo $id_cliente; ?>').val();
                                                                    var telefono = $('#telefonoU<?php echo $id_cliente; ?>').val();
                                                                    var dni = $('#dniU<?php echo $id_cliente; ?>').val();
                                                                    var email = $('#emailU<?php echo $id_cliente; ?>').val();
                                                                    var pais = $('#paisU<?php echo $id_cliente; ?>').val();
                                                                    var provincia = $('#provinciaU<?php echo $id_cliente; ?>').val();
                                                                    var localidad = $('#localidadU<?php echo $id_cliente; ?>').val();
                                                                    var domicilio = $('#domicilioU<?php echo $id_cliente; ?>').val();
                                                                    var numero = $('#numeroU<?php echo $id_cliente; ?>').val();
                                                                    var piso = $('#pisoU<?php echo $id_cliente; ?>').val();
                                                                    var depto = $('#deptoU<?php echo $id_cliente; ?>').val();
                                                                    var id_domicilio = '<?php echo $id_domicilio; ?>';


                                                                    // Verificar si todos los campos requeridos están llenos
                                                                    if (nombre_cliente === '' || apellido_cliente === '' || dni === '' || pais === '' || provincia === '' || localidad === '' || domicilio === '' || numero === '') {
                                                                        alert('Todos los campos marcados con * son obligatorios.');
                                                                    } else {
                                                                        // Realizar la solicitud AJAX para enviar los datos actualizados
                                                                        $.ajax({
                                                                            type: "POST", // Cambiar a POST para enviar datos sensibles
                                                                            url: "../app/controllers/clientes/updateper.php",
                                                                            data: {
                                                                                id_cliente: id_cliente,
                                                                                nombre_cliente: nombre_cliente,
                                                                                apellido_cliente: apellido_cliente,
                                                                                telefono: telefono,
                                                                                dni: dni,
                                                                                email: email,
                                                                                pais: pais,
                                                                                provincia: provincia,
                                                                                localidad: localidad,
                                                                                domicilio: domicilio,
                                                                                numero: numero,
                                                                                piso: piso,
                                                                                depto: depto,
                                                                                id_domicilio: id_domicilio
                                                                            },
                                                                            success: function(response) {
                                                                                // Manejar la respuesta del servidor
                                                                                $('#respuesta_update<?php echo $id_cliente; ?>').html(response);
                                                                                console.log("Solicitud AJAX exitosa. Respuesta del servidor:", response);
                                                                            },
                                                                            error: function(xhr, textStatus, errorThrown) {
                                                                                console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            </script>
                                                            <div id="respuesta_update<?php echo $id_cliente; ?>"></div>
                                                    </div>


                                                    <div class="btn-group">
                                                
                                                        <a href="deleteper.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i>Borrar</a>
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
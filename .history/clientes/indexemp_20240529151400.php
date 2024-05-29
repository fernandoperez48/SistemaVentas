<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/listado_de_clientesemp.php';

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
                            <h3 class="card-title">Clientes - empresas regitradas</h3>

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
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>Razon Social</center>
                                        </th>
                                        <th>
                                            <center>CUIT</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Persona Autorizada</center>
                                        </th>

                                        <th>
                                            <center>Opciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($clientesemp_datos as $clientesemp_datos) {
                                        $id_cliente = $clientesemp_datos['id_cliente']; ?>
                                        <tr>
                                            <td>
                                                <?php echo $clientesemp_datos['id_cliente']; ?>
                                            </td>
                                            <td><?php echo $clientesemp_datos['nombre']; ?></td>
                                            <td><?php echo $clientesemp_datos['razon_social']; ?></td>
                                            <td><?php echo $clientesemp_datos['cuit']; ?></td>
                                            <td><?php echo $clientesemp_datos['telefono']; ?></td>
                                            <td><?php echo $clientesemp_datos['email']; ?></td>
                                            <td><?php echo $clientesemp_datos['persona_autorizada']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i>Ver</a>

                                                         <!-- modal para ver clientes-->
                                                         <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos de la empresa</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre</label>
                                                                                        <input type="text" id="nombre<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['nombre']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Razon social</label>
                                                                                        <input type="text" id="rz<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['razon_social']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Telefono</label>
                                                                                        <input type="number" id="tel<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['telefono'] ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Cuit</label>
                                                                                        <input type="text" id="cuit<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['cuit']; ?>" class="form-control" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Email</label>
                                                                                        <input type="text" id="email<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['email']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Pais </label>
                                                                                        <input type="text" id="pais<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['pais']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Provincia</label>
                                                                                        <input type="text" id="prov<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['provincia']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Localidad </label>
                                                                                        <input type="text" id="loc<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['ciudad']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Domicilio<b>*</b></label>
                                                                                        <input type="text" id="dom<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['calle']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nro<b>*</b></label>
                                                                                        <input type="text" id="num<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['numero']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Piso </label>
                                                                                        <input type="text" id="pis<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['piso']; ?>" disabled>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Depto<b>*</b></label>
                                                                                        <input type="text" id="dpto<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['depto']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>


                                                        <a type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_cliente; ?>"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                        
                                                            <!-- modal para actualizar clientes-->
                                                            <div class="modal fade" id="modal-update<?php echo $id_cliente; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                            <h4 class="modal-title">Actualizacion de la Empresa</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nombre empresa<b>*</b></label>
                                                                                        <input type="text" id="nombre_empresa<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['nombre']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_nombreE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                        <label>Razon Social <b>*</b></label>
                                                                                        <input type="text" id="razon_social<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['razon_social']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_razon_socialE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Telefono</label>
                                                                                        <input type="number" id="telefonoE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['telefono']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>CUIT <b>*</b></label>
                                                                                        <input type="text" id="cuitE<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['cuit']; ?>" class="form-control">
                                                                                        <small style="color:red; display:none" id="lbl_cuitE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Email </label>
                                                                                        <input type="text" id="emailE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['email']; ?>">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Pais<b>*</b></label>
                                                                                        <input type="text" id="paisE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['pais']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_paisE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Provincia<b>*</b></label>
                                                                                        <input type="text" id="provinciaE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['provincia']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_provinciaE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Localidad </label>
                                                                                        <input type="text" id="localidadE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['ciudad']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_localidadE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Domicilio<b>*</b></label>
                                                                                        <input type="text" id="domicilioE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['calle']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_domicilioE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Nro<b>*</b></label>
                                                                                        <input type="text" id="numeroE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['numero']; ?>">
                                                                                        <small style="color:red; display:none" id="lbl_numeroE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Piso </label>
                                                                                        <input type="text" id="pisoE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['piso']; ?>">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label>Depto<b>*</b></label>
                                                                                        <input type="text" id="deptoE<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesemp_datos['depto']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-success" id="btn_updateE<?php echo $id_cliente; ?>">Actualizar</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <script>
                                                                $('#btn_updateE<?php echo $id_cliente; ?>').click(function() {
                                                                    console.log("Script cargado y ejecutándose");
                                                                    var id_cliente = '<?php echo $id_cliente; ?>';
                                                                    var nombre_cliente = $('#nombre_clienteE<?php echo $id_cliente; ?>').val();
                                                                    var razon_social = $('#razon_social<?php echo $id_cliente; ?>').val();
                                                                    var telefono = $('#telefonoE<?php echo $id_cliente; ?>').val();
                                                                    var cuit = $('#cuitE<?php echo $id_cliente; ?>').val();
                                                                    var email = $('#emailE<?php echo $id_cliente; ?>').val();
                                                                    var pais = $('#paisE<?php echo $id_cliente; ?>').val();
                                                                    var provincia = $('#provinciaE<?php echo $id_cliente; ?>').val();
                                                                    var localidad = $('#localidadE<?php echo $id_cliente; ?>').val();
                                                                    var domicilio = $('#domicilioE<?php echo $id_cliente; ?>').val();
                                                                    var numero = $('#numeroE<?php echo $id_cliente; ?>').val();
                                                                    var piso = $('#pisoE<?php echo $id_cliente; ?>').val();
                                                                    var depto = $('#deptoE<?php echo $id_cliente; ?>').val();
                                                                    var id_domicilio = '<?php echo $id_domicilio; ?>';


                                                                    // Verificar si todos los campos requeridos están llenos
                                                                    if (nombre_cliente === '' || razon_social === '' || cuit === '' || pais === '' || provincia === '' || localidad === '' || domicilio === '' || numero === '') {
                                                                        alert('Todos los campos marcados con * son obligatorios.');
                                                                    } else {
                                                                        // Realizar la solicitud AJAX para enviar los datos actualizados
                                                                        $.ajax({
                                                                            type: "POST", // Cambiar a POST para enviar datos sensibles
                                                                            url: "../app/controllers/clientes/update.php",
                                                                            data: {
                                                                                id_cliente: id_cliente,
                                                                                nombre_cliente: nombre_cliente,
                                                                                razon_social: razon_social,
                                                                                telefono: telefono,
                                                                                cuit: cuit,
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
                                                        
                                                        <a href="deleteemp.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i>Borrar</a>
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
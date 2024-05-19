<?php include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "Vendedor") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/paises/listado_de_paises.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Proveedores
                        <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus ml-2"></i>
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
                                            <center>Proveedor</center>
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
                                            <center>Cuit</center>
                                        </th>
                                        <th>
                                            <center>Comercial</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
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
                                        $nombre_proveedor = $proveedores_datos['nombre_proveedor'];
                                        $id_domicilio = $proveedores_datos['id_domicilio']; ?>
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
                                            <td><?php echo $proveedores_datos['cuit']; ?></td>
                                            <td><?php echo $proveedores_datos['responsable_comercial']; ?></td>
                                            <td><?php echo $proveedores_datos['email']; ?></td>

                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_proveedor; ?>">
                                                        <i class="fa fa-eye"></i>
                                                        Ver
                                                    </button>
                                                    <!-- modal para ver proveedores-->
                                                    <div class="modal fade" id="modal-ver<?php echo $id_proveedor; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                    <h4 class="modal-title">Datos del proveedor</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celu<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="tel<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>CUIT <b>*</b></label>
                                                                                <input type="text" id="cui<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Condición IVA <b>*</b></label>
                                                                                <input type="text" id="iv<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['iva']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Comercial </label>
                                                                                <input type="text" id="com<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="emp<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="ema<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Pais<b>*</b></label>
                                                                                <input type="text" id="pai<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Provincia<b>*</b></label>
                                                                                <input type="text" id="prov<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Localidad </label>
                                                                                <input type="text" id="loc<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Domicilio<b>*</b></label>
                                                                                <input type="text" id="dom<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nro<b>*</b></label>
                                                                                <input type="text" id="num<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Piso </label>
                                                                                <input type="text" id="pis<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Depto<b>*</b></label>
                                                                                <input type="text" id="dpto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_depto<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
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
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_proveedor; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                        Editar
                                                    </button>
                                                    <!-- modal para actualizar proveedores-->
                                                    <div class="modal fade" id="modal-update<?php echo $id_proveedor; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:darkgreen; color:white">
                                                                    <h4 class="modal-title">Actualizacion del proveedor</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre_proveedor<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control">
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celular<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="telefono<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>CUIT <b>*</b></label>
                                                                                <input type="text" id="cuit<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control">
                                                                                <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Condición IVA <b>*</b></label>
                                                                                <input type="text" id="iva<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['iva']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Comercial </label>
                                                                                <input type="text" id="comercial<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="empresa<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="email<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Pais<b>*</b></label>
                                                                                <input type="text" id="pais<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Provincia<b>*</b></label>
                                                                                <input type="text" id="provincia<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Localidad </label>
                                                                                <input type="text" id="localidad<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_localidad<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Domicilio<b>*</b></label>
                                                                                <input type="text" id="domicilio<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nro<b>*</b></label>
                                                                                <input type="text" id="numero<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>">
                                                                                <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Piso </label>
                                                                                <input type="text" id="piso<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Depto<b>*</b></label>
                                                                                <input type="text" id="depto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>">
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
                                                            var cuit = $('#cuit<?php echo $id_proveedor; ?>').val();
                                                            var iva = $('#iva<?php echo $id_proveedor; ?>').val();
                                                            var comercial = $('#comercial<?php echo $id_proveedor; ?>').val();
                                                            var empresa = $('#empresa<?php echo $id_proveedor; ?>').val();
                                                            var email = $('#email<?php echo $id_proveedor; ?>').val();
                                                            var pais = $('#pais<?php echo $id_proveedor; ?>').val();
                                                            var provincia = $('#provincia<?php echo $id_proveedor; ?>').val();
                                                            var localidad = $('#localidad<?php echo $id_proveedor; ?>').val();
                                                            var domicilio = $('#domicilio<?php echo $id_proveedor; ?>').val();
                                                            var numero = $('#numero<?php echo $id_proveedor; ?>').val();
                                                            var piso = $('#piso<?php echo $id_proveedor; ?>').val();
                                                            var depto = $('#depto<?php echo $id_proveedor; ?>').val();
                                                            var id_domicilio = '<?php echo $id_domicilio; ?>';

                                                            // Verificar si todos los campos requeridos están llenos
                                                            if (nombre_proveedor === '' || celular === '' || cuit === '' || iva === '' || empresa === '' || pais === '' || provincia === '' || localidad === '' || domicilio === '' || numero === '') {
                                                                alert('Todos los campos marcados con * son obligatorios.');
                                                            } else {
                                                                // Realizar la solicitud AJAX para enviar los datos actualizados
                                                                $.ajax({
                                                                    type: "POST", // Cambiar a POST para enviar datos sensibles
                                                                    url: "../app/controllers/proveedores/update.php",
                                                                    data: {
                                                                        id_proveedor: id_proveedor,
                                                                        nombre_proveedor: nombre_proveedor,
                                                                        celular: celular,
                                                                        telefono: telefono,
                                                                        cuit: cuit,
                                                                        iva: iva,
                                                                        comercial: comercial,
                                                                        empresa: empresa,
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
                                                                        $('#respuesta_update<?php echo $id_proveedor; ?>').html(response);
                                                                        console.log("Solicitud AJAX exitosa. Respuesta del servidor:", response);
                                                                    },
                                                                    error: function(xhr, textStatus, errorThrown) {
                                                                        console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
                                                                    }
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
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:red; color:white">
                                                                    <h4 class="modal-title">¿Esta seguro de eliminar al proveedor?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nombre del proveedor <b>*</b></label>
                                                                                <input type="text" id="nombre<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Celular <b>*</b></label>
                                                                                <input type="number" id="celu<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Telefono</label>
                                                                                <input type="number" id="tel<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>CUIT <b>*</b></label>
                                                                                <input type="text" id="cui<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control" disabled>
                                                                                <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Condición IVA <b>*</b></label>
                                                                                <input type="text" id="iv<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['iva']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Comercial </label>
                                                                                <input type="text" id="com<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Empresa<b>*</b></label>
                                                                                <input type="email" id="emp<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Email </label>
                                                                                <input type="text" id="ema<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Pais<b>*</b></label>
                                                                                <input type="text" id="pai<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Provincia<b>*</b></label>
                                                                                <input type="text" id="prov<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Localidad </label>
                                                                                <input type="text" id="loc<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Domicilio<b>*</b></label>
                                                                                <input type="text" id="dom<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Nro<b>*</b></label>
                                                                                <input type="text" id="num<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Piso </label>
                                                                                <input type="text" id="pis<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>" disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Depto<b>*</b></label>
                                                                                <input type="text" id="dpto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>" disabled>
                                                                                <small style="color:red; display:none" id="lbl_depto<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Proveedor<b>*</b></label>
                                <input type="text" id="nombre_proveedor" class="form-control" placeholder="Nombre del Proveedor">
                                <small style="color:red; display:none" id="lbl_nombre">* Este campo es requerido</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="number" id="telefono" class="form-control" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Empresa</label>
                                <input type="text" id="empresa" class="form-control" placeholder="Empresa">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CUIT</label>
                                <input type="text" id="cuit" class="form-control" placeholder="XX-XXXXXXXX-X">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Condicion IVA</label>
                            <select name="" id="condicion_iva" class="form-control" required>
                                <option value="" selected>Seleccione condición</option>
                                <option value="1">Consumidor Final</option>
                                <option value="2">Exento</option>
                                <option value="3">Exterior</option>
                                <option value="4">IVA NO Alcanzado</option>
                                <option value="5">Monotributista</option>
                                <option value="6">Responsable Inscripto</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="">Domicilio</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="" id="calle" placeholder="Calle">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="" id="numero" placeholder="Numero">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="" id="piso" placeholder="Piso">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="" id="depto" placeholder="Depto">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="" id="localidad" placeholder="Localidad">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="" id="provincia" placeholder="Provincia">
                                </div>
                                <br>
                                <div class="col">
                                    <input type="text" class="form-control" name="" id="pais" placeholder="Pais">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Responsable Comercial<b>*</b></label>
                                <input type="text" id="responsable_comercial" class="form-control">
                                <small style="color:red; display:none" id="lbl_responsable_comercial">* Este campo es requerido</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefono/Celular de R.C.<b>*</b></label>
                                <input type="number" id="celular" class="form-control">
                                <small style="color:red; display:none" id="lbl_celular">* Este campo es requerido</small>
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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- SCRIPTSSS DE LA TABLA-->
<script>
    $('#btn_create').click(function() {
        var nombre_proveedor = $('#nombre_proveedor').val();
        var telefono = $('#telefono').val();
        var empresa = $('#empresa').val();
        var email = $('#email').val();
        var cuit = $('#cuit').val();
        var condicion_iva = $('#condicion_iva').val();
        var calle = $('#calle').val();
        var numero = $('#numero').val();
        var piso = $('#piso').val();
        var depto = $('#depto').val();
        var localidad = $('#localidad').val();
        var provincia = $('#provincia').val();
        var pais = $('#pais').val();
        var responsable_comercial = $('#responsable_comercial').val();
        var celular = $('#celular').val();

        if (nombre_proveedor == '') {
            $('#nombre_proveedor').focus();
            $('#lbl_nombre').css('display', 'block');
        } else if (celular == '') {
            $('#celular').focus();
            $('#lbl_celular').css('display', 'block');
        } else if (responsable_comercial == '') {
            $('#responsable_comercial').focus();
            $('#lbl_responsable_comercial').css('display', 'block');
        } else {
            var url = "../app/controllers/proveedores/create.php";
            $.get(url, {
                nombre_proveedor: nombre_proveedor,
                telefono: telefono,
                empresa: empresa,
                email: email,
                cuit: cuit,
                condicion_iva: condicion_iva,
                calle: calle,
                numero: numero,
                piso: piso,
                depto: depto,
                localidad: localidad,
                provincia: provincia,
                pais: pais,
                responsable_comercial: responsable_comercial,
                celular: celular
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
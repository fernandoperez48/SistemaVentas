<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion != "Administrador") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/usuarios/listado_de_usuarios.php';
include '../app/controllers/roles/listado_de_roles.php';
// Incluir el archivo de la clase del modal
include_once 'ModalEditarUsuario.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Usuarios
                        <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>
                </div>

            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Usuarios registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                <thead style=" background-color: gray;">
                                    <tr>
                                        <th><center>Nro</center></th>
                                        <th><center>Nombres</center></th>
                                        <th><center>Correo</center></th>
                                        <th><center>Rol del usuario</center></th>
                                        <th><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($usuarios_datos as $usuarios_datos) {
                                        $id_usuario = $usuarios_datos['id_usuarios'];
                                        $nombre_usuario = $usuarios_datos['nombres'];
                                        $imagen_usuario = $usuarios_datos['imagen'];
                                        $id_rol_usuario = $usuarios_datos['id_rol']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $usuarios_datos['nombres']; ?></td>
                                            <td><?php echo $usuarios_datos['email']; ?></td>
                                            <td><?php echo $usuarios_datos['rol']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_usuario; ?>">
                                                                <i class="fa fa-eye"></i>
                                                                Ver
                                                            </button>
                                                            <!-- modal para ver usuarios-->
                                                            <div class="modal fade" id="modal-ver<?php echo $id_usuario; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos del usuario</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Nombre del usuario</label>
                                                                                            <input type="text" id="nombre<?php echo $id_usuario; ?>" value="<?php echo $nombre_usuario; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Email </label>
                                                                                            <input type="email" id="ema<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['email']; ?>" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Rol de Usuario</label>
                                                                                            <input type="text" id="rol<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['rol']; ?>" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="">Imagen del usuario:</label>
                                                                                            <?php $imageSrc = empty($imagen_usuario) || is_null($imagen_usuario) ? $URL . '/usuarios/img/img_usuariossinimagen.jpg' : $URL . '/usuarios/img/img_usuarios' . $imagen_usuario; ?>
                                                                                            <center>
                                                                                                <img src="<?php echo $imageSrc; ?>" width="200px" style="display: block; margin: 0 auto;" class="img-fluid" alt="Imagen de <?php echo $nombre_usuario ?>">
                                                                                            </center>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                        <?php if ($rol_sesion == "Administrador") { ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_usuario; ?>">
                                    <i class="fa fa-pencil-alt"></i>
                                    Editar
                                </button>
                                <!-- modal para actualizar usuarios-->

                                <?php
                                // Llamar al método estático render de la clase ModalEditarUsuario -->
                                echo ModalEditarUsuario::render($id_usuario, $nombre_usuario, $usuarios_datos, $roles_datos, $id_rol_usuario);
                                ?>
                                <div id="respuesta_update<?php echo $id_usuario; ?>"></div>
                            </div>
                        <?php
                                        }
                        ?>

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

            </div>
        </div>
    </div>

</div>
</div>
<!-- modal para registrar usuarios-->
<?phpModalAgregarUsuario::render($roles_datos);?>

</div>

<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 10,
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
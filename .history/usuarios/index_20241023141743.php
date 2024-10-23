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
include_once 'ModalCreateUser.php';
include_once 'ModalVerUsuario.php';
include_once 'Reporte.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Usuarios
                        <button 
                            <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para registrar usuarios-->
    <?php echo ModalAgregarUsuario::render($roles_datos);?>


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
                                                            <?php
                                                            // Renderizar el modal utilizando la clase ModalVerUsuario
                                                            echo ModalVerUsuario::render($id_usuario, $nombre_usuario, $usuarios_datos, $imagen_usuario, $URL);
                                                            ?>
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
</div>

<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<?php
    // Llamar al método estático render de la clase Reporte -->
    echo Reporte::render();
?>
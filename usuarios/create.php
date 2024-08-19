<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion != "Administrador") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';

include '../app/controllers/roles/listado_de_roles.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo usuario</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-orange">
                    <div class="card-header">
                        <h3 class="card-title">Llene los datos...</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="../app/controllers/usuarios/create.php" method="post">
                                    <div class="form-group">
                                        <label for="">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" id="" placeholder="Escriba aqui el nombre del nuevo usuario..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="" placeholder="Escriba aqui el correo del nuevo usuario..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Rol</label>
                                        <select name="rol" id="" class="form-control" required>
                                            <?php
                                            foreach ($roles_datos as $roles_datos) { ?>
                                                <option value="<?php echo $roles_datos['id_rol'] ?>"><?php echo $roles_datos['rol'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contraseña</label>
                                        <input type="text" class="form-control" name="password_user" id="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Repita la contraseña</label>
                                        <input type="text" class="form-control" name="password_repeat" id="" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </div>

    <!-- Main content -->

    <!-- /.content-wrapper -->
    <?php include '../layaout/parte2.php'; ?>
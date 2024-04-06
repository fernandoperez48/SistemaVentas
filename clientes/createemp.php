<?php


include '../app/config.php';
include '../layaout/sesion.php';

//si no son los roles permitidos, me manda al index
if ($rol_sesion == "Almacen" || $rol_sesion == "EyD") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';

include '../app/controllers/roles/listado_de_roles.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un cliente empresa</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
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
                                <form action="../app/controllers/clientes/createemp.php" method="post">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" name="nombreemp" id="" placeholder="Escriba aqui el nombre del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Razon Social</label>
                                        <input type="text" class="form-control" name="razon_social" id="" placeholder="Escriba aqui la Razon Social del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">CUIT</label>
                                        <input type="text" class="form-control" name="cuit" id="" placeholder="Escriba aqui el CUIT del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telefono</label>
                                        <input type="tel" class="form-control" name="telefonoemp" id="" placeholder="Escriba aqui la Razon Social del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="emailemp" id="" placeholder="Escriba aqui el correo del nuevo usuario..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Persona Autorizada</label>
                                        <input type="text" class="form-control" name="persona_autorizada" id="" placeholder="Escriba aqui nombre y telefono de la persona autorizada..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Domicilio</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="calleemp" id="" placeholder="calle">
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" name="numeroemp" id="" placeholder="numero">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="pisoemp" id="" placeholder="piso">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="deptoemp" id="" placeholder="depto">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <a href="indexemp.php" class="btn btn-secondary">Cancelar</a>
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
    <?php include '../layaout/mensajes.php'; ?>
    <?php include '../layaout/parte2.php'; ?>
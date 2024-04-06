<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "Almacen" || $rol_sesion == "EyD") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un cliente persona</h1>
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
                                <form action="../app/controllers/clientes/createper.php" method="post">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" name="nombreper" id="" placeholder="Escriba aqui el nombre del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" id="" placeholder="Escriba aqui el apellido del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">DNI</label>
                                        <input type="text" class="form-control" name="dni" id="" placeholder="Escriba aqui el DNI del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telefono</label>
                                        <input type="tel" class="form-control" name="telefonoper" id="" placeholder="Escriba aqui la Razon Social del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="emailper" id="" placeholder="Escriba aqui el correo del nuevo cliente..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Domicilio</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="calleper" id="" placeholder="calle">
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" name="numeroper" id="" placeholder="numero">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="pisoper" id="" placeholder="piso">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="deptoper" id="" placeholder="depto">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <a href="indexper.php" class="btn btn-secondary">Cancelar</a>
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
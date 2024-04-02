<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/update_clientesemp.php';


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar cliente empresa</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualice los datos...</h3>

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

                                <form action="../app/controllers/clientes/updateemp.php" method="post">

                                    <input type="hidden" name="idEmpresa" value="<?php echo $idEmpresa; ?>">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="" value="<?php echo $nombre ?>" placeholder="Escriba aqui el nombre actualizado del cliente" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Razon Social</label>
                                        <input type="text" class="form-control" name="razon_social" id="" value="<?php echo $razon_social ?>" placeholder="Escriba aqui el Razon Social de la empresa..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">CUIT</label>
                                        <input type="text" class="form-control" name="cuit" id="" value="<?php echo $cuit ?>" placeholder="Escriba aqui el DNI correcto..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Teléfono</label>
                                        <input type="tel" class="form-control" name="telefono" id="" value="<?php echo $telefono ?>" placeholder="Escriba aqui el teléfono actualizado del cliente" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="" value="<?php echo $email ?>" placeholder="Escriba aqui el correo actualizado de la empresa..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Domicilio</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="calle" id="" value="<?php echo $calle ?>" placeholder="calle">
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control" name="numero" id="" value="<?php echo $numero ?>" placeholder="numero">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="piso" id="" value="<?php echo $piso ?>" placeholder="piso">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="depto" id="" value="<?php echo $depto ?>" placeholder="depto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Persona Autorizada</label>
                                        <input type="text" class="form-control" name="persona_autorizada" id="" value="<?php echo $persona_autorizada  ?>" placeholder="Escriba aqui el Razon Social de la empresa..." required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <a href="indexemp.php" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
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
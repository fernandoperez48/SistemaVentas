<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/clientes/show_clienteemp.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Datos del cliente - Empresa</h1>
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
                        <h3 class="card-title">Datos de la empresa...</h3>

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

                                <div class="form-group">
                                    <label for="">Id de Cliente</label>
                                    <input type="text" name="idCliente" class="form-control" value="<?php echo $idCliente ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Razon Social</label>
                                    <input type="text" name="razon_social" class="form-control" value="<?php echo $razon_social ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">CUIT</label>
                                    <input type="text" class="form-control" name="cuit" value="<?php echo $cuit; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" value="<?php echo $telefono; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Domicilio</label>
                                    <input type="text" class="form-control" name="domicilio" value="<?php
                                                                                                    if (!empty($clientesemp_datos['id_domicilio'])) {
                                                                                                        $sql_domicilio = "SELECT d.calle, d.numero, d.piso, d.depto 
                                                    FROM tb_domicilios as d 
                                                    WHERE d.id_domicilio = {$clientesemp_datos['id_domicilio']}";
                                                                                                        $query_domicilio = $pdo->prepare($sql_domicilio);
                                                                                                        $query_domicilio->execute();
                                                                                                        $domicilio_datos = $query_domicilio->fetch(PDO::FETCH_ASSOC);
                                                                                                        echo $domicilio_datos['calle'] . ' ' . $domicilio_datos['numero'] . ' ' . $domicilio_datos['piso'] . ' ' . $domicilio_datos['depto'];
                                                                                                    } else {
                                                                                                        echo "No hay domicilio";
                                                                                                    }
                                                                                                    ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Persona Autorizada</label>
                                    <input type="text" name="persona_autorizada" class="form-control" value="<?php echo $persona_autorizada ?>" disabled>
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="indexemp.php" class="btn btn-secondary">Volver</a>

                                </div>

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
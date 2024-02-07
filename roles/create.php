<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';


?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Registro de un nuevo rol</h1>
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
                        <form action="../app/controllers/roles/create.php" method="post">
                            <div class="form-group">
                                <label for="">Nombre del rol</label>
                                <input type="text" class="form-control" name="rol" id="" placeholder="Escriba aqui el nombre del nuevo rol..." required>
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
<?php include '../layaout/mensajes.php';?>
<?php include '../layaout/parte2.php';?>



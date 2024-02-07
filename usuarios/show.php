<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/usuarios/show_usuario.php';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Datos del usuario</h1>
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
                       
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Rol del usuario</label>
                                <input type="text" class="form-control" name="rol" value="<?php echo $rol; ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <a href="index.php" class="btn btn-secondary">Volver</a>
                                
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
<?php include '../layaout/mensajes.php';?>
<?php include '../layaout/parte2.php';?>



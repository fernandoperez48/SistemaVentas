<?php
include 'app/config.php';
include 'layaout/sesion.php';
include 'layaout/parte1.php';
include 'app/controllers/usuarios/listado_de_usuarios.php';
include 'app/controllers/roles/listado_de_roles.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Bienvenido al Sistema de Ventas - <?php echo $rol_sesion?></h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content">
  <div class="container-fluid">
    <br><br>
      <div class="row">
        

        

        <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $contador_de_usuarios=0;
              foreach($usuarios_datos as $usuarios_datos){
                $contador_de_usuarios=$contador_de_usuarios+1;
              }
              ?>
              <h3><?php echo $contador_de_usuarios?></h3>
              <p>Usuarios Registrados</p>
            </div>
            <a href="<?php echo $URL?>/usuarios/create.php">
            <div class="icon">
              <i class="fas fa-user-plus"></i>
            </div>
            </a>
            <a href="<?php echo $URL?>/usuarios" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $contador_de_roles=0;
              foreach($roles_datos as $roles_datos){
                $contador_de_roles=$contador_de_roles+1;
              }
              ?>
              <h3><?php echo $contador_de_roles?></h3>
              <p>Roles Registrados</p>
            </div>
            <a href="<?php echo $URL?>/roles/create.php">
            <div class="icon">
              <i class="fas fa-user-plus"></i>
            </div>
            </a>
            <a href="<?php echo $URL?>/roles" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
       
       
        
      </div>
    </div>
  </div>
  
  <!-- Main content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php include 'layaout/parte2.php'; ?>
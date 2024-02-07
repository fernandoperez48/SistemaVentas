<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/usuarios/update_usuarios.php';
include '../app/controllers/roles/listado_de_roles.php';

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Actualizar usuario</h1>
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
                       
                    <form action="../app/controllers/usuarios/update.php" method="post">
                            <input type="hidden" name="id_usuarios" value="<?php echo $id_usuario_get; ?>">
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" name="nombres" id=""    value="<?php echo$nombres ?>" placeholder="Escriba aqui el nombre del nuevo usuario..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="" value="<?php echo$email ?>" placeholder="Escriba aqui el correo del nuevo usuario..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Rol del usuario</label>
                                <select class="form-control" name="rol" id="" class="form-control">
                                  <?php 
                                  foreach($roles_datos as $roles_datos){
                                    $rol_tabla=$roles_datos['rol'];
                                    $id_rol=$roles_datos['id_rol']?>
                                    <option value="<?php echo $id_rol ?>" 
                                    <?php 
                                    if($rol_tabla==$rol){?>
                                      selected="selected"
                                    <?php
                                    }
                                    ?> ><?php echo $rol_tabla ?>
                                    </option>
                                  <?php
                                  }
                                  ?>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control" name="password_user" id="" >
                            </div>
                            <div class="form-group">
                                <label for="">Repita la contraseña</label>
                                <input type="text" class="form-control" name="password_repeat" id="" >
                            </div>
                            <br>
                            <div class="form-group">
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
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
<?php include '../layaout/mensajes.php';?>
<?php include '../layaout/parte2.php';?>



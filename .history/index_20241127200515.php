<?php
include 'app/config.php';
include 'layaout/sesion.php';
include 'layaout/parte1.php';
include 'app/controllers/usuarios/listado_de_usuarios.php';
include 'app/controllers/clientes/listado_de_clientesper.php';
include 'app/controllers/clientes/listado_de_clientesemp.php';
include 'app/controllers/roles/listado_de_roles.php';
include 'app/controllers/categorias/listado_de_categorias.php';
include 'app/controllers/almacen/listado_de_productos.php';
include 'app/controllers/compras/listado_de_compras.php';
include 'app/controllers/ventas/listado_de_ventas.php';
include 'app/controllers/proveedores/listado_de_proveedores.php';
include 'app/controllers/envios/listado_de_envios.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#ebfbfb;">
  <!-- Content Header (Page header) -->
  <!-- /.content-header -->

  <div class="content">
    <div class="container-fluid">
      <br><br>
      <div class="row">

        <!-- USUARIOS -->
        <?php if ($rol_sesion == "Administrador") { ?>

          <div class="col-lg-4 col-6">
            <div class="small-box EEF60E" style="background-color: #b0f0ff;">
              <div class="inner">
                <?php
                $contador_de_usuarios = 0;
                foreach ($usuarios_datos as $usuarios_datos) {
                  $contador_de_usuarios = $contador_de_usuarios + 1;
                }
                ?>
                <h3><?php echo $contador_de_usuarios ?></h3>
                <p>Usuarios Registrados</p>
              </div>
              <a href="#">
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
              </a>
              <a href="<?php echo $URL ?>/usuarios" class="small-box-footer">
                Mas detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <?php } ?>


        <!-- CLIENTE -->
        <?php if ($rol_sesion == "Administrador") { ?>
          <!-------------- PERSONAS -->
          <div class="col-lg-4 col-6">

            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $contador_de_clientesper = 0;
                foreach ($clientesper_datos as $clientesper_datos) {
                  $contador_de_clientesper = $contador_de_clientesper + 1;
                }
                ?>
                <h3><?php echo $contador_de_clientesper; ?></h3>
                <p>Clientes Comunes Registrados</p>
              </div>
              <a href="#">
                <div class="icon">
                  <!-- <i class="fas fa-user-plus"></i> -->

                  <i class="material-symbols-outlined">

                  </i>
                </div>
              </a>

              <a href="<?php echo $URL ?>/clientes/indexper.php" class="small-box-footer">
                Mas detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <?php } ?>

        <?php if ($rol_sesion == "Administrador") { ?>
          <!-------------- EMPRESAS -->
          <div class="col-lg-4 col-6">
            <div class="small-box" style="background-color: #ffa9dd;">
              <div class="inner">
                <?php
                $contador_de_clientesemp = 0;
                foreach ($clientesemp_datos as $clientesemp_datos) {
                  $contador_de_clientesemp = $contador_de_clientesemp + 1;
                }
                ?>
                <h3><?php echo $contador_de_clientesemp; ?></h3>
                <p>Clientes empresas registradas</p>
              </div>
              <a href="#">
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
              </a>

              <a href="<?php echo $URL ?>/clientes/indexemp.php" class="small-box-footer">
                Mas detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <?php } ?>

        <!-- ROLES -->
        <?php if ($rol_sesion == "Tecnico") { ?>
          <div class="col-lg-4 col-6">

            <div class="small-box" style="background-color:#ffd09e">
              <div class="inner">
                <?php
                $contador_de_roles = 0;
                foreach ($roles_datos as $roles_datos) {
                  $contador_de_roles = $contador_de_roles + 1;
                }
                ?>
                <h3><?php echo $contador_de_roles ?></h3>
                <p>Roles Registrados</p>
              </div>
              <a href="<?php echo $URL ?>/roles/create.php">
                <div class="icon">
                  <i class="fas fa-address-card"></i>
                </div>
              </a>
              <a href="<?php echo $URL ?>/roles" class="small-box-footer">
                Mas detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <?php } ?>

        <!-- CATEGORIAS -->
        <div class="col-lg-4 col-6">
          <div class="small-box" style="background-color:#ffd09e">
            <div class="inner">
              <?php
              $contador_de_categorias = 0;
              foreach ($categorias_datos as $categorias_datos) {
                $contador_de_categorias = $contador_de_categorias + 1;
              }
              ?>
              <h3><?php echo $contador_de_categorias ?></h3>
              <p>Categorias Registradas</p>
            </div>
            <a href="#">
              <div class="icon">
                <i class="fas fa-tags"></i>
              </div>
            </a>
            <a href="<?php echo $URL ?>/categorias" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-lg-4 col-6">
          <div class="small-box" style="background-color:#e574a1">
            <div class="inner">
              <?php
              $contador_de_productos = 0;
              foreach ($productos_datos as $productos_datos) {
                $contador_de_productos = $contador_de_productos + 1;
              }
              ?>
              <h3><?php echo $contador_de_productos ?></h3>
              <p>Productos Registrados</p>
            </div>
            <a href="#">
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
            </a>
            <a href="<?php echo $URL ?>/almacen" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- PROVEEDORES -->
        <div class="col-lg-4 col-6">

          <div class="small-box" style=" background-color: #b0f0a5;">
            <div class="inner">
              <?php
              $contador_de_proveedores = 0;
              foreach ($proveedores_datos as $proveedores_datos) {
                $contador_de_proveedores = $contador_de_proveedores + 1;
              }
              ?>
              <h3><?php echo $contador_de_proveedores ?></h3>
              <p>Proveedores Registrados</p>
            </div>
            <a href="#">
              <div class="icon">
                <i class="material-symbols-outlined">

                </i>
              </div>
            </a>
            <a href="<?php echo $URL ?>/proveedores" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- COMPRAS -->
        <div class="col-lg-4 col-6">

          <div class="small-box" style="background-color: #a1b4ff;">
            <div class="inner">
              <?php
              $contador_de_compras = 0;
              foreach ($compras_datos as $compras_datos) {
                $contador_de_compras = $contador_de_compras + 1;
              }
              ?>
              <h3><?php echo $contador_de_compras ?></h3>
              <p>Compras Registradas</p>
            </div>
            <a href="#">
              <div class="icon">

                <i class="fas fa-cart-plus"></i>

              </div>
            </a>
            <a href="<?php echo $URL ?>/compras" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- VENTAS -->
        <div class="col-lg-4 col-6">

          <div class="small-box" style="background-color: #f7f791;">
            <div class="inner">
              <?php
              $contador_de_ventas = 0;
              foreach ($ventas_datos as $ventas_datos) {
                $contador_de_ventas = $contador_de_ventas + 1;
              }
              ?>
              <h3><?php echo $contador_de_ventas ?></h3>
              <p>Ventas Realizadas</p>
            </div>
            <a href="#">
              <div class="icon">

                <i class="fas fa-cart-plus"></i>

              </div>
            </a>
            <a href="<?php echo $URL ?>/ventas" class="small-box-footer">
              Mas detalle <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- ENVIOS Y DISTRIBUICIÓN -->
        <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor" || $rol_sesion == "EyD") { ?>
          <div class="col-lg-4 col-6">
            <div class="small-box" style="background-color: #ff9699;">
              <div class="inner">
                <?php
                $contador_de_envios = 0;
                foreach ($envios_datos as $envios_datos) {
                  $contador_de_envios = $contador_de_envios + 1;
                }
                ?>
                <h3><?php echo $contador_de_envios ?></h3>
                <p>Envios Registradas</p>
              </div>
              <a href="#">
                <div class="icon">
                  <i class="fas fa-fw fa-plane"></i>
                </div>
              </a>
              <a href="<?php echo $URL ?>/envios" class="small-box-footer">
                Mas detalle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>

</div>

</div>
<!--  FIN DE WRAAPPER DE PARTE1.PHP -->

<?php include 'layaout/parte2.php'; ?>
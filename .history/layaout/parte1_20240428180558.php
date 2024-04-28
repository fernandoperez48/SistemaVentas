<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- jQuery -->
  <script src="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <style type="text/css">
    .highcharts-figure,
    .highcharts-data-table table {
      min-width: 320px;
      max-width: 800px;
      margin: 1em auto;
    }

    .highcharts-data-table table {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #ebebeb;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    .highcharts-data-table th {
      font-weight: 600;
      padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
      padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }

    input[type="number"] {
      min-width: 50px;
    }
  </style>

    <!-- Script para Graficos -->
  <script src="../code/highcharts.js"></script>
  <script src="../code/modules/exporting.js"></script>
  <script src="../code/modules/accessibility.js"></script>
</head>

<body class="hold-transition sidebar-mini">

  </script>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li>
          <a class="nav-link" role="button">Sistema de Ventas</a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo $URL ?>/index.php" class="brand-link">
        <img src="../public/images/logo.jpg" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIS VENTAS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $nombres_sesion ?></a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!--Usuarios        ------Usuarios------        Usuario-->
            <?php if ($rol_sesion == "Administrador") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Usuarios
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/usuarios" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/usuarios/create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creacion de Usuarios</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>

            <!--Clientes        ------Clientes------        Clientes-->
            <li class="nav-item">

              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Clientes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <!--SubItems personas y empresas -->
              <ul class="nav nav-treeview">
                <!--Personas -->
                <li class="nav-item">
                  <a href="<?php echo $URL ?>/clientes" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Personas</p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    <li class="nav-item">
                      <a href="<?php echo $URL ?>/clientes/indexper.php" class="nav-link">
                        <i class="far fa-circle nav-icon" style="font-size: smaller;"></i>
                        <p>Listado</p>
                      </a>
                    </li>
                    <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor") { ?>
                      <!-- Crear -->
                      <li class="nav-item">
                        <a href="<?php echo $URL ?>/clientes/createper.php" class="nav-link">
                          <i class="far fa-circle nav-icon" style="font-size: smaller;"></i>
                          <p>Crear</p>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </li>

                <!--Empresas -->
                <li class="nav-item">
                  <a href="<?php echo $URL ?>/clientes" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Empresas</p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    <li class="nav-item">
                      <a href="<?php echo $URL ?>/clientes/indexemp.php" class="nav-link">
                        <i class="far fa-circle nav-icon" style="font-size: smaller;"></i>
                        <p>Listado</p>
                      </a>
                    </li>
                    <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor") { ?>
                      <!-- Crear -->
                      <li class="nav-item">
                        <a href="<?php echo $URL ?>/clientes/createemp.php" class="nav-link">
                          <i class="far fa-circle nav-icon" style="font-size: smaller;"></i>
                          <p>Crear</p>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </li>

              </ul>
            </li>

            <!--Roles        ------Roles------        Roles-->
            <?php if ($rol_sesion == "Tecnico") { ?>

              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/roles" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Roles</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/roles/create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creacion de Rol</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>


            <!--Categorias        ------Categorias------        Categorias-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Almacen" || $rol_sesion == "Vendedor") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>
                    Categorias
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/categorias" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Categorias</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>

            <!--Almacen        ------Almacen------        Almacen-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Almacen" || $rol_sesion == "Vendedor") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-cubes"></i>
                  <p>
                    Productos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/almacen" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Productos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/almacen/create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creacion de Producto</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>

            <!--Proveedores        ------Proveedores------        Proveedores-->
            <?php if ($rol_sesion != "Vendedor") { ?>
              <!--Proveedores        ------Proveedores------        Proveedores-->
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Proveedores
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/proveedores" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de proveedores</p>
                    </a>
                  </li>

                </ul>
              </li>
            <?php } ?>


            <!--Compras        ------Compras------        Compras-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Almacen") { ?>
              <!--Compras -->
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-cart-plus"></i>
                  <p>
                    Compras
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/compras" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Compras</p>
                    </a>
                  </li>
                  <?php if ($rol_sesion == "Administrador") { ?>
                    <li class="nav-item">
                      <a href="<?php echo $URL ?>/compras/create.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Creacion de Compra</p>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php } ?>

            <!--Ventas        ------Ventas------        Ventas-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-shopping-basket"></i>
                  <p>
                    Ventas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/ventas" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Listado de Ventas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/ventas/create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Realizar venta</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>


            <!--Envio y Distribución        ------Envio y Distribución------        Envio y Distribución-->
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="fas fa-fw fa-plane"></i>
                <p>
                  Envio y Distribución
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo $URL ?>/envios" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listado de Envios</p>
                  </a>
                </li>
                <?php if ($rol_sesion == "Administrador" || $rol_sesion == "EyD") { ?>
                  <li class="nav-item">
                    <a href="<?php echo $URL ?>/envios/create.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nuevo Envio</p>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>




            <li class="nav-item">
              <a href="../app/controllers/login/cerrar_sesion.php" class="nav-link" style="background-color:red">
                <i class="nav-icon fas fa-door-closed"></i>
                <p>
                  Cerrar Sesion

                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
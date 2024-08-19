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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    <!-- jQuery -->

    <script src="../code/highcharts.js"></script>
    <script src="../code/modules/exporting.js"></script>
    <script src="../code/modules/accessibility.js"></script>
    <style>
        /* Aplica estilo a los enlaces dentro de los elementos li con la clase nav-item */
        .nav-item a {
            color: white;
            background-color: transparent;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">


    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav container-fluid">

                <a class="navbar-brand" href="http://localhost/SistemaVentas/index.php">
                    <img src="<?php echo $URL; ?>/public/images/fainsumocartel.png" alt="logofainsumos" style="max-width:150px;">
                </a>

                <li>
                    <a href="#" class="nav-link" role="button" data-toggle="modal" data-target="#modal-usuario">
                        <?php echo $nombres_sesion ?>/<?php echo $rol_sesion ?>
                    </a>
                </li>



                <!--Usuarios        ------Usuarios------        Usuario-->
                <?php if ($rol_sesion == "Administrador") { ?>
                    <li class="nav-item dropdown back dropdown-hover">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Usuarios</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                            <li><a href="<?php echo $URL ?>/usuarios" class="dropdown-item">Listado de Usuarios</a></li>
                            <li><a href="<?php echo $URL ?>/usuarios/create.php" class="dropdown-item">Creacion de Usuarios</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <!--Clientes        ------Clientes------        Clientes-->

                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Clientes</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <!-- Level one dropdown -->
                        <li class="dropdown-submenu dropdown-hover">
                            <li><a href="<?php echo $URL ?>/clientes/indexper.php" class="dropdown-item">Personas</a></li>
                        </li>
                        <!-- End Level one -->
                        <li class="dropdown-divider"></li>
                        <!-- Level one dropdown -->
                        <li class="dropdown-submenu dropdown-hover">
                        <a href="<?php echo $URL ?>/clientes/indexemp.php" class="dropdown-item">Empresas</a>
                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow " style="background-color:#343a40;">
                                <li><a href="<?php echo $URL ?>/clientes/indexemp.php" class="dropdown-item">Listado</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <!--Roles       ------Roles------        Roles-->
                <?php if ($rol_sesion == "Tecnico") { ?>
                    <li class="nav-item dropdown dropdown-hover">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Roles</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                            <li><a href="<?php echo $URL ?>/roles" class="dropdown-item">Listado de Roles</a></li>
                            <li><a href="<?php echo $URL ?>/roles/create.php" class="dropdown-item">Creacion de Rol</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <!--Categorias       ------Categorias------        Categorias-->

                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Categorias</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <li><a href="<?php echo $URL ?>/categorias" class="dropdown-item">Listado de Categorias</a></li>
                    </ul>
                </li>


                <!--Productos       ------Productos------        Productos-->

                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Productos</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <li><a href="<?php echo $URL ?>/almacen" class="dropdown-item">Listado de Productos</a></li>
                        <?php if ($rol_sesion == "Administrador" || $id_usuarios_sesion == "4") { ?>
                            <li><a href="<?php echo $URL ?>/almacen/create.php" class="dropdown-item">Crear Producto</a></li>
                        <?php } ?>
                    </ul>
                </li>


                <!--Proveedores      ------Proveedores------        Proveedores-->

                <!--Usuarios        ------Usuarios------        Usuario-->
                <?php if ($id_rol != "5") { ?>
                    <li class="nav-item dropdown dropdown-hover">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proveedores</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                            <li><a href="<?php echo $URL ?>/proveedores" class="dropdown-item">Listado de Proveedores</a></li>
                            <li><a href="<?php echo $URL ?>/proveedores/reportes.php" class="dropdown-item">Reportes</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <!--Compras      ------Compras------        Compras-->
                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Compras</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <li><a href="<?php echo $URL ?>/compras" class="dropdown-item">Listado de Compras</a></li>
                        <?php if ($rol_sesion == "Administrador" || $id_usuarios_sesion == "4") { ?>
                            <li><a href="<?php echo $URL ?>/compras/create.php" class="dropdown-item">Registrar Compra</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <!--Ventas      ------Ventas------        Ventas-->
                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ventas</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <li><a href="<?php echo $URL ?>/ventas" class="dropdown-item">Listado de Ventas</a></li>
                        <?php if ($rol_sesion == "Administrador" || $id_usuarios_sesion == "3") { ?>
                            <li><a href="<?php echo $URL ?>/ventas/create.php" class="dropdown-item">Registrar Venta</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <!--Envío y Distribución      ------Envío y Distribución------        Envío y Distribución-->
                <li class="nav-item dropdown dropdown-hover">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Envío y Distribución</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="background-color:#343a40;">
                        <li><a href="<?php echo $URL ?>/envios" class="dropdown-item">Listado de Envíos</a></li>
                        <?php if ($rol_sesion == "Administrador" || $id_usuarios_sesion == "1") { ?>
                            <li><a href="<?php echo $URL ?>/envios/create.php" class="dropdown-item">Nuevo Envío</a></li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Productos Críticos -->
                <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor" || $rol_sesion == "Encargado de Compras") { ?>
                    <li class="nav-item">
                        <a href="<?php echo $URL ?>/productos_criticos.php" class="nav-link">Productos Críticos</a>
                    </li>
                <?php } ?>

                <!--Cerrar Sesion      ------Cerrar Sesion------        Cerrar Sesion-->
                <li class="nav-item">
                    <a href="<?php echo $URL ?>/app/controllers/login/cerrar_sesion.php" class="nav-link" style="background-color:#ff6961">
                        <i class="nav-icon fas fa-door-closed"> Salir</i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.n
         
                <!-- Modal -->
        <div class="modal fade" id="modal-usuario" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-usuarioLabel"><?php echo $nombres_sesion ?> - <?php echo $rol_sesion ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php $imageSrc = empty($imagen_sesion) || is_null($imagen_sesion) ? $URL . '/usuarios/img/img_usuariossinimagen.jpg' : $URL . '/usuarios/img/img_usuarios' . $imagen_sesion; ?>
                        <img src="<?php echo $imageSrc; ?>" width="200px" style="display: block; margin: 0 auto;" class="img-fluid" alt="Imagen de <?php echo $nombres_sesion ?>">
                    </div>
                </div>
            </div>
        </div>
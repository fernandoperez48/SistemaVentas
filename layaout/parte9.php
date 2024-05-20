<nav class="main-header navbar navbar-expand-md navbar-light" style="background-color: white;">
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <a class="navbar-brand">
            <img src="<?php echo $URL; ?>/public/images/fainsumocartel.png" alt="logofainsumos" style="max-width:200px;">
        </a>
        <div class="image">
            <img src="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px;">
        </div>
        <div class="info">
            <a href="../index.php"><?php echo $nombres_sesion ?></a>
        </div>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/SistemaVentas/index.php" role="button"></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <!--Usuarios        ------Usuarios------        Usuario-->
            <?php if ($rol_sesion == "Administrador") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Usuarios</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?php echo $URL ?>/usuarios" class="dropdown-item">Listado de Usuarios</a></li>
                        <li><a href="<?php echo $URL ?>/usuarios/create.php" class="dropdown-item">Creacion de Usuarios</a></li>
                    </ul>
                </li>
            <?php } ?>

            <!--Clientes        ------Clientes------        Clientes-->

            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Clientes</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Personas</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                            <li><a href="<?php echo $URL ?>/clientes/indexper.php" class="dropdown-item">Listado</a></li>
                            <li><a href="<?php echo $URL ?>/clientes/createper.php" class="dropdown-item">Crear</a></li>
                        </ul>
                    </li>
                    <!-- End Level two -->
                    <li class="dropdown-divider"></li>
                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Personas</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                            <li><a href="<?php echo $URL ?>/clientes/indexemp.php" class="dropdown-item">Listado</a></li>
                            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Vendedor") { ?>
                                <li><a href="<?php echo $URL ?>/clientes/createemp.php" class="dropdown-item">Crear</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--Roles       ------Roles------        Roles-->
            <?php if ($rol_sesion == "Tecnico") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Roles</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?php echo $URL ?>/roles" class="dropdown-item">Listado de Roles</a></li>
                        <li><a href="<?php echo $URL ?>/roles/create.php" class="dropdown-item">Creacion de Rol</a></li>
                    </ul>
                </li>
            <?php } ?>

            <!--Categorias       ------Categorias------        Categorias-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Almacen" || $rol_sesion == "Vendedor") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Categorias</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?php echo $URL ?>/categorias" class="dropdown-item">Listado de Categorias</a></li>
                    </ul>
                </li>
            <?php } ?>

            <!--Productos       ------Productos------        Productos-->
            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Almacen" || $rol_sesion == "Vendedor") { ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Productos</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?php echo $URL ?>/almacen" class="dropdown-item">Listado de Productos</a></li>
                        <li><a href="<?php echo $URL ?>/almacen/create.php" class="dropdown-item">Crear Producto</a></li>
                    </ul>
                </li>
            <?php } ?>

            <!--Proveedores      ------Proveedores------        Proveedores-->
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proveedores</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo $URL ?>/proveedores" class="dropdown-item">Listado de Proveedores</a></li>
                    <li><a href="<?php echo $URL ?>/proveedores/reportes.php" class="dropdown-item">Reportes</a></li>
                </ul>
            </li>

            <!--Compras      ------Compras------        Compras-->
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Compras</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo $URL ?>/compras" class="dropdown-item">Listado de Compras</a></li>
                    <li><a href="<?php echo $URL ?>/compras/create.php" class="dropdown-item">Registrar Compra</a></li>
                </ul>
            </li>

            <!--Ventas      ------Ventas------        Ventas-->
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ventas</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo $URL ?>/ventas" class="dropdown-item">Listado de Ventas</a></li>
                    <li><a href="<?php echo $URL ?>/ventas/create.php" class="dropdown-item">Registrar Venta</a></li>
                </ul>
            </li>

            <!--Envío y Distribución      ------Envío y Distribución------        Envío y Distribución-->
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Envío y Distribución</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo $URL ?>/envios" class="dropdown-item">Listado de Envíos</a></li>
                    <li><a href="<?php echo $URL ?>/envios/create.php" class="dropdown-item">Nuevo Envío</a></li>
                </ul>
            </li>

            <!--Cerrar Sesion      ------Cerrar Sesion------        Cerrar Sesion-->
            <li class="nav-item">
                <a href="../app/controllers/login/cerrar_sesion.php" class="nav-link">Salir</a>
            </li>
        </ul>


    </div>
</nav>
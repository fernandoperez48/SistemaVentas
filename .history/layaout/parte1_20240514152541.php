<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Sistema de Ventas</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <!-- Usuarios -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Usuarios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
              <a class="dropdown-item" href="#">Listado de Usuarios</a>
              <a class="dropdown-item" href="#">Creación de Usuarios</a>
            </div>
          </li>
          <!-- Clientes -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownClientes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Clientes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownClientes">
              <a class="dropdown-item" href="#">Personas</a>
              <a class="dropdown-item" href="#">Empresas</a>
            </div>
          </li>
          <!-- Roles -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRoles" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Roles
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownRoles">
              <a class="dropdown-item" href="#">Listado de Roles</a>
              <a class="dropdown-item" href="#">Creación de Rol</a>
            </div>
          </li>
          <!-- Categorías -->
          <li class="nav-item">
            <a class="nav-link" href="#">Categorías</a>
          </li>
          <!-- Productos -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Productos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownProductos">
              <a class="dropdown-item" href="#">Listado de Productos</a>
              <a class="dropdown-item" href="#">Creación de Producto</a>
            </div>
          </li>
          <!-- Proveedores -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProveedores" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Proveedores
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownProveedores">
              <a class="dropdown-item" href="#">Listado de Proveedores</a>
              <a class="dropdown-item" href="#">Reportes</a>
            </div>
          </li>
          <!-- Compras -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCompras" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Compras
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCompras">
              <a class="dropdown-item" href="#">Orden de Compra</a>
              <a class="dropdown-item" href="#">Facturas de Compra</a>
            </div>
          </li>
          <!-- Ventas -->
          <li class="nav-item">
            <a class="nav-link" href="#">Ventas</a>
          </li>
          <!-- Envío y Distribución -->
          <li class="nav-item">
            <a class="nav-link" href="#">Envío y Distribución</a>
          </li>
          <!-- Cerrar Sesión -->
          <li class="nav-item">
            <a class="nav-link" href="#">Cerrar Sesión</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!-- /.navbar -->
  </div>

  <!-- Bootstrap JS, jQuery, and other scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

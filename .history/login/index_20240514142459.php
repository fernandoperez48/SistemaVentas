<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <style>
    body {
      background-image: url('ruta_de_tu_imagen.jpg'); /* Cambiar 'ruta_de_tu_imagen.jpg' por la ruta de tu imagen de fondo */
      background-size: cover;
      background-position: center;
      font-family: 'Source Sans Pro', sans-serif;
      color: #fff;
    }
    .login-box {
      width: 320px;
      margin: auto;
      margin-top: 100px;
      background-color: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    }
    .login-box img {
      width: 100%;
      display: block;
      margin-bottom: 20px;
    }
    .login-box .card-header {
      background-color: transparent;
      border-bottom: none;
    }
    .login-box .card-body {
      padding: 0;
    }
    .login-box .card-body p {
      color: #fff;
      text-align: center;
      margin-bottom: 20px;
    }
    .login-box .form-control {
      border-radius: 5px;
    }
    .login-box .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      border-radius: 5px;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <img src="../public/images/logofainsumos.jpg" alt="logo">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../public/templates/AdminLTE-3.2.0/index2.html" class="h1"><b>Sistema de </b>VENTAS</a>
    </div>
    <div class="card-body">
      <p>Ingrese sus datos</p>
      <form action="../app/controllers/login/ingreso.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_user" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="../public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>

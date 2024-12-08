<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php include_once '../app/config.php'; ?>
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
      background-image: url("../public/images/fainsumoscdr.png");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    .login-box {
      background-color: black;
      /* Cambiar opacidad si es necesario */
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      padding: 10px;
    }

    .login-box img {
      width: 300px;
      opacity: 0.8;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">

    <div class="card card-outline card-primary" style="border-color: black;">
      <div class="card-header text-center bg-light">
        <a href="" class="h1">Sistema de VENTAS</a>
      </div>

      <div class="card-body">
        <h3 class="login-box-msg">Ingrese sus datos</h3>
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email" style="border-color: black;">
          <br>


          <div class="input-group-append">
            <div class="input-group-text" style="border-color: black;">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password_user" class="form-control" placeholder="Password" style="border-color: black;">
          <div class="input-group-append">
            <div class="input-group-text" style="border-color: black;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-success btn-block" id="btn_ingresar">Ingresar</button>

          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- jQuery -->
  <script src="../public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  <script>
    const baseURL = "<?php echo $URL; ?>"; // Pasar la URL desde PHP a JavaScript

    // Capturar evento de tecla Enter en los inputs de email y contraseña
    $('#email, #password_user').on('keypress', function(event) {
      if (event.key === "Enter") {
        $('#btn_ingresar').click(); // Simular clic en el botón ingresar
      }
    });

    $('#btn_ingresar').click(function() {
      let email = $('#email').val();
      let contraseña = $('#password_user').val();

      // Validaciones
      function validarEmail(email) {
        let re = /\S+@\S+\.\S+/;
        return re.test(email);
      }

      if (!validarEmail(email)) {
        alert('Formato no valido para correo electrónico.');
      } else if (contraseña === '') {
        //si contraseña esta vacia
        alert('La contraseña esta vacia');
      } else {
        // Vaciar el localStorage
        localStorage.clear();

        let formData = new FormData();
        formData.append('email', email);
        formData.append('password_user', contraseña);

        $.ajax({
          url: '../app/controllers/login/ingreso.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(datos) {
            if (datos === "success") { // Asegúrate de que ingreso.php devuelva "success" en caso de éxito
              // Redirigir a la página deseada usando la URL base
              window.location.href = baseURL + '/index.php';
            } else if (datos === "usuario_no_encontrado") { // Nueva condición para manejar el error
              alert("Usuario no encontrado");
            } else if (datos === "errorpass") { // Nueva condición para manejar el error
              alert("Contraseña incorrecta.");
            } else {
              alert("Credenciales incorrectas o error en el inicio de sesión.");
            }
          },
          error: function() {
            alert("Hubo un problema con el servidor. Por favor, inténtelo nuevamente.");
          }
        })
      }
    })
  </script>

</body>

</html>
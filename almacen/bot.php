<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS (incluye Popper.js) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" aria-expanded="false">
                        Manual close
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickable">
                        <li><a class="dropdown-item" href="#">Menu item 1</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 2</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
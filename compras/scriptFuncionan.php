<script>
    $(document).ready(function() {
        var precioTotal = <?php echo json_encode($precio_total); ?>;

        // Obtener el valor del proveedor seleccionado de la sesión
        var id_proveedorDelSelect = "<?php echo $id_proveedorDelSelect; ?>";
        // Establecer el valor del select con el valor obtenido de la sesión
        document.getElementById('id_proveedor').value = id_proveedorDelSelect;

        function updateProveedor() {
            var select = document.getElementById('id_proveedor');
            var id_proveedorDelSelect = select.value;

            console.log('Valor del proveedor seleccionado:', id_proveedorDelSelect);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/controllers/almacen/actualizar_proveedor.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('Proveedor actualizado:', xhr.responseText);
                    if (xhr.responseText.includes('Proveedor actualizado')) {
                        // Recarga la página para reflejar los cambios
                        window.location.reload();
                    }
                }
            };
            xhr.send('id_proveedor=' + encodeURIComponent(id_proveedorDelSelect));
        }

        // Agregar el evento change al select de proveedores
        $('#id_proveedor').change(updateProveedor);

        $('#proveedor_select').change(function() {
            var id_proveedor = $(this).val(); // Obtiene el valor del proveedor seleccionado
            console.log("ID del proveedor seleccionado:", id_proveedor); // Imprime el valor en la consola del navegador
            // Realiza una petición Ajax enviando solo el valor del proveedor seleccionado
            var url = "../app/controllers/almacen/listado_de_productos_por_proveedor.php";

            $.get(url, {
                    id_proveedor: id_proveedor
                })
                .done(function(response) {
                    console.log("Respuesta del servidor:", response); // Imprime la respuesta del servidor en la consola del navegador
                })
                .fail(function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error); // Imprime un mensaje de error en la consola del navegador si la solicitud AJAX falla
                });
        });

        var comprobantesExistentes = [];

        // Función para cargar los comprobantes existentes
        function cargarComprobantes() {
            $.ajax({
                url: "../app/controllers/compras/listado_de_comprobantes.php",
                method: "GET",
                success: function(data) {
                    comprobantesExistentes = JSON.parse(data);
                },
                error: function(error) {
                    console.log("Error al cargar comprobantes:", error);
                }
            });
        }

        cargarComprobantes();

        function calcularDiferenciaYPorcentaje() {
            var precioCompra = document.getElementById('precio_compra_controlador').value;
            var diferencia = precioCompra - precioTotal;
            var porcentaje = (diferencia / precioTotal) * 100;
            return {
                diferencia,
                porcentaje
            };
        }

        $("#btn_registrar_detalle_compra").click(function() {
            var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
            var id_producto = $("#id_producto").val();
            var cantidad = $("#cantidad").val();
            var precio_unitario = $("#precio_unitario").val();
            var id_proveedor = $("#id_proveedor").val();

            if (id_producto == "") {
                alert("Seleccione un producto");
            } else if (cantidad == "") {
                alert("Ingrese la cantidad");
            } else if (precio_unitario == "") {
                alert("Ingrese el precio unitario");
            } else if (precio_unitario == 0 || precio_unitario === "0") {
                alert("El precio unitario no puede ser 0");
            } else {
                var url = "../app/controllers/compras/registrar_detalle_compra.php";
                $.get(url, {
                    nro_compra: nro_compra,
                    id_producto: id_producto,
                    cantidad: cantidad,
                    precio_unitario: precio_unitario,
                    id_proveedor: id_proveedor
                }, function(datos) {
                    $('#respuesta_detalle_compra').html(datos);
                    $("#modal-buscar_producto").modal('hide');
                });
            }
        });

        $("#btn-buscar-producto").click(function(event) {
            var id_proveedor = $("#id_proveedor").val();
            console.log("ID del proveedor seleccionado: ", id_proveedor); // Línea de depuración
            if (!id_proveedor) {
                event.preventDefault(); // Evita que el modal se abra
                alert("Debes seleccionar un proveedor");
            } else {
                $('#modal-buscar_producto').modal('show'); // Abre el modal
            }
        });

        document.getElementById('btn_continuar').addEventListener('click', function() {
            var explicacion = document.getElementById('explicacion_diferencia').value;

            if (explicacion.trim() === '') {
                alert('Por favor, complete la explicación de la diferencia.');
            } else {
                $('#explicacionModal').modal('hide');
                guardarCompra(explicacion, true); // Pasamos la explicación y un flag para evitar la verificación
            }
        });

        function guardarCompra(explicacion = '', explicacionIngresada = false) { // Añadimos un parámetro para evitar la verificación
            var nro_compra = <?php echo $nro_compra_js; ?>;
            var id_productos = <?php echo $id_productos_json; ?>;
            var cantidades = <?php echo $cantidades_json; ?>;
            var id_proveedor = $("#id_proveedor").val();
            var fecha_operacion = $("#fecha_operacion").val();
            var ingreso_mercaderia = $("#ingreso_mercaderia").val();
            var comprobante = $("#comprobante").val();
            var precio_compra = $("#precio_compra_controlador").val();
            var id_usuario = '<?php echo $id_usuarios_sesion ?>';
            var resultado = ''; // Inicializamos la variable resultado

            // Verificar si el comprobante ya existe
            if (comprobantesExistentes.includes(comprobante)) {
                $('#comprobante').focus();
                alert("Ese comprobante ya existe.");
            } else if (nro_compra == "") {
                $('#nro_compra').focus();
                alert("Debe llenar el campo de compra.");
            } else if (id_proveedor == "") {
                $('#id_proveedor').focus();
                alert("Debe llenar el campo proveedor.");
            } else if (fecha_operacion == "") {
                $('#fecha_operacion').focus();
                alert("Debe llenar el campo de fecha de pago/operación.");
            } else if (ingreso_mercaderia == "") {
                $('#ingreso_mercaderia').focus();
                alert("Debe llenar el campo ingreso de mercadería.");
            } else if (comprobante == "") {
                $('#comprobante').focus();
                alert("Debe llenar el campo N° de comprobante.");
            } else if (precio_compra == "") {
                $('#precio_compra_controlador').focus();
                alert("Debe llenar el campo Costo de la compra.");
            } else if (parseFloat(precio_compra) <= 0) {
                $('#precio_compra_controlador').focus();
                alert("El costo de la compra debe ser un valor positivo.");
            } else {
                var {
                    diferencia,
                    porcentaje
                } = calcularDiferenciaYPorcentaje();

                if (!explicacionIngresada && diferencia != 0) { //aca digo que si explicacionIngresada es falsa y diferencia distinto de cero
                    var mensaje = `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%. Por favor, explique la diferencia.`;
                    alert(mensaje);
                    $('#explicacionModal').modal('show');
                } else {
                    var url = "../app/controllers/compras/create.php";
                    resultado = explicacionIngresada ? `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%.` : '---SIN DESCUENTO O RECARGA---';
                    $.get(url, {
                        nro_compra: nro_compra,
                        id_proveedor: id_proveedor,
                        fecha_operacion: fecha_operacion,
                        ingreso_mercaderia: ingreso_mercaderia,
                        comprobante: comprobante,
                        precio_compra: precio_compra,
                        id_usuario: id_usuario,
                        resultado: resultado,
                        explicacion_diferencia: explicacion, // Añadido   
                        id_productos: JSON.stringify(id_productos),
                        cantidades: JSON.stringify(cantidades)
                    }, function(datos) {
                        $('#respuesta_create').html(datos);
                        if (datos.includes("La compra se ha registrado exitosamente.")) {
                            location.reload();
                        }
                    });
                }
            }
        }

        $("#btn_guardar_compra").click(function() {
            guardarCompra(); // Primero llama a guardarCompra, se encargará de la diferencia si es necesario
        });
    });
</script>
<script>
    $(document).ready(function() {
        var precioTotal = <?php echo json_encode($precio_total); ?>;

        // Obtener el valor del proveedor seleccionado de la sesión
        var id_proveedorDelSelect = "<?php echo $id_proveedorDelSelect; ?>";
        // Establecer el valor del select con el valor obtenido de la sesión
        document.getElementById('id_proveedor').value = id_proveedorDelSelect;

        function updateProveedor() {
            var select = document.getElementById('id_proveedor');
            var id_proveedorDelSelect = select.value;

            // Obtener el número de productos en la tabla
            var cantidadProductos = $('table tbody tr').length;

            if (cantidadProductos > 0) {
                // Si hay productos en la tabla, mostrar confirmación
                if (confirm("Si elige otro proveedor, se reiniciará el proceso de compra. ¿Desea continuar?")) {
                    // Si el usuario confirma, limpiar la tabla y actualizar el proveedor
                    limpiarTabla();
                    updateProveedor();
                } else {
                    // Si el usuario cancela, salir de la función y restablecer el select
                    select.value = id_proveedorDelSelect;
                    return;
                }
            } else {
                // Si no hay productos, simplemente actualizar el proveedor
                updateProveedor();
            }

            console.log('Valor del proveedor seleccionado:', id_proveedorDelSelect);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/controllers/almacen/actualizar_proveedor.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('Proveedor actualizado:', xhr.responseText);
                    if (xhr.responseText.includes('Proveedor actualizado')) {
                        // Recarga la página para reflejar los cambios
                        window.location.reload();
                    }
                }
            };
            xhr.send('id_proveedor=' + encodeURIComponent(id_proveedorDelSelect));
        }

        // Agregar el evento change al select de proveedores
        $('#id_proveedor').change(updateProveedor);

        $('#proveedor_select').change(function() {
            var id_proveedor = $(this).val(); // Obtiene el valor del proveedor seleccionado
            console.log("ID del proveedor seleccionado:", id_proveedor); // Imprime el valor en la consola del navegador
            // Realiza una petición Ajax enviando solo el valor del proveedor seleccionado
            var url = "../app/controllers/almacen/listado_de_productos_por_proveedor.php";

            $.get(url, {
                    id_proveedor: id_proveedor
                })
                .done(function(response) {
                    console.log("Respuesta del servidor:", response); // Imprime la respuesta del servidor en la consola del navegador
                })
                .fail(function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error); // Imprime un mensaje de error en la consola del navegador si la solicitud AJAX falla
                });
        });

        var comprobantesExistentes = [];

        // Función para cargar los comprobantes existentes
        function cargarComprobantes() {
            $.ajax({
                url: "../app/controllers/compras/listado_de_comprobantes.php",
                method: "GET",
                success: function(data) {
                    comprobantesExistentes = JSON.parse(data);
                },
                error: function(error) {
                    console.log("Error al cargar comprobantes:", error);
                }
            });
        }

        cargarComprobantes();

        function calcularDiferenciaYPorcentaje() {
            var precioCompra = document.getElementById('precio_compra_controlador').value;
            var diferencia = precioCompra - precioTotal;
            var porcentaje = (diferencia / precioTotal) * 100;
            return {
                diferencia,
                porcentaje
            };
        }

        $("#btn_registrar_detalle_compra").click(function() {
            var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
            var id_producto = $("#id_producto").val();
            var cantidad = $("#cantidad").val();
            var precio_unitario = $("#precio_unitario").val();
            var id_proveedor = $("#id_proveedor").val();

            if (id_producto == "") {
                alert("Seleccione un producto");
            } else if (cantidad == "") {
                alert("Ingrese la cantidad");
            } else if (precio_unitario == "") {
                alert("Ingrese el precio unitario");
            } else if (precio_unitario == 0 || precio_unitario === "0") {
                alert("El precio unitario no puede ser 0");
            } else {
                var url = "../app/controllers/compras/registrar_detalle_compra.php";
                $.get(url, {
                    nro_compra: nro_compra,
                    id_producto: id_producto,
                    cantidad: cantidad,
                    precio_unitario: precio_unitario,
                    id_proveedor: id_proveedor
                }, function(datos) {
                    $('#respuesta_detalle_compra').html(datos);
                    $("#modal-buscar_producto").modal('hide');
                });
            }
        });

        $("#btn-buscar-producto").click(function(event) {
            var id_proveedor = $("#id_proveedor").val();
            console.log("ID del proveedor seleccionado: ", id_proveedor); // Línea de depuración
            if (!id_proveedor) {
                event.preventDefault(); // Evita que el modal se abra
                alert("Debes seleccionar un proveedor");
            } else {
                $('#modal-buscar_producto').modal('show'); // Abre el modal
            }
        });

        document.getElementById('btn_continuar').addEventListener('click', function() {
            var explicacion = document.getElementById('explicacion_diferencia').value;

            if (explicacion.trim() === '') {
                alert('Por favor, complete la explicación de la diferencia.');
            } else {
                $('#explicacionModal').modal('hide');
                guardarCompra(explicacion, true); // Pasamos la explicación y un flag para evitar la verificación
            }
        });

        function guardarCompra(explicacion = '', explicacionIngresada = false) { // Añadimos un parámetro para evitar la verificación
            var nro_compra = <?php echo $nro_compra_js; ?>;
            var id_productos = <?php echo $id_productos_json; ?>;
            var cantidades = <?php echo $cantidades_json; ?>;
            var id_proveedor = $("#id_proveedor").val();
            var fecha_operacion = $("#fecha_operacion").val();
            var ingreso_mercaderia = $("#ingreso_mercaderia").val();
            var comprobante = $("#comprobante").val();
            var precio_compra = $("#precio_compra_controlador").val();
            var id_usuario = '<?php echo $id_usuarios_sesion ?>';
            var resultado = ''; // Inicializamos la variable resultado

            // Verificar si el comprobante ya existe
            if (comprobantesExistentes.includes(comprobante)) {
                $('#comprobante').focus();
                alert("Ese comprobante ya existe.");
            } else if (nro_compra == "") {
                $('#nro_compra').focus();
                alert("Debe llenar el campo de compra.");
            } else if (id_proveedor == "") {
                $('#id_proveedor').focus();
                alert("Debe llenar el campo proveedor.");
            } else if (fecha_operacion == "") {
                $('#fecha_operacion').focus();
                alert("Debe llenar el campo de fecha de pago/operación.");
            } else if (ingreso_mercaderia == "") {
                $('#ingreso_mercaderia').focus();
                alert("Debe llenar el campo ingreso de mercadería.");
            } else if (comprobante == "") {
                $('#comprobante').focus();
                alert("Debe llenar el campo N° de comprobante.");
            } else if (precio_compra == "") {
                $('#precio_compra_controlador').focus();
                alert("Debe llenar el campo Costo de la compra.");
            } else if (parseFloat(precio_compra) <= 0) {
                $('#precio_compra_controlador').focus();
                alert("El costo de la compra debe ser un valor positivo.");
            } else {
                var {
                    diferencia,
                    porcentaje
                } = calcularDiferenciaYPorcentaje();

                if (!explicacionIngresada && diferencia != 0) { //aca digo que si explicacionIngresada es falsa y diferencia distinto de cero
                    var mensaje = `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%. Por favor, explique la diferencia.`;
                    alert(mensaje);
                    $('#explicacionModal').modal('show');
                } else {
                    var url = "../app/controllers/compras/create.php";
                    resultado = explicacionIngresada ? `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%.` : '---SIN DESCUENTO O RECARGA---';
                    $.get(url, {
                        nro_compra: nro_compra,
                        id_proveedor: id_proveedor,
                        fecha_operacion: fecha_operacion,
                        ingreso_mercaderia: ingreso_mercaderia,
                        comprobante: comprobante,
                        precio_compra: precio_compra,
                        id_usuario: id_usuario,
                        resultado: resultado,
                        explicacion_diferencia: explicacion, // Añadido   
                        id_productos: JSON.stringify(id_productos),
                        cantidades: JSON.stringify(cantidades)
                    }, function(datos) {
                        $('#respuesta_create').html(datos);
                        if (datos.includes("La compra se ha registrado exitosamente.")) {
                            location.reload();
                        }
                    });
                }
            }
        }

        $("#btn_guardar_compra").click(function() {
            guardarCompra(); // Primero llama a guardarCompra, se encargará de la diferencia si es necesario
        });

        function limpiarTabla() {
            // Implementa aquí la lógica para limpiar la tabla de productos
            // Por ejemplo, puedes vaciar el tbody de la tabla de productos
            $("#tabla_productos tbody").empty();
            // Resetea cualquier otro estado relacionado con la tabla de productos si es necesario
        }
    });
</script>
<script>
    $(document).ready(function() {
        var precioTotal = <?php echo json_encode($precio_total); ?>;
        // Obtener el valor del proveedor seleccionado de la sesión
        var id_proveedorDelSelect = "<?php echo $id_proveedorDelSelect; ?>";
        // Establecer el valor del select con el valor obtenido de la sesión
        document.getElementById('id_proveedor').value = id_proveedorDelSelect;

        function tieneDatosEnTabla() {
            var tabla = document.getElementById('tabla_compra_en_curso');
            var filas = tabla.getElementsByTagName('tr');
            var tieneDatos = filas.length > 1;
            console.log("La tabla tiene datos:", tieneDatos); // Agrega esta línea para mostrar en la consola si la tabla tiene datos
            return tieneDatos;
        }

        function limpiarTabla() {
            // Selecciona el tbody de la tabla con id 'tabla_compra_en_curso' y vacía su contenido
            // $("#tabla_compra_en_curso tbody").empty();

            // Realiza una petición AJAX para eliminar los datos de la compra en la base de datos
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/controllers/compras/eliminar_compra.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                    if (xhr.responseText.includes('Compra eliminada')) {
                        // Opcionalmente, puedes hacer algo más después de que la compra haya sido eliminada
                        console.log("Compra eliminada correctamente de la base de datos.");
                    } else {
                        console.error("Error al eliminar la compra:", xhr.responseText);
                    }
                }
            };
            xhr.send();
        }

        $('#id_proveedor').change(function() {
            if (tieneDatosEnTabla()) {
                var confirmacion = confirm('Si cambia de proveedor, se borrará la compra en curso. ¿Desea continuar?');
                if (!confirmacion) {
                    return; // Si el usuario no confirma, no se realiza ninguna acción adicional
                } else {
                    limpiarTabla(); // Llama a la función para limpiar la tabla
                }
            }
            updateProveedor();
        });

        function updateProveedor() {
            var select = document.getElementById('id_proveedor');
            var id_proveedorDelSelect = select.value;

            console.log('Valor del proveedor seleccionado:', id_proveedorDelSelect);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../app/controllers/almacen/actualizar_proveedor.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log('Proveedor actualizado:', xhr.responseText);
                    if (xhr.responseText.includes('Proveedor actualizado')) {
                        // Recarga la página para reflejar los cambios
                        window.location.reload();
                    }
                }
            };
            xhr.send('id_proveedor=' + encodeURIComponent(id_proveedorDelSelect));
        }

        // Eliminar la segunda llamada al evento change para evitar redundancias
        // $('#id_proveedor').change(updateProveedor);

        $('#proveedor_select').change(function() {
            var id_proveedor = $(this).val(); // Obtiene el valor del proveedor seleccionado
            console.log("ID del proveedor seleccionado:", id_proveedor); // Imprime el valor en la consola del navegador
            // Realiza una petición Ajax enviando solo el valor del proveedor seleccionado
            var url = "../app/controllers/almacen/listado_de_productos_por_proveedor.php";

            $.get(url, {
                    id_proveedor: id_proveedor
                })
                .done(function(response) {
                    console.log("Respuesta del servidor:", response); // Imprime la respuesta del servidor en la consola del navegador
                })
                .fail(function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error); // Imprime un mensaje de error en la consola del navegador si la solicitud AJAX falla
                });
        });

        var comprobantesExistentes = [];

        // Función para cargar los comprobantes existentes
        function cargarComprobantes() {
            $.ajax({
                url: "../app/controllers/compras/listado_de_comprobantes.php",
                method: "GET",
                success: function(data) {
                    comprobantesExistentes = JSON.parse(data);
                },
                error: function(error) {
                    console.log("Error al cargar comprobantes:", error);
                }
            });
        }

        cargarComprobantes();

        function calcularDiferenciaYPorcentaje() {
            var precioCompra = document.getElementById('precio_compra_controlador').value;
            var diferencia = precioCompra - precioTotal;
            var porcentaje = (diferencia / precioTotal) * 100;
            return {
                diferencia,
                porcentaje
            };
        }

        $("#btn_registrar_detalle_compra").click(function() {
            var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
            var id_producto = $("#id_producto").val();
            var cantidad = $("#cantidad").val();
            var precio_unitario = $("#precio_unitario").val();
            var id_proveedor = $("#id_proveedor").val();

            if (id_producto == "") {
                alert("Seleccione un producto");
            } else if (cantidad == "") {
                alert("Ingrese la cantidad");
            } else if (precio_unitario == "") {
                alert("Ingrese el precio unitario");
            } else if (precio_unitario == 0 || precio_unitario === "0") {
                alert("El precio unitario no puede ser 0");
            } else {
                var url = "../app/controllers/compras/registrar_detalle_compra.php";
                $.get(url, {
                    nro_compra: nro_compra,
                    id_producto: id_producto,
                    cantidad: cantidad,
                    precio_unitario: precio_unitario,
                    id_proveedor: id_proveedor
                }, function(datos) {
                    $('#respuesta_detalle_compra').html(datos);
                    $("#modal-buscar_producto").modal('hide');
                });
            }
        });

        $("#btn-buscar-producto").click(function(event) {
            var id_proveedor = $("#id_proveedor").val();
            console.log("ID del proveedor seleccionado: ", id_proveedor); // Línea de depuración
            if (!id_proveedor) {
                event.preventDefault(); // Evita que el modal se abra
                alert("Debes seleccionar un proveedor");
            } else {
                $('#modal-buscar_producto').modal('show'); // Abre el modal
            }
        });

        document.getElementById('btn_continuar').addEventListener('click', function() {
            var explicacion = document.getElementById('explicacion_diferencia').value;

            if (explicacion.trim() === '') {
                alert('Por favor, complete la explicación de la diferencia.');
            } else {
                $('#explicacionModal').modal('hide');
                guardarCompra(explicacion, true); // Pasamos la explicación y un flag para evitar la verificación
            }
        });

        function guardarCompra(explicacion = '', explicacionIngresada = false) { // Añadimos un parámetro para evitar la verificación
            var nro_compra = <?php echo $nro_compra_js; ?>;
            var id_productos = <?php echo $id_productos_json; ?>;
            var cantidades = <?php echo $cantidades_json; ?>;
            var id_proveedor = $("#id_proveedor").val();
            var fecha_operacion = $("#fecha_operacion").val();
            var ingreso_mercaderia = $("#ingreso_mercaderia").val();
            var comprobante = $("#comprobante").val();
            var precio_compra = $("#precio_compra_controlador").val();
            var id_usuario = '<?php echo $id_usuarios_sesion ?>';
            var resultado = ''; // Inicializamos la variable resultado

            // Verificar si el comprobante ya existe
            if (comprobantesExistentes.includes(comprobante)) {
                $('#comprobante').focus();
                alert("Ese comprobante ya existe.");
            } else if (nro_compra == "") {
                $('#nro_compra').focus();
                alert("Debe llenar el campo de compra.");
            } else if (id_proveedor == "") {
                $('#id_proveedor').focus();
                alert("Debe llenar el campo proveedor.");
            } else if (fecha_operacion == "") {
                $('#fecha_operacion').focus();
                alert("Debe llenar el campo de fecha de pago/operación.");
            } else if (ingreso_mercaderia == "") {
                $('#ingreso_mercaderia').focus();
                alert("Debe llenar el campo ingreso de mercadería.");
            } else if (comprobante == "") {
                $('#comprobante').focus();
                alert("Debe llenar el campo N° de comprobante.");
            } else if (precio_compra == "") {
                $('#precio_compra_controlador').focus();
                alert("Debe llenar el campo Costo de la compra.");
            } else if (parseFloat(precio_compra) <= 0) {
                $('#precio_compra_controlador').focus();
                alert("El costo de la compra debe ser un valor positivo.");
            } else {
                var {
                    diferencia,
                    porcentaje
                } = calcularDiferenciaYPorcentaje();

                if (!explicacionIngresada && diferencia != 0) { //aca digo que si explicacionIngresada es falsa y diferencia distinto de cero
                    var mensaje = `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%. Por favor, explique la diferencia.`;
                    alert(mensaje);
                    $('#explicacionModal').modal('show');
                } else {
                    var url = "../app/controllers/compras/create.php";
                    resultado = explicacionIngresada ? `El costo final tiene un ${diferencia > 0 ? 'recargo' : 'descuento'} de ${Math.abs(porcentaje.toFixed(2))}%.` : '---SIN DESCUENTO O RECARGA---';
                    $.get(url, {
                        nro_compra: nro_compra,
                        id_proveedor: id_proveedor,
                        fecha_operacion: fecha_operacion,
                        ingreso_mercaderia: ingreso_mercaderia,
                        comprobante: comprobante,
                        precio_compra: precio_compra,
                        id_usuario: id_usuario,
                        resultado: resultado,
                        explicacion_diferencia: explicacion, // Añadido   
                        id_productos: JSON.stringify(id_productos),
                        cantidades: JSON.stringify(cantidades)
                    }, function(datos) {
                        $('#respuesta_create').html(datos);
                        if (datos.includes("La compra se ha registrado exitosamente.")) {
                            location.reload();
                        }
                    });
                }
            }
        }

        $("#btn_guardar_compra").click(function() {
            guardarCompra(); // Primero llama a guardarCompra, se encargará de la diferencia si es necesario
        });

    });
</script>
$("#btn_registrar_detalle_compra").click(function() {
var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
var id_producto = $("#id_producto").val();
var cantidad = $("#cantidad").val();
var precio_unitario = $("#precio_unitario").val().replace(',', '.'); // Convertir comas a puntos
var id_proveedor = $("#id_proveedor").val();

if (id_producto == "") {
alert("Seleccione un producto");
} else if (cantidad == "") {
alert("Ingrese la cantidad");
} else if (precio_unitario == "") {
alert("Ingrese el precio unitario");
} else if (precio_unitario == 0 || precio_unitario === "0") {
alert("El precio unitario no puede ser 0");
} else {
var url = "../app/controllers/compras/registrar_detalle_compra.php";
$.get(url, {
nro_compra: nro_compra,
id_producto: id_producto,
cantidad: cantidad,
precio_unitario: precio_unitario,
id_proveedor: id_proveedor
}, function(datos) {
$('#respuesta_detalle_compra').html(datos);
$("#modal-buscar_producto").modal('hide');
});
}
});
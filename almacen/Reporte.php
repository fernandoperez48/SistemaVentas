<?php

class Reporte
{
    public static function render($categorias_datos, $proveedores_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <script>
            $(document).ready(function() {
                var table = $("#example1").DataTable({
                    "pageLength": 5,
                    searching: true,
                    language: {
                        "emptyTable": "No hay información",
                        "decimal": "",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Productos",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscador:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "buttons": [{
                            extend: 'collection',
                            text: 'Reportes',
                            orientation: 'landscape',
                            buttons: [{
                                text: 'Copiar',
                                extend: 'copy'
                            }, {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':not(:nth-child(1)):not(:nth-child(2)):not(:nth-child(5)):not(:nth-child(8)):not(:nth-child(9)):not(:last-child)' // Excluye la última columna
                                }
                            }, {
                                extend: 'csv',
                            }, {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':not(:nth-child(1)):not(:nth-child(5)):not(:last-child)' // Excluye la última columna
                                }
                            }, {
                                text: 'Imprimir',
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(:nth-child(5)):not(:last-child)' // Excluye la última columna
                                }
                            }]
                        },
                        {
                            extend: 'colvis',
                            text: 'Visor de columnas'
                        }
                    ],
                    "dom": '<"top"lfB><"filter-price">rt<"bottom"ip><"clear">',
                });



                // Añadir inputs en los encabezados de las columnas

                $('#example1 thead tr').clone(true).appendTo('#example1 thead');
                $('#example1 thead tr:eq(1) th').each(function(index) {
                    var title = $(this).text().trim();
                    if (title === 'Codigo' || title === 'Nombre' || title === 'Descripcion' || title === 'Talle') {
                        // Crear input de búsqueda para estos títulos
                        $(this).html('<input type="text" class="form-control" placeholder="Buscar" style="height: 30px; width: 70px;"/>');
                        // Filtro para los inputs de búsqueda (SOLO para estos títulos)
                        $(this).find('input').on('keyup change', function() {
                            const columnIndex = $(this).closest('th').index() + ':visible'; // Obtiene el índice de la columna visible
                            table.column(columnIndex).search(this.value).draw();
                        });
                    } else if (title === 'Nro' || title === 'Imagen' || title === 'Color' || title === 'Stock' || title === 'Acciones') {
                        $(this).html(''); // Deja la celda vacía para "Nro", "Imagen", y "Acciones"
                    } else if (title === 'Precio Compra') {
                        // Crear dos inputs para valor numérico en la misma fila
                        $(this).html('<div style="display: flex; gap: 10px;">' +
                            '<input type="number" class="form-control" placeholder="Min Compra" id="minPriceCompra" style="height: 30px; width: 70px;" step="0.01">' +
                            '<input type="number" class="form-control" placeholder="Max Compra" id="maxPriceCompra" style="height: 30px; width: 70px;" step="0.01">' +
                            '</div>');
                        // Filtrado para el rango de precios
                        $('#minPriceCompra, #maxPriceCompra').on('input', function() {
                            table.draw(); // Redibujar la tabla para aplicar el filtro
                        });
                    } else if (title === 'Precio Venta') {
                        // Crear dos inputs para valor numérico en la misma fila
                        $(this).html('<div style="display: flex; gap: 10px;">' +
                            '<input type="number" class="form-control" placeholder="Min Venta" id="minPriceVenta" style="height: 30px; width: 70px;" step="0.01">' +
                            '<input type="number" class="form-control" placeholder="Max Venta" id="maxPriceVenta" style="height: 30px; width: 70px;" step="0.01">' +
                            '</div>');
                        // Filtrado para el rango de precios
                        $('#minPriceVenta, #maxPriceVenta').on('input', function() {
                            table.draw(); // Redibujar la tabla para aplicar el filtro
                        });
                    } else if (title === 'Categoria') {
                        // Crear select para Categoría
                        $(this).html('<select class="form-control" id="selectCategoria" style="width: 80%; height: 30px; font-size: 14px; box-sizing: border-box;"><option value="">...</option></select>');
                        // Añadir opciones de categorías desde PHP
                        <?php foreach ($categorias_datos as $categoria) { ?>
                            $('#selectCategoria').append('<option value="<?php echo $categoria['nombre_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>');
                        <?php } ?>
                    } else if (title === 'Proveedor') {
                        // Crear select para Proveedor
                        $(this).html('<select class="form-control" id="selectProveedor" style="width: 80%; height: 30px; font-size: 14px; box-sizing: border-box;"><option value="">...</option></select>');
                        // Añadir opciones de proveedores desde PHP
                        <?php foreach ($proveedores_datos as $proveedor) { ?>
                            $('#selectProveedor').append('<option value="<?php echo $proveedor['nombre_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>');
                        <?php } ?>
                    } else if (title === 'Fecha Compra') {
                        // Crear dos inputs de tipo date
                        $(this).html('<div style="display: flex; gap: 10px;">' +
                            '<input type="date" class="form-control" id="minFechaCompra" style="height: 30px; width: 70px;"/>' +
                            '<input type="date" class="form-control" id="maxFechaCompra" style="height: 30px; width: 70px;"/>' +
                            '</div>');
                    }

                    // FILTRO PARA EL SELECT DE CATEGORIA
                    $('#selectCategoria').on('change', function() {
                        var categoriaIndex = $('#selectCategoria').closest('th').index(); // Obtiene el índice de la columna
                        table.column(categoriaIndex).search(this.value).draw();
                    });

                    // FILTRO PAARA EL SELECT DE CATEGORIA
                    $('#selectProveedor').on('change', function() {
                        var proveedorIndex = $('#selectProveedor').closest('th').index(); // Obtiene el índice de la columna
                        table.column(proveedorIndex).search(this.value).draw();
                    });

                    // FUNCION DE FILTRADO PERSONALIZADO DE DATATABLES PARA RANGOS NUMERICOS ----- COMPRA
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        const minPrice = parseFloat($('#minPriceCompra').val()) || 0; // Mínimo valor por defecto es 0
                        const maxPrice = parseFloat($('#maxPriceCompra').val()) || Infinity; // Máximo valor por defecto es Infinito
                        const priceCompraIndex = 10; // Ajusta este índice según la posición de la columna "Precio Compra"
                        const priceCompra = parseFloat(data[priceCompraIndex].replace('$', '')) || 0;
                        return priceCompra >= minPrice && priceCompra <= maxPrice;
                        console.log("Índice de la columna 'Precio Compra':", priceCompraIndex);
                    });
                    // FUNCION DE FILTRADO PERSONALIZADO DE DATATABLES PARA RANGOS NUMERICOS ------ COMPRA
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        const minPrice = parseFloat($('#minPriceVenta').val()) || 0; // Mínimo valor por defecto es 0
                        const maxPrice = parseFloat($('#maxPriceVenta').val()) || Infinity; // Máximo valor por defecto es Infinito
                        const priceVentaIndex = 11; // Ajusta este índice según la posición de la columna "Precio Compra"
                        const priceVenta = parseFloat(data[priceVentaIndex].replace('$', '')) || 0;
                        return priceVenta >= minPrice && priceVenta <= maxPrice;
                        console.log("Índice de la columna 'Precio Venta':", priceVentaIndex);
                    });
                    // FUNCION DE FILTRADO PERSONALIZADO PARA RANGO DE FECHAS
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        const minFecha = $('#minFechaCompra').val() ? new Date($('#minFechaCompra').val()) : null; // Fecha mínima
                        const maxFecha = $('#maxFechaCompra').val() ? new Date($('#maxFechaCompra').val()) : null; // Fecha máxima
                        const fechaCompraIndex = 12; // Ajusta este índice según la posición de la columna "Fecha Compra"
                        const fechaCompra = new Date(data[fechaCompraIndex]); // Convierte la fecha de la tabla a objeto Date

                        // Comprobar si la fecha está dentro del rango
                        if (
                            (minFecha === null || fechaCompra >= minFecha) &&
                            (maxFecha === null || fechaCompra <= maxFecha)
                        ) {
                            return true; // La fila cumple con los criterios
                        }
                        return false; // La fila no cumple con los criterios
                    });

                    // Redibujar la tabla al cambiar las fechas
                    $('#minFechaCompra, #maxFechaCompra').on('change', function() {
                        table.draw(); // Redibujar la tabla para aplicar el filtro
                    });

                });

                // Aquí definimos que la fila clonada (segunda fila con los inputs) no sea ordenable
                $('#example1 thead tr:eq(1) th').removeClass('sorting').off('click');

                // Añadir los botones a DataTables
                table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}

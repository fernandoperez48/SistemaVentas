<?php
require('../fpdf/fpdf.php');
include '../app/config.php';


$id_venta = $_POST['id_venta'];
$id_cliente = $_POST['id_cliente'];

// Consulta para obtener los detalles del cliente
$sql_cliente = "SELECT cli.*, 
                       COALESCE(per.nombre, emp.nombre) AS nombre_cliente, 
                       per.nombre as nombre_per, per.apellido as apellido_per, 
                       per.dni as dni_per, per.telefono as telefono_per, 
                       emp.razon_social as razon_social, emp.cuit as cuit,
                    cond_iva.nombre as nombre_condicion_iva,
                       
                       dom_per.calle as calle_per, dom_per.numero as numero_per, 
                       dom_per.ciudad as ciudad_per, dom_per.provincia as provincia_per,
                       
                       dom_emp.calle as calle_emp, dom_emp.numero as numero_emp, 
                       dom_emp.ciudad as ciudad_emp, dom_emp.provincia as provincia_emp

                 FROM tb_clientes AS cli
                LEFT JOIN tb_personas AS per ON cli.id_persona = per.id_persona
                LEFT JOIN tb_empresas AS emp ON cli.id_empresa = emp.id_empresa
                LEFT JOIN tb_domicilios AS dom_per ON per.id_domicilio = dom_per.id_domicilio
                LEFT JOIN tb_domicilios AS dom_emp ON emp.id_domicilio = dom_emp.id_domicilio
                LEFT JOIN tb_condicion_iva AS cond_iva ON cli.condicion_iva = cond_iva.id
                WHERE cli.id_cliente = '$id_cliente'";

$resultado_cliente = $mysqli->query($sql_cliente);

if (!$resultado_cliente) {
    die("Error en la consulta de cliente: " . $mysqli->error);
}

// Obtener los datos del cliente
$cliente = $resultado_cliente->fetch_assoc();
// Acceder correctamente a los campos
$nombre_cliente = $cliente['nombre_cliente'];
if ($cliente['dni_per']) {
    $domicilio = [
        'calle' => $cliente['calle_per'],
        'numero' => $cliente['numero_per'],
        'ciudad' => $cliente['ciudad_per'],
        'provincia' => $cliente['provincia_per']
    ];
} else {

    // Si no es persona (es empresa), obtenemos el domicilio de la empresa
    $domicilio = [
        'calle' => $cliente['calle_emp'],
        'numero' => $cliente['numero_emp'],
        'ciudad' => $cliente['ciudad_emp'],
        'provincia' => $cliente['provincia_emp']
    ];
}
$condicion_iva = $cliente['nombre_condicion_iva'];
$razon_nombreYapellido = $cliente['razon_social'] ?? ($cliente['nombre_per'] . ' ' . $cliente['apellido_per']); // En caso de que no sea una empresa, usar el nombre del cliente
$cuit_dni = $cliente['cuit'] ?? $cliente['dni_per']; // En caso de que no haya cuit para la empresa, usar el cuit del cliente



// Realiza la consulta para obtener los detalles del carrito y productos
$sql_carrito = "SELECT carr.cantidad, 
            pro.codigo as codigo_producto, 
            pro.unidad_de_medida as unidad_de_medida, 
            pro.nombre AS nombre_producto,
         carr.precio_unitario AS precio_unitario


      FROM 
    tb_carrito AS carr
INNER JOIN 
    tb_almacen AS pro ON carr.id_producto = pro.id_producto
INNER JOIN 
    tb_ventas AS ven ON carr.nro_venta = ven.nro_venta

WHERE 
    carr.nro_venta = '$id_venta'
ORDER BY 
    carr.id_carrito";

$resultado_carrito = $mysqli->query($sql_carrito);



if (!$resultado_carrito) {
    die("Error en la consulta: " . $mysqli->error);
}



// Preparación de datos para el PDF
$productos = [];
$total_cantidad = 0;
$total_precio_unitario = 0;
$total_precio = 0;

while ($carrito = $resultado_carrito->fetch_assoc()) {
    $cantidad = $carrito['cantidad'];
    $precio_unitario = $carrito['precio_unitario'];
    $subtotal = $cantidad * $precio_unitario;
    // Calcula el subtotal con IVA
    $subtotal_con_iva = $subtotal * 1.21;

    $productos[] = [
        'codigo_producto' => $carrito['codigo_producto'],
        'nombre_producto' => $carrito['nombre_producto'],
        'unidad_de_medida' => $carrito['unidad_de_medida'],
        'cantidad' => $cantidad,
        'precio_unitario' => $precio_unitario,
        'subtotal' => $subtotal,
        'subtotal_con_iva' => $subtotal_con_iva
    ];

    $total_cantidad += $cantidad;
    $total_precio_unitario += $precio_unitario;
    $total_precio += $subtotal;
}


class PDF extends FPDF
{
    private $total_subtotales = 0;
    private $importe_total = 0;

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'ORIGINAL', 1, 1, 'C');
        $this->SetFont('Arial', 'B', 16);
        $this->SetXY(97, 20);
        $this->SetFont('Arial', 'B', 22);
        $this->Cell(15, 13, 'A', 'LRU', 1, 'C');
        $this->SetFont('Arial', '', 7);
        $this->SetXY(97, 30);
        $this->Cell(15, 5, 'COD 01', 'LRB', 1, 'C');
    }

    function Footer()
    {
        // Posición: a 1.5 cm del final
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function FacturaDetalle($razon_nombreYapellido, $cuit_dni, $condicion_iva)
    {
        $this->SetY(19);
        $y_position = $this->GetY(); // Obtiene la posición vertical actual (Y) después de la primera MultiCell
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(190, 42, '', 'LR', '1', '');
        $this->SetY(22);
        $this->Cell(95, 10, 'FA INSUMOS', 'L', '0', 'C');
        $this->SetFont('Arial', 'B', 16);

        $this->SetX(118);
        $this->Cell(95, 10, 'FACTURA', 'R', '1', 'L');

        $this->SetFont('Arial', 'B', 9);
        $this->SetY(35);
        $this->Cell(95, 8, 'Razon Social:', 'LR', '0', 'L');
        $this->SetXY(32, 35);
        $this->SetFont('Arial', '', 9);
        $this->Cell(73, 8, 'Alvarez Luis Eduardo', 'R ', '', 'L');
        $this->SetXy(118, 30);

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'Punto de Venta: 00003 Comp. Nro: 0000000', '', '0', 'L');

        $this->SetXY(118, 35);
        $this->Cell(95, 8, 'Fecha de Emision:', '', '0', 'L');
        $this->SetX(147);
        $this->Cell(95, 8, '00/00/0000', '', '1', 'L');

        $this->SetXY(118, 45);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'CUIT:', '', '0', 'L');

        $this->SetX(128);
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 8, '20177685853 ', '', '1', 'L');

        $this->SetXY(118, 49);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'Ingresos Brutos:', '', '1', 'L');

        $this->SetXY(145, 49);
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 8, '05-5103', '', '1', 'L');

        $this->SetXY(118, 53);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'Fecha de Inicio de Actividades:', '', '1', 'L');

        $this->SetXY(167, 53);
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 8, '01-08-2015', '', '1', 'L');


        $this->SetFont('Arial', 'B', 9);
        $this->SetY(40);
        $this->Cell(95, 9, 'asdasdasd', 'LR', '', false);
        $this->SetY(44);
        $this->Cell(95, 8, 'Domicilio Comercial:', 'LR', '', false);

        $this->SetFont('Arial', '', 9);
        $this->SetXY(43, 45);
        $this->Cell(95, 6, 'Pueyrredon Esquina Colon 0 - Puerto', '', '1', false);
        $this->SetX(10,);
        $this->Cell(95, 3, '', 'LR', '0', false);
        $this->SetX(43,);
        $this->Cell(95, 2, 'Deseado, Santa Cruz', '', '1', false);
        $this->SetFont('Arial', 'b', 9);

        $this->Cell(95, 9, 'Condicion frente al IVA:', 'LRB', '', false);
        $this->SetX(47,);
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 9, 'IVA Responsable Inscripto', '', '', false);
        // Establecer la posición X para la segunda MultiCell en la mitad derecha de la página
        $this->SetXY(105, $y_position); // 105mm es el margen izquierdo para la segunda celda, manteniendo la misma posición Y

        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(10, 52);
        $this->Cell(190, 10, '', 'B', '', false);

        $this->SetFont('Arial', 'B', 30);
        $this->SetXY(10, 63);
        $this->Cell(190, 15, '', '1', '1', false);

        $this->SetXY(10, 63);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'CUIT/DNI:', '', '0', 'L');
        $this->SetXy(27, 63);
        $this->SetFont('Arial', '', 9);
        $this->Cell(73, 8, $cuit_dni, '', '', 'L');
        $this->SetXy(60, 63);
        $this->SetFont('Arial', 'b', 9);
        $this->Cell(60, 8, 'Nombre o Razon Social:', '', '0', 'L');
        $this->SetXy(99, 63);
        $this->SetFont('Arial', '', 9);
        $this->Cell(73, 8, $razon_nombreYapellido, '', '', 'L');
        $this->SetXY(10, 69);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(95, 8, 'Condición frente al IVA:', '', '0', 'L');
        $this->SetXY(50, 69);
        $this->SetFont('Arial', '', 9);
        $this->Cell(95, 8, $condicion_iva, '', '0', 'L');
        $this->SetXy(20, 63);
    }

    function TablaProductos($productos)
    {
        // Si llega a este punto, cargamos el PDF con los productos
        if (isset($_POST['id_venta'])) {
            $nro_venta = $_POST['id_venta'];

            $this->SetY(90);
            // Cabecera de la tabla de productos
            // Configura el color de fondo a gris (RGB 200, 200, 200)
            $this->SetFillColor(200, 200, 200);
            $this->SetFont('Arial', '', 7);
            $this->Cell(20, 7, 'Cod. Prod.', 1, '', '', 'true');
            $this->Cell(60, 7, 'Producto/Servicios', 1, '', '', 'true');
            $this->Cell(15, 7, 'Cantidad', 1, '', '', 'true');
            $this->Cell(15, 7, 'U. Medida', 1, '', '', 'true');
            $this->Cell(16, 7, 'Precio Unit.', 1, '', '', 'true');
            $this->Cell(12, 7, '% Bonif', 1, '', '', 'true');
            $this->Cell(18, 7, 'Subtotal', 1, '', '', 'true');
            $this->MultiCell(12, 3.5, 'Alicuota' . "\n" . 'IVA', 1, '', 'true');
            $this->SetXY(178, 90);
            $this->Cell(22, 7, 'Subtotal c/IVA', 1, '', '', 'true');
            $this->Ln();

            // Resetear el acumulador de subtotales
            $this->total_subtotales = 0;
            $this->importe_total = 0;

            // Filas de productos
            $this->SetFont('Arial', '', 9);

            foreach ($productos as $producto) {
                $this->Cell(20, 7, $producto['codigo_producto'], 1);
                $this->Cell(60, 7, $producto['nombre_producto'], 1, '', 'L');
                $this->Cell(15, 7, $producto['cantidad'], 1, '', 'C');
                $this->Cell(15, 7, $producto['unidad_de_medida'], 1, '', 'C');
                $this->Cell(16, 7, '$' . number_format($producto['precio_unitario'], 2), 1, '', 'C');
                $this->Cell(12, 7, '0.00', 1, '', 'C');
                $this->Cell(18, 7, '$' . number_format($producto['subtotal'], 2), 1, '', 'C');
                $this->Cell(12, 7, '21%', 1, '', 'C');
                $this->Cell(22, 7, '$' . number_format($producto['subtotal_con_iva'], 2), 1, '', 'C');
                $this->Ln();

                // Sumar el subtotal de cada producto al total
                $this->total_subtotales += $producto['subtotal'];
                $this->importe_total += $producto['subtotal_con_iva'];
            }
            $this->Ln(10);
        }
    }

    function Totales()
    {
        $this->SetFont('Arial', 'B', 30);
        $this->SetXY(10, 190);
        $this->Cell(190, 45, '', '1', '1', 'C');
        $this->SetFont('Arial', '', 9);
        $this->SetY(190);
        $this->Cell(0, 5, 'Importe Neto Gravado: $ ' . number_format($this->total_subtotales, 2), 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 27%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 27%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 10,5%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 5%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 2,5%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'IVA 0%: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'Importe Otros Tributos: $ 0,00', 0, 1, 'R');
        $this->Cell(0, 5, 'Importe Total: $ ' . number_format($this->importe_total, 2), 0, 1, 'R');

        $this->Ln(10);

        $this->Ln(10);
        // Detalle CAE
        $this->Cell(0, 5, 'CAE N°: 74323870138365', 0, 1, 'R');
        $this->Cell(0, 5, 'Fecha de Vto. de CAE: 19/08/2024', 0, 1, 'R');
    }
}

// Creación del objeto PDF y configuración
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Llamada a las funciones para armar la factura
$pdf->FacturaDetalle($razon_nombreYapellido, $cuit_dni, $condicion_iva);
$pdf->TablaProductos($productos);

$pdf->Totales();

// Generar el archivo PDF
$pdf->Output();

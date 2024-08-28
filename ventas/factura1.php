<?php
require('../fpdf/fpdf.php');
require('../conexion/conexion.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Times', 'B', 20);
        $this->Image('../public/images/logo.jpg', 15, 5, 33);
        $this->setXY(100, 5);
        $this->Cell(10, 20, 'Factura', 1, 0, 'C', 0);
        $this->Ln(60);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$data = new Conexion();
$conexion = $data->conect();

// Asegurarse de recibir la variable nro_venta
$nro_venta = $_GET['nro_venta'];

// Consulta SQL para obtener los productos de la venta
$sql_carrito = "
SELECT 
    carr.*, 
    pro.nombre as nombre_producto, 
    pro.descripcion as descripcion, 
    pro.precio_venta as precio_venta 
FROM 
    tb_carrito as carr 
INNER JOIN 
    tb_almacen as pro ON carr.id_producto = pro.id_producto 
WHERE 
    carr.nro_venta = '$nro_venta' 
ORDER BY 
    carr.id_carrito";

$result = $conexion->prepare($sql_carrito);
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->setX(10);
$pdf->SetFont('Helvetica', 'B', 15);

// Cabecera de la tabla
$pdf->Cell(10, 8, 'N', 1, 0, 'C', 0);
$pdf->Cell(100, 8, 'Producto', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Precio Unitario', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Cantidad', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Subtotal', 1, 0, 'C', 0);

$pdf->SetFillColor(231, 234, 238);
$pdf->SetDrawColor(28, 105, 197);
$pdf->Ln(0.5);

$contador_carrito = 0;
$precio_total = 0;

for ($i = 0; $i < count($data); $i++) {
    $pdf->Ln(7);
    $pdf->SetFont('Courier', '', 10);
    $pdf->Cell(10, 6, $i + 1, 1, 0, 'C', 1);
    $pdf->Cell(100, 6, $data[$i]['nombre_producto'], 1, 0, 'L', 1);
    $pdf->Cell(30, 6, '$' . $data[$i]['precio_venta'], 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $data[$i]['cantidad'], 1, 0, 'C', 1);
    $subtotal = $data[$i]['cantidad'] * $data[$i]['precio_venta'];
    $pdf->Cell(25, 6, '$' . $subtotal, 1, 0, 'C', 1);

    // Sumar al total
    $precio_total += $subtotal;
}

// Mostrar el total de la venta al final de la tabla
$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(170, 8, 'Total Venta', 1, 0, 'R', 1);
$pdf->Cell(25, 8, '$' . $precio_total, 1, 0, 'C', 1);

// Salida del PDF
$pdf->Output();

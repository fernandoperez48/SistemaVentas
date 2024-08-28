<?php
require('../fpdf/fpdf.php');
require('../conexion/conexion.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Times','B',20);
    $this->Image('../public/images/logo.jpg',15,5,33);
    $this->setXY(100,5);
    $this->Cell(10,20,'B',1,0,'C',0);
    $this->Ln(60);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//vamos a crear el array
$data=new Conexion();
$conexion=$data->conect();
$strquery="SELECT
    v.nro_venta,
    p.nombre AS nombre_cliente,
    v.fyh_creacion,
    a.nombre AS nombre_producto,
    c.cantidad,
    a.precio_venta,
    (c.cantidad * a.precio_venta) AS subtotal,
    SUM(c.cantidad * a.precio_venta) OVER (PARTITION BY v.nro_venta) AS total_venta
FROM
    tb_ventas v
INNER JOIN tb_clientes cl ON v.id_cliente = cl.id_cliente
INNER JOIN tb_personas p ON cl.id_persona = p.id_persona
INNER JOIN tb_carrito c ON v.nro_venta = c.nro_venta
INNER JOIN tb_almacen a ON c.id_producto = a.id_producto
WHERE
    v.nro_venta = 2
ORDER BY
    v.nro_venta, a.nombre";
$result= $conexion->prepare($strquery);
$result->execute();
$data = $result->fetchall(PDO::FETCH_ASSOC);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,20);
$pdf->setX(10);
$pdf->SetFont('Helvetica','B',15);
$pdf->Cell(10,8,'N',1,0,'C',0);
$pdf->Cell(100,8,'Producto',1,0,'C',0);
$pdf->Cell(30,8,'Costo',1,0,'C',0);
$pdf->Cell(30,8,'Cantidad',1,0,'C',0);
$pdf->Cell(25,8,'Subtotal',1,0,'C',0);


$pdf->SetFillColor(231, 234, 238);
$pdf->SetDrawColor(28, 105, 197);
$pdf->Ln(0.5);
for($i=0;$i<count($data);$i++){
    $pdf->Ln(7);
    $pdf->SetFont('Courier','',10);
    $pdf->Cell(10,6,$i,1,0,'C',1);
    $pdf->Cell(100,6,$data[$i]['nombre_producto'],1,0,'L',1);
    $pdf->Cell(30,6,'$'.$data[$i]['precio_venta'],1,0,'L',1);
    $pdf->Cell(30,6,$data[$i]['cantidad'],1,0,'C',1);
    $pdf->Cell(25,6,'$'.$data[$i]['subtotal'],1,0,'C',1);
}

$pdf->Output();
?>
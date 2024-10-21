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
        $this->Cell(40, 20, 'Factura X', 1, 0, 'C', 0);
        $this->Ln(30);

        $this->SetFont('Times', '', 15);
        $this->Cell(45, 10, 'San Luis 2025', 0, 0, 'C', 0);
        $this->Ln(5);
        $this->Cell(45, 10, 'Puerto Deseado', 0, 0, 'C', 0);
        $this->Ln(5);
        $this->Cell(45, 10, 'Chubut', 0, 0, 'C', 0);

        /*// Añadir datos del cliente
        $this->SetFont('Helvetica', '', 12);
        $this->Cell(100, 10, 'Nombre del Cliente: ', 0, 1);
        $this->Cell(100, 10, 'CUIT: ' , 0, 1);
        $this->Cell(100, 10, 'Direccion: ' , 0, 1);
        $this->Cell(100, 10, 'Telefono: ' , 0, 1);
        $this->Ln(10);

        // Añadir número de factura
        $this->Cell(100, 10, 'Numero de Factura: ', 0, 1);
        $this->Ln(10);*/
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

$sql_carrito = "
    SELECT
        carr.*,
        pro.nombre AS nombre_producto,
        pro.descripcion AS descripcion_producto,
        pro.precio_venta AS precio_venta,
        ven.fyh_creacion AS fecha_compra,
        cli.cuenta_corriente,
        CASE 
            WHEN cli.id_persona IS NOT NULL THEN CONCAT(per.nombre, ' ', per.apellido)
            ELSE emp.nombre
        END AS nombre_cliente,
        CASE 
            WHEN cli.id_persona IS NOT NULL THEN per.dni
            ELSE emp.cuit
        END AS cuit_cliente,
        CASE 
            WHEN cli.id_persona IS NOT NULL THEN CONCAT(dom_persona.calle, ' ', dom_persona.numero, ' Piso: ', dom_persona.piso, ' Depto: ', dom_persona.depto, ', ', dom_persona.ciudad, ', ', dom_persona.provincia, ', ', dom_persona.pais)
            ELSE CONCAT(dom_empresa.calle, ' ', dom_empresa.numero, ' Piso: ', dom_empresa.piso, ' Depto: ', dom_empresa.depto, ', ', dom_empresa.ciudad, ', ', dom_empresa.provincia, ', ', dom_empresa.pais)
        END AS direccion_cliente,
        CASE 
            WHEN cli.id_persona IS NOT NULL THEN per.telefono
            ELSE emp.telefono
        END AS telefono_cliente
    FROM
        tb_carrito AS carr
    INNER JOIN
        tb_almacen AS pro ON carr.id_producto = pro.id_producto
    INNER JOIN
        tb_ventas AS ven ON carr.nro_venta = ven.nro_venta
    INNER JOIN
        tb_clientes AS cli ON ven.id_cliente = cli.id_cliente
    LEFT JOIN
        tb_personas AS per ON cli.id_persona = per.id_persona
    LEFT JOIN
        tb_empresas AS emp ON cli.id_empresa = emp.id_empresa
    LEFT JOIN
        tb_domicilios AS dom_persona ON per.id_domicilio = dom_persona.id_domicilio
    LEFT JOIN
        tb_domicilios AS dom_empresa ON emp.id_domicilio = dom_empresa.id_domicilio
    WHERE
        carr.nro_venta = '$nro_venta'
    ORDER BY
        carr.id_carrito
";




// Consulta SQL para obtener los productos de la venta
/*$sql_carrito = "
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
    carr.id_carrito";*/


$result = $conexion->prepare($sql_carrito);
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);




// Creación del objeto de la clase heredada
$pdf = new PDF();

// Crear el objeto PDF y asignar los datos del cliente

$pdf->AliasNbPages();
$pdf->nombre_cliente = $data[0]['nombre_cliente'];
$pdf->cuit_cliente = $data[0]['cuit_cliente'];
$pdf->direccion_cliente = $data[0]['direccion_cliente'];
$pdf->telefono_cliente = $data[0]['telefono_cliente'];
$pdf->fecha_compra = $data[0]['fecha_compra'];
$pdf->nro_factura = '0001-00000001';


$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

$pdf->setY(30);
$pdf->setX(70);
$pdf->SetFont('Helvetica', 'B', 11);


// Obtener el último número de factura
$sql = "SELECT ultimo_nro_factura FROM configuracion WHERE id = 1";
$result = $conexion->prepare($sql);
$result->execute();
$row = $result->fetch(PDO::FETCH_ASSOC);
$ultimo_nro_factura = $row['ultimo_nro_factura'];

// Incrementar el número de factura para la nueva venta
$nuevo_nro_factura = $ultimo_nro_factura + 1;

// Actualizar la tabla con el nuevo número de factura
$sql_update = "UPDATE configuracion SET ultimo_nro_factura = :nuevo_nro_factura WHERE id = 1";
$stmt_update = $conexion->prepare($sql_update);
$stmt_update->bindParam(':nuevo_nro_factura', $nuevo_nro_factura, PDO::PARAM_INT);
$stmt_update->execute();

// Usar el nuevo número de factura en el PDF
$pdf->nro_factura = str_pad($nuevo_nro_factura, 8, '0', STR_PAD_LEFT);

// Agregar los datos del cliente en el PDF
$pdf->Cell(130, 8, 'Cliente: ' . $pdf->nombre_cliente, 1, 1);
$pdf->setX(70);
$pdf->Cell(130, 8, 'CUIT: ' . $pdf->cuit_cliente, 1, 1);
$pdf->setX(70);
$pdf->Cell(130, 8, 'Domicilio: ' . $pdf->direccion_cliente, 1, 1);
$pdf->setX(70);
$pdf->Cell(130, 8, 'Telefono: ' . $pdf->telefono_cliente, 1, 1);
$pdf->setX(70);
$pdf->Cell(130, 8, 'Fecha de Compra: ' . $pdf->fecha_compra, 1, 1);
$pdf->setX(70);
$pdf->Cell(130, 8, 'Numero de Factura: ' . $pdf->nro_factura, 1, 1);
$pdf->Ln(10);




// Cabecera de la tabla
$pdf->Cell(10, 8, 'N', 1, 0, 'C', 0);
$pdf->Cell(100, 8, 'Producto', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Prec Unit', 1, 0, 'C', 0);
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

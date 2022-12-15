<?php
require('../fpdf/fpdf.php');
require_once('../vista/controller.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    $this->Cell(45);
    // Título
    $this->Cell(100,10,'Reporte De Activos',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',9);
    $this->Cell(22,10,"Movimiento", 1, 0, 'C',0);
    $this->Cell(50,10,"Nombre", 1, 0, 'C',0);
    $this->Cell(20,10,"Cedula", 1, 0, 'C',0);
    $this->Cell(35,10,"Activo", 1, 0, 'C',0);
    $this->Cell(18,10,"Fecha", 1, 0, 'C',0);
    $this->Cell(0,10,utf8_decode("Descripción"), 1, 1, 'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$sentencia = $db->query("SELECT m.*,a.marca,a.tipo,e.nombre FROM activos a, movimientos m, empleados e 
where m.idactivo = a.idactivo AND m.idempleado = e.idempleado AND e.id_estadoemp = '1' order by idmovimiento");

$pdf = new PDF();
$pdf->SetTitle("Documento De Activos", true);
$pdf->AliasNbPages();
$pdf->AddPage('LANDSCAPE','letter');
$pdf->SetFont('Arial','',8);
while($rows = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(22, 10, $rows['idmovimiento'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $rows['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $rows['idempleado'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $rows['marca']."-".$rows['tipo'], 1, 0, 'C', 0);
    $pdf->Cell(18, 10, $rows['fechaint'], 1, 0, 'C', 0);
    $pdf->Cell(0, 10, utf8_decode($rows['descripcion']), 1, 1, 'C', 0);
}
$pdf->Output();

?>
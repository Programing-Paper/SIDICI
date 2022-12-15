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
    // Título
    $this->Cell(0,10,'Reporte de empleados',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',10);
    $this->Cell(25,10,"Id Usuario", 1, 0, 'C',0);
    $this->Cell(50,10,"Nombre", 1, 0, 'C',0);
    $this->Cell(25,10,"Telefono", 1, 0, 'C',0);
    $this->Cell(50,10,"Cargo", 1, 0, 'C',0);
    $this->Cell(25,10,"Ciudad", 1, 0, 'C',0);
    $this->Cell(15,10,"Estado", 1, 1, 'C',0);
    
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

$sentencia = $db->query("SELECT e.*,c.nomcargo,d.ciudad, emp.nombre as esnombre FROM empleados e, cargo c, ciudad d, estado_empleados emp
WHERE e.id_cargo = c.id_cargo AND e.id_compania = d.id_compania and e.id_estadoemp = emp.id_estadoemp");

$pdf = new PDF();
$pdf->SetTitle("Documento de empleados", true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
while($rows = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(25, 10, utf8_decode($rows['idempleado']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($rows['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(25, 10, utf8_decode($rows['telefono']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($rows['nomcargo']), 1, 0, 'C', 0);
    $pdf->Cell(25, 10, utf8_decode($rows['ciudad']), 1, 0, 'C', 0);
    $pdf->Cell(15, 10, utf8_decode($rows['esnombre']), 1, 1, 'C', 0);
    //$pdf->Cell(25,10,utf8_decode("Dirección: "), 1, 0, 'L',0);
    //$pdf->MultiCell(0, 10, utf8_decode($rows['direccion']),1,'L');
}
$pdf->Output();

?>
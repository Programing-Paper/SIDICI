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
    //$this->Cell(45);
    // Título
    $this->Cell(0,10,'Reporte De Activos',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',9);
    $this->Cell(20,10,"Activo", 1, 0, 'C',0);
    $this->Cell(50,10,"Nombre", 1, 0, 'C',0);
    $this->Cell(30,10,"Id Empleado", 1, 0, 'C',0);
    $this->Cell(30,10,"Estado", 1, 0, 'C',0);
    $this->Cell(50,10,"Serial", 1, 0, 'C',0);
    $this->Cell(20,10,"Sistema O", 1, 0, 'C',0);
    $this->Cell(20,10,"Marca", 1, 0, 'C',0);
    $this->Cell(20,10,"Tipo", 1, 0, 'C',0);
    $this->Cell(20,10,"Fecha", 1, 1, 'C',0);
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

$sentencia = $db->query("SELECT a.*,es.nombre AS estado,e.nombre FROM activos a, estado_activos es,empleados e 
        where a.id_estadoact = es.id_estadoact AND a.idempleado = e.idempleado order by idactivo ");

$pdf = new PDF();
$pdf->SetTitle("Documento De Activos", true);
$pdf->AliasNbPages();
$pdf->AddPage('LANDSCAPE','letter');
$pdf->SetFont('Arial','',8);
while($rows = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20, 10, $rows['idactivo'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $rows['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $rows['idempleado'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $rows['estado'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $rows['serial'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $rows['so'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $rows['marca'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $rows['tipo'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $rows['fecha'], 1, 1, 'C', 0);
    //$pdf->Cell(0, 10, 'Observaciones', 1, 1, 'C', 0);
    //$pdf->MultiCell(0, 10, utf8_decode($rows['observaciones']),1,'L');
}
$pdf->Output();

?>
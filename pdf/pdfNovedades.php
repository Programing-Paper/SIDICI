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
    $this->Cell(0,10,'Reporte De Novedades',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,"Id Novedad", 1, 0, 'C',0);
    $this->Cell(70,10,"Nombre", 1, 0, 'C',0);
    $this->Cell(30,10,"Marca", 1, 0, 'C',0);
    $this->Cell(30,10,"Fecha", 1, 0, 'C',0);
    $this->Cell(30,10,"Estado", 1, 1, 'C',0);
    
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

$sentencia = $db->query("SELECT n.*,e.nombre,a.marca,a.tipo FROM novedades n, empleados e, activos a 
WHERE n.idempleado = e.idempleado AND n.idactivo = a.idactivo order by id_novedad");

$pdf = new PDF();
$pdf->SetTitle("Documento De Novedades", true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
while($rows = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $resuelto = "";
    if($rows['resuelto']== 'SI') { $resuelto = 'Resuelto'; } else { $resuelto = 'Abierto';}
    $pdf->Cell(30, 10, utf8_decode($rows['id_novedad']), 1, 0, 'C', 0);
    $pdf->Cell(70, 10, utf8_decode($rows['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($rows['marca']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($rows['fecha']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($resuelto), 1, 1, 'C', 0);
    //$pdf->Cell(0, 10, utf8_decode('Descripción'), 1, 1, 'C', 0);
    //$pdf->MultiCell(0, 10, utf8_decode($rows['descripcion']),1,'L');
}
$pdf->Output();

?>
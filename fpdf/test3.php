<?
include ("../fpdf/fpdf.php");
$pdf=new fpdf();

$pdf->AddPage();
$pdf->SetFont("Arial","",16);

function print_pdf($pdf) {
		$x=$pdf->GetX();
		$y=$pdf->GetY();
		$pdf->Write(8,"*($x,$y)");
	}
print_pdf($pdf);

$pdf->SetY(30);
print_pdf($pdf);
$pdf->SetX(100);
print_pdf($pdf);

$pdf->SetXY(50,50);
print_pdf($pdf);

$pdf->Output();
?>
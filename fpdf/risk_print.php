<?
include ("../fpdf/fpdf.php");
$pdf=new fpdf();
$pdf->AddPage();
$text="This line using font size: ";
$font_size=16;
$t=$text."$font_size\n";

$pdf->SetFont("Arial","","$font_size");
$pdf->SetTextColor(255,0,0);
$pdf->Write($font_size/2,$t);

$pdf->Output();
?>
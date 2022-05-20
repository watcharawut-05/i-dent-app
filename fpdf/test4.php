<?
include ("../fpdf/fpdf.php");
$pdf=new fpdf();

$pdf->AddPage();
$pdf->SetFont("Arial","",20);

$pdf->Image("../images/logo.png", 80,10);

$pdf->SetDrawColor(255,0,0);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0,255,0);

$pdf->SetY(50);

$pdf->Rect(20,40,160,15,"DF");
$pdf->Text(70,50,"Risk Manegement");

$pdf->SetY(70);

$pdf->SetFontSize(16);
$y=$pdf->GetY();
$pdf->Text(20,$y,"Introduction");
$y=$pdf->GetY()+2;
$pdf->Line(20,$y,180,$y);

$pdf->Output();
?>
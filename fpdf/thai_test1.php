<?
require("../fpdf/ThaiPDF.class.php");
$pdf=new ThaiPDF();
$pdf->AddThaiFont();
$pdf->AddPage();

$pdf->SetFont("cordia","B",18);
$pdf->SetTextColor(0,0,0);
$pdf->Write(15,"��§ҹ��������§ �ç��Һ���ɵ�����ó�\n");

$pdf->Output();
?>
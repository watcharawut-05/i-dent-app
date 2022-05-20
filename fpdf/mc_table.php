<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

    // เพิ่มฟอนต์ภาษาไทยเข้าไป
    function SetThaiFont() {
        $this->AddFont('AngsanaNew','','angsa.php');
        $this->AddFont('AngsanaNew','B','angsab.php');
        $this->AddFont('AngsanaNew','I','angsai.php');
        $this->AddFont('AngsanaNew','IB','angsaz.php');
        $this->AddFont('CordiaNew','','cordia.php');
        $this->AddFont('CordiaNew','B','cordiab.php');
        $this->AddFont('CordiaNew','I','cordiai.php');
        $this->AddFont('CordiaNew','IB','cordiaz.php');
        $this->AddFont('Tahoma','','tahoma.php');
        $this->AddFont('Tahoma','B','tahomab.php');
        $this->AddFont('BrowalliaNew','','browa.php');
        $this->AddFont('BrowalliaNew','B','browab.php');
        $this->AddFont('BrowalliaNew','I','browai.php');
        $this->AddFont('BrowalliaNew','IB','browaz.php');
        $this->AddFont('KoHmu','','kohmu.php');
        $this->AddFont('KoHmu2','','kohmu2.php');
        $this->AddFont('KoHmu3','','kohmu3.php');
        $this->AddFont('MicrosoftSansSerif','','micross.php');
        $this->AddFont('PLE_Cara','','plecara.php');
        $this->AddFont('PLE_Care','','plecare.php');
        $this->AddFont('PLE_Care','B','plecareb.php');
        $this->AddFont('PLE_Joy','','plejoy.php');
        $this->AddFont('PLE_Tom','','pletom.php');
        $this->AddFont('PLE_Tom','B','pletomb.php');
        $this->AddFont('PLE_TomOutline','','pletomo.php');
        $this->AddFont('PLE_TomWide','','pletomw.php');
        $this->AddFont('DilleniaUPC','','dill.php');
        $this->AddFont('DilleniaUPC','B','dillb.php');
        $this->AddFont('DilleniaUPC','I','dilli.php');
        $this->AddFont('DilleniaUPC','IB','dillz.php');
        $this->AddFont('EucrosiaUPC','','eucro.php');
        $this->AddFont('EucrosiaUPC','B','eucrob.php');
        $this->AddFont('EucrosiaUPC','I','eucroi.php');
        $this->AddFont('EucrosiaUPC','IB','eucroz.php');
        $this->AddFont('FreesiaUPC','','free.php');
        $this->AddFont('FreesiaUPC','B','freeb.php');
        $this->AddFont('FreesiaUPC','I','freei.php');
        $this->AddFont('FreesiaUPC','IB','freez.php');
        $this->AddFont('IrisUPC','','iris.php');
        $this->AddFont('IrisUPC','B','irisb.php');
        $this->AddFont('IrisUPC','I','irisi.php');
        $this->AddFont('IrisUPC','IB','irisz.php');
        $this->AddFont('JasmineUPC','','jasm.php');
        $this->AddFont('JasmineUPC','B','jasmb.php');
        $this->AddFont('JasmineUPC','I','jasmi.php');
        $this->AddFont('JasmineUPC','IB','jasmz.php');
        $this->AddFont('KodchiangUPC','','kodc.php');
        $this->AddFont('KodchiangUPC','B','kodc.php');
        $this->AddFont('KodchiangUPC','I','kodci.php');
        $this->AddFont('KodchiangUPC','IB','kodcz.php');
        $this->AddFont('LilyUPC','','lily.php');
        $this->AddFont('LilyUPC','B','lilyb.php');
        $this->AddFont('LilyUPC','I','lilyi.php');
        $this->AddFont('LilyUPC','IB','lilyz.php');
    }

    // หาก encoding ของภาษาไทยเป็น UTF-8 จะต้องเปลี่ยนให้เป็น TIS-620
    function conv($string) {
        return iconv('UTF-8', 'TIS-620', $string);
    }

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
}
?>

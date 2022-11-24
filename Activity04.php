<?php
require "vendor/autoload.php";

$file = 'population.csv';
$handle = fopen($file, 'r');
$row_index = 0; 
$header = [];
$data = [];


while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE)
{
	if ($row_index++ < 1)
	{
		foreach ($row_data as $col)
		{
			array_push($header, $col);
		}
		continue;
	}

	$tmp = [];
	for ($index = 0; $index < count($header); $index++)
	{
		$tmp[$header[$index]] = $row_data[$index];
	}
	array_push($data, $tmp);
}

fclose($handle);

class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 40, 40, 40, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell(35, 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
		
       
        foreach($data as $row) 
        {
           
            $i= array_slice($row, 1, 1, true);
            
            foreach($row as $col)
                $this->Cell(35, 20, $col, 1, 0, 'L', $calign='T');
                $x = $this->GetX();
                $y = $this->GetY();
            //var_dump($col);
			//$this->Cell($w[0], 6, $row[1], 'LR', 0, 'L');

            //var_dump($i);
            foreach ($i as $j)
            $style = array(
                'position' => '',
                'align' => 'C',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => true,
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255),
                'text' => true,
                'font' => 'helvetica',
                'fontsize' => 8,
                'stretchtext' => 4
               
            );
            $qrstyle = array(
                'border' => false,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
            //var_dump($j);
            $this->write1DBarcode($j, 'C39', '', '', 35, 20, 0.4, $style);
            $this->write2DBarcode($j, 'QRCODE,H', $x+42, $y+1, 20, 20, $qrstyle);
           $this->Ln();
        }
        $this->Cell(array_sum($w), 0);
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);




$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('ID', 'Country', 'Population', 'Barcode', 'QR Code');



// data loading
$data = $pdf->LoadData('population.csv');

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('example_011.pdf', 'I');
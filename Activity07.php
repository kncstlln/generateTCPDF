<?php

require "vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kane Castillano');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT,  PDF_MARGIN_RIGHT);


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
$pdf->SetFont('helvetica', 'B', 20);
$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(255, 0, 0));
$style4 = array('L' => 0,
                'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
                'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
                'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 128, 0));

// add a page
$pdf->AddPage();

$pdf->SetLineStyle($style5);
$pdf->StarPolygon(100, 80, 50, 30, 3, 0, 1, 'F', $fill_color = array(25,163,68), $circle_fill_color = array(25,163,68));
$pdf->Text(63, 75, 'Happy holidays to all!!');
$pdf->StarPolygon(100, 110, 7, 12, 5, 45, 0, 'DF', array('all' => $style7), array(220, 220, 200), 'F', array(255, 200, 200));
$pdf->StarPolygon(100, 50, 7, 12, 5, 45, 0, 'DF', array('all' => $style7), array(220, 220, 200), 'F', array(255, 200, 200));

$pdf->RoundedRect(63, 150, 80, 80, 3.50, '1111', 'DF');

$pdf->Text(70, 180, 'Have a blessed life');

// output the HTML content

$pdf->Output('example_012.pdf', 'I');
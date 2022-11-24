<?php

require "vendor/autoload.php";

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kane Castillano');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();

// set default font subsetting mode
$pdf->setFontSubsetting(false);

$pdf->SetFont('helvetica', 'B', 20);

$pdf->Write(0, 'My Favorite Quotes', '', 0, 'C', 1, 0, false, false, 0);

$pdf->Ln(10);

$pdf->SetFont('times', '', 10);

$pdf->MultiCell(80, 0, "The purpose of our lives is to be happy.\n", 1, 'C', 0, 1, 65, '', true, 0);

$pdf->Ln(2);

$pdf->SetFont('courierI', '', 10);

$pdf->MultiCell(80, 0, "You only live once, but if you do it right, once is enough.\n", 1, 'C', 0, 1, 65, '', true, 0);

$pdf->Ln(2);

$pdf->SetFont('cid0jp', '', 9);

$pdf->MultiCell(80, 0, "Sing like no one's listening, love like you've never been hurt, dance like nobody's watching, and live like it's heaven on earth.\n", 1, 'C', 0, 1, 65, '', true, 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_033.pdf', 'I');
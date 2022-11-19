<?php

include "vendor/autoload.php";


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
class MC_TCPDF extends TCPDF {

	
	public function PrintChapter($num, $title, $file, $mode=false) {
		// add a new page
		$this->AddPage();
		// disable existing columns
		$this->resetColumns();
		// print chapter title
		$this->ChapterTitle($num, $title);
		// set columns
		$this->setEqualColumns(3, 57);
		// print chapter body
		$this->ChapterBody($file, $mode);
	}

	/**
	 * Set chapter title
	 * @param $num (int) chapter number
	 * @param $title (string) chapter title
	 * @public
	 */
	public function ChapterTitle($num, $title) {
		$this->SetFont('helvetica', '', 14);
		$this->SetFillColor(200, 220, 255);
		$this->Cell(180, 6, 'Chapter '.$num.' : '.$title, 0, 1, '', 1);
		$this->Ln(4);
	}

	/**
	 * Print chapter body
	 * @param $file (string) name of the file containing the chapter body
	 * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
	 * @public
	 */
	public function ChapterBody($file, $mode=false) {
		$this->selectColumn();
		// get esternal file content
		$content = file_get_contents($file, false);
		// set font
		$this->SetFont('times', '', 9);
		$this->SetTextColor(50, 50, 50);
		// print content
		if ($mode) {
			// ------ HTML MODE ------
			$this->writeHTML($content, true, false, true, false, 'J');
		} else {
			// ------ TEXT MODE ------
			$this->Write(0, $content, '', 0, 'J', true, 0, false, true, 0);
		}
		$this->Ln();
	}
} // end of extended class

// ---------------------------------------------------------
// EXAMPLE
// ---------------------------------------------------------
// create new PDF document


// set document information
$pdf->SetCreator(PDF_CREATOR);

$pdf->SetTitle('Activity 03');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');




// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(false);
$pdf->SetFooterMargin(false);

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

// ---------------------------------------------------------

//Close and output PDF document$pdf = new PDF();
$pdf = new MC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$title = 'Harry Potter and the Sorcerers Stone';
$pdf->SetTitle($title);
$pdf->SetAuthor('J. K. Rowling');
$pdf->PrintChapter(1,'THE BOY WHO LIVED','chap1.txt');
$pdf->PrintChapter(2,'THE VANISHING GLASS','chap2.txt');
$pdf->PrintChapter(3,'THE LETTERS FROM NO ONE','chap3.txt');
$pdf->PrintChapter(4,'THE KEEPER OF THE KEYS','chap4.txt');
$pdf->PrintChapter(5,'DIAGON ALLEY','chap5.txt');
$pdf->SetFillColor(200,162,35);


$pdf->Output('Activity 03.pdf', 'I');
?>

//============================================================+
// END OF FILE
//============================================================+
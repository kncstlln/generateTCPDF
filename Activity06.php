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

// add a page
$pdf->AddPage();


$tbl = <<<EOD
                <table border="1" cellpadding="2" cellspacing="2">

                <tr>
                <th colspan="7">January 2023</th>
                </tr>

                <tr>
                <th>Su</th>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
                </tr>

                <tr>
                <td style="background-color:#BA6006;color:#B10C0C;">1</td>
                <td style="background-color:#BA6006;color:#B10C0C;">2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                </tr>

                <tr>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                </tr>

                <tr>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                </tr>

                <tr>
                <td>22</td>
                <td>23</td>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
                <td>28</td>
                </tr>

                <tr>
                <td>29</td>
                <td>30</td>
                <td>31</td>
                </tr>

                </table>
EOD;


$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('Activity06.pdf', 'I');

?>

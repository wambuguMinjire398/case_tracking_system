<?php
// retrive case number
$caseNumber = $_POST['caseNumber'];

require_once('TCPDF-main/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Load table data based on case number 
    public function LoadData($caseNumber) {
        include 'connect.php';
        $select = "SELECT * FROM new_case WHERE caseNumber = '$caseNumber'";
        $query = mysqli_query($conn, $select);
        return $query;
    }
    

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(178, 132, 190);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 51);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        // to set width of columns and to equal no. of columns
        $w = array(50, 50, 50, 50, 50);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 15, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data from mysql db
        $fill = 0;
        foreach($data as $row) {
            
            $this->Cell($w[0], 25, $row["caseNumber"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 25, $row["caseType"], 'LR', 0, 'L', $fill);
            $this->MultiCell($w[2], 25, $row["citation"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 25, $row["courtType"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 25, $row["created_at"], 'LR', 0, 'L', $fill);

            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 011');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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

// column titles you can set however you like
$header = array('caseNumber', 'Case Type', 'citation', 'court Type', 'Created Date');

// data loading
$data = $pdf->LoadData($caseNumber);


// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('cases Informtion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


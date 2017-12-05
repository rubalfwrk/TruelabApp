<?php
error_reporting( E_ALL ^ E_DEPRECATED );
//http://www.setasign.de/products/pdf-php-solutions/fpdi-protection-128/

function pdfEncrypt ($origFile, $password, $destFile){
	// die('here');
	require_once('fpdi/FPDI_Protection.php');
	$pdf = new FPDI_Protection();

	$pdf->FPDF("P", "in", array('8.27','11.69'));

	$pagecount = $pdf->setSourceFile($origFile);

	for ($loop = 1; $loop <= $pagecount; $loop++) {
   	 	$tplidx = $pdf->importPage($loop);
    	$pdf->addPage();
    	$pdf->useTemplate($tplidx);
	}

	$pdf->SetProtection(array(),$password);
	
	$destFile = "AuditReport.pdf";
	$pdf->Output($destFile,'F');
	echo 'file is password protected now!!';
	return $destFile;
}

	$password = "priyank";
	$origFile = "AuditReport.pdf";
	$destFile = "AuditReport.pdf";
	// die('first');
	pdfEncrypt($origFile, $password, $destFile );
	
?>
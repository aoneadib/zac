<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
		$dompdf = new Dompdf();
		$dompdf->loadHtml('Hello World');

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
?>
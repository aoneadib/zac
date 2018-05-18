<?php 	
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf; 
?>
<?php require_once("data/order_data_access.php"); ?>
<?php
	function getAllOrdersByDate($date)
	{
		return getAllOrdersByDateFromDb($date);
	}
	function getAllOrders()
	{
		return getAllOrdersFromDb();
	}

	function generateReport($reportHTML)
	{
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($reportHTML);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();
	ob_end_clean();
	// Output the generated PDF to Browser
	$dompdf->stream();
	}	
?>
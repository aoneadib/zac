<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	function isValidNumber($entry)
	{
		if(preg_match("/^[0-9]*$/",$entry)){
			return true;
		}
		else return false;
	}
	function isValidReport($entries)
	{
		$isValidReport=true;
		foreach($entries['account'] as $index=>$entry)
		{
			if($entry=='') $isValidReport=false;
			else if($entries['debit'][$index]==''&&$entries['credit'][$index]=='') {$isValidReport=false; break;}
			else if($entries['debit'][$index]!=''&&$entries['credit'][$index]!='') {$isValidReport=false; break;}
			else
			{
				$isValidReport=(isValidNumber($entries['debit'][$index])&&isValidNumber($entries['credit'][$index]));
			}
		}
		if($entries['month']=='') $isValidReport=false;
		if($entries['year']=='') $isValidReport=false;
		return $isValidReport;
	}
	function makeReport($entries)
	{
		$debitEntries= array();
		$creditEntries= array();
		$totalRev=0;
		$totalExp=0;
		foreach($entries['account'] as $index=>$entry)
		{
			if($entries['debit'][$index]!='') {$debitEntries+=[$entry => $entries['debit'][$index]]; $totalExp+=$entries['debit'][$index];}
			else {$creditEntries+=[$entry => $entries['credit'][$index]]; $totalRev+=$entries['credit'][$index];}
		}
		$debitEntriesJSON = json_encode($debitEntries);
		$creditEntriesJSON = json_encode($creditEntries);
		$net=abs($totalRev-$totalExp);
			?>
			<script type="text/javascript">
				var debitEntries = <?php echo $debitEntriesJSON ?>;
				var creditEntries = <?php echo $creditEntriesJSON ?>;
				var reportMonth = "<?php echo $entries['month'] ?>";
				var reportYear = "<?php echo $entries['year'] ?>";
				var totalRev = "<?php echo $totalRev ?>";
				var totalExp = "<?php echo $totalExp ?>";
				var net = "<?php echo $net ?>";
			</script>	
<?php
			
		$table='<link rel="stylesheet" type="text/css" href="design/reportStyle.css"><html><body><table><thead><tr><td class="head" colspan="4">ZAC Clothing Line</td></tr><tr><td class="head" colspan="4">Income Statement</td>';
		$table.='</tr><tr><td class="head" colspan="4">For the month ended, '.$entries['month'].', '.$entries['year'].'</tr><tr class="title"><td>Revenue</td><td></td><td></td><td></td></tr></thead><tbody>';
		foreach($creditEntries as $account=>$amount)
		{
		$table.='<tr><td class="title"></td><td class="account">'.$account.'</td><td class="amount"></td><td class="amount">'.$amount.'</td></tr>';
		}
		$table.='<thead><tr><td class="title">Expenses</td><td></td><td></td><td></td></tr></thead>';
		foreach($debitEntries as $account=>$amount)
		{
		$table.='<tr><td class="title"></td><td class="account">'.$account.'</td><td class="amount">'.$amount.'</td><td class="amount"></td></tr>';
		}
		
		
		$table.='<tr class="title"><td>Total Revenue</td><td></td><td></td><td>'.$totalRev.'</td></tr>';
		$table.='<tr class="title"><td>Total Expense</td><td></td><td></td><td>'.$totalExp.'</td></tr>';
		$table.='<tr class="title"><td></td><td><br/></td><td></td><td></td></tr>';
		$table.='<tr class="title"><td>Net Income/Loss</td><td></td><td></td><td>'.$net.'</td></tr>';
		
		$table.='</tbody></table></body></html>';
		return $table;
		}
?>
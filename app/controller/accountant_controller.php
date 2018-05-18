<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION['user'])==false){
		session_destroy();
		header("location:?guest_home");
	}
	else if($_SESSION['user']['status']=="INVALID")
	{
		session_destroy();
		header("location:?guest_home");
	}
	else if($_SESSION['user']['Type']!="Accountant")
	{
		session_destroy();
		header("location:?guest_home");
	}
?>
	<script>
		var head0Loc="?accountant_home";
		var head0Title="Home";
		var head1Loc="?accountant_account_info";
		var head1Title="Account";
		var head2Loc="?accountant_accounting_Orders";
		var head2Title="Accounting Department";
		var head3Loc="?accountant_logout";
		var head3Title="Log Out";
		var userType = "accountant";
		var suggestionAvail=false;
	</script>
<?php
	require_once("app/view/shared/template.html");
	if($view=="logout")
	{
		session_destroy();
		header("location:?guest_home");
	}
	else if($view=="home")
	{		
		require_once("app/controller/shared/$view"."_controller.php");
	}
	else if($view=="getSuggestions")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/allProduct_controller.php");
		require_once("app/controller/shared/searchProduct_controller.php");
	}		
	else if($view=="search")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
	}
	else if($view=="searchResult")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
		require "app/view/shared/$view"."_view.html";
	}	
	else if($view=="product")
	{
		require_once("app/controller/shared/product_controller.php");
		require_once "app/view/shared/$view"."_view.html";
	}
	else if($view=="accounting")
	{
		$accountingView=$path[2];
?>
		<script>
				var accountingView= "<?=$accountingView?>";
		</script>
<?php
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
		require_once "app/lib/generateReportHelper.php";
		if(isValidReport($_POST))
		{
			$reportHTML=makeReport($_POST);
			require_once "service/accountant_service.php";
			generateReport($reportHTML);
		}
		}
		else if($accountingView=="Orders")
		{
		require_once "service/accountant_service.php";
		$orderArr=getAllOrders();
		$orders=json_encode($orderArr);
		require_once "app/view/$controller/$accountingView"."_view.html";
?>
			<script type="text/javascript">
				var orders = <?php echo $orders ?>;
				document.getElementById("accountView").innerHTML=displayElement();
			</script>	
<?php
		}
		else
		{
		require_once "app/view/$controller/$accountingView"."_view.html";
?>
			<script type="text/javascript">
				document.getElementById("accountView").innerHTML=displayElement();
			</script>	
<?php
		}
	}
	else if($view=="showOrder")
	{
		$date=$path[2].'/'.$path[3];
		require_once "service/accountant_service.php";
		$orderArr=getAllOrdersByDate($date);
		$orders=json_encode($orderArr);
		if($orders) echo "\n\r".$orders;
		else "\n\r"."No result found!";
	}
	else if($view=="account")
	{
		require_once "app/controller/shared/$view"."_controller.php";
	}
?>
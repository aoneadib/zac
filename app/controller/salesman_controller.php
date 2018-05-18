<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION['user'])==false){
		header("location: ?guest_home");
	}
	else if($_SESSION['user']['status']=="INVALID")
	{
		session_destroy();
		header("location: ?guest_home");
	}
	else if($_SESSION['user']['Type']!="Salesman")
	{
		session_destroy();
		header("location: ?guest_home");
	}
?>
	<script>
		var head0Loc="?salesman_home";
		var head0Title="Home";
		var head1Loc="?salesman_account_info";
		var head1Title="Account";
		var head2Loc="?salesman_orders_all";
		var head2Title="Manage Orders";
		var head3Loc="?salesman_logout";
		var head3Title="Log Out";
		var userType = "salesman";
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
	else if($view=="account")
	{
		require_once "app/controller/shared/$view"."_controller.php";
	}	
	else if($view=="orders")
	{
			require_once "service/salesman_service.php";
			if($_SERVER['REQUEST_METHOD']=="POST")
			{
				foreach($_POST as $orderId=>$status)
				{
					if($status=="") ;
					else 
					{
						if(changeOrderStatus($orderId,$status));
						else {echo "Unexpected error occured.";}
					}
				}
			}
			$query=$path[2];
			if($query=="all") {$orderArr=getAllOrders();}
			else {$orderArr=getAllOrdersByStatus($query);}
			if(count($orderArr)!=0){
			$orders=json_encode($orderArr);
			?>
			<script type="text/javascript">
				var orders = <?php echo $orders ?>;
				var view = "<?php echo $query ?>";
				var isOrderEmpty=false;
			</script>	
			<?php
			}
			else
			{ ?>
			<script type="text/javascript">
				var view = "<?php echo $query ?>";
				var isOrderEmpty=true;
			</script>	
	<?php	}
			require_once "app/view/$controller/$view"."_view.html";
	}
	else if($view=="removeOrder")
	{
		$orderId=$path[2];		
		require_once "service/salesman_service.php";
		$result=removeOrderById($orderId);
		echo $orderId;
	}
?>
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
	else if($_SESSION['user']['Type']!="Customer")
	{
		session_destroy();
		header("location: ?guest_home");
	}
?>
	<script>
		var head0Loc="?customer_home";
		var head0Title="Home";
		var head1Loc="?customer_account_info";
		var head1Title="Account";
		var head2Loc="?customer_cart";
		var head2Title="Cart";
		var head3Loc="?customer_logout";
		var head3Title="Log Out";
		var head4Loc="?customer_orders";
		var head4Title="Orders";
		var userType = "customer";
		var userType="customer";
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
	else if($view=="searchResult")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
		require "app/view/shared/$view"."_view.html";
	}
	else if($view=="account")
	{
		require_once "app/controller/shared/$view"."_controller.php";
	}
	else if($view=="orders")
	{
		require_once "service/customer_service.php";
		require_once "app/view/$controller/$view"."_view.html";
		$orderArr=getOrders($_SESSION['user']);
		if(count($orderArr)!=0){
		$orders=json_encode($orderArr);
		?>
		<script type="text/javascript">
			var orders = <?php echo $orders ?>;
			var view = "Orders";
			var isOrderEmpty=false;
			document.getElementById("orderView").innerHTML=displayOrderInfo();
			document.getElementById("view").innerHTML=view;
		</script>	
		<?php
		}
		else
		{ ?>
		<script type="text/javascript">
			var view = "orders";
			var isOrderEmpty=true;
			document.getElementById("orderView").innerHTML=displayOrderInfo();
			document.getElementById("view").innerHTML=view;
		</script>	
	<?php	}
	}
	else if($view=="product")
	{
		require_once("app/controller/shared/product_controller.php");
		require "app/view/shared/$view"."_view.html";
	}
	else if($view=="cart")
	{
		require_once "app/controller/shared/cart_controller.php";
		require_once "app/view/$controller/$view"."_view.html";
	}
	else if($view=="addToCart")
	{
		require_once("app/controller/shared/product_controller.php");
		if(isset($_SESSION['cart'])) 
		{
			$pos=count($_SESSION['cart']);
			$_SESSION['cart'][$pos]=$productArr;		
		}
		else
		{
			$_SESSION['cart'][0]=$productArr;		
		}
	}
	else if($view=="removeFromCart")
	{
		$pos=$path[2];
		unset($_SESSION['cart'][$pos]);
		if(count($_SESSION['cart'])==0) unset($_SESSION['cart']);
		$_SESSION['cart'] = array_values($_SESSION['cart']);
		require_once "app/controller/shared/cart_controller.php";
	}
	else if($view=="checkout")
	{
		$total=0;
		foreach($_SESSION['cart'] as $cartProduct)
		{
			$total+=$cartProduct['price'];
		}?>
		<script>
			var totalPrice= <?=$total?>;
		</script>
<?php
		if($_SERVER['REQUEST_METHOD']!="POST"){
		require_once "app/controller/shared/cart_controller.php";
		require_once "app/view/$controller/$view"."_view.html";
		}
		else
		{
				require_once "app/validator/checkout_validator.php";
				$order=array();
                $order['area'] = trim($_POST['Area']);
                $order['RoadNo'] = trim($_POST['RoadNo']);
                $order['HouseNo'] = trim($_POST['HouseNo']);
                $order['PhoneNo'] = $_POST['PhoneNo'];
                $order['DeliveryType'] = $_POST['DeliveryType'];
				$order['productNames']="";
				$order['productIds']="";
				$order['bill']=$total;
				if(validateOrder($order))
				{
					$order['date']=date("d/m/Y");
					$order['time']=date("h:i:sa");
					$order['Address']=$order['HouseNo'].",".$order['RoadNo'].",".$order['area'];
					require_once "service/customer_service.php";
					for($i=0;$i<count($_SESSION['cart'])-1;$i++)
					{
						$order['productNames'].=$_SESSION['cart'][$i]['name'].",";
						$order['productIds'].=$_SESSION['cart'][$i]['id'].",";
					}
						$order['productNames'].=$_SESSION['cart'][$i]['name'];
						$order['productIds'].=$_SESSION['cart'][$i]['id'];
					if(placeOrder($_SESSION['user'],$order))
					{
						unset($_SESSION['cart']);
						?>
						<script>
							alert("Your order was placed successfully. You will be contacted by our agent in a short time for confirmation.");
						</script>
						<?php
					}
					else
					{
						?>
						<script>
							alert("An unexpected error occured. Sorry for the inconvenience, please try again after a while.");
						</script>
						<?php
					}
				}
		}
	}
?>
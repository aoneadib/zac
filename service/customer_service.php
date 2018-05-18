<?php require_once("data/order_data_access.php"); ?>
<?php
	function placeOrder($customer,$order)
	{
		return placeOrderinDb($customer,$order);
	}
	function getOrders($customer)
	{
		return getOrdersFromDb($customer);
	}
?>
<?php require_once("data/order_data_access.php"); ?>
<?php
	function getAllOrdersByStatus($query)
	{
		return getAllOrdersByStatusFromDb($query);
	}
	function getAllOrders()
	{
		return getAllOrdersFromDb();
	}
	function changeOrderStatus($orderId,$newStatus)
	{
		return changeOrderStatusInDb($orderId,$newStatus);
	}
	function removeOrderById($orderId)
	{
		return removeOrderByIdFromDb($orderId);
	}
?>
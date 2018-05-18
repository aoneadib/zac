<?php require_once "data/order_db_access.php"; ?>
<?php
    function placeOrderinDb($customer,$order){
		$sql = "INSERT INTO orders
				(customer_name, customer_email, customer_phone, 
				customer_address, item_names, item_ids, date, time, delivery_type,bill) 
				VALUES 
				('$customer[name]','$customer[email]','$order[PhoneNo]',
				'$order[Address]','$order[productNames]','$order[productIds]',
				'$order[date]','$order[time]','$order[DeliveryType]',$order[bill])";
        $result = executeSQL($sql);
        return $result;
    }
	function getOrdersFromDb($customer)
	{
		$sql = "SELECT * from orders where customer_email='$customer[email]'";
        $result = executeSQL($sql);
		$orders=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $orders[$i] = $row;
        }
        return $orders;
	}
	function getAllOrdersByStatusFromDb($query)
	{
		$sql = "SELECT * from orders where status='$query'";
        $result = executeSQL($sql);
		$orders=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $orders[$i] = $row;
        }
        return $orders;
	}
	function getAllOrdersFromDb()
	{
		$sql = "SELECT * from orders";
        $result = executeSQL($sql);
		$orders=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $orders[$i] = $row;
        }
        return $orders;
	}
	function changeOrderStatusInDb($orderId,$newStatus)
	{
		$sql = "UPDATE orders SET status='$newStatus' where id=$orderId";
        $result = executeSQL($sql);
        return $result;
	}
	
	function removeOrderByIdFromDb($orderId)
	{
		$sql = "DELETE from orders where id=$orderId";
        $result = executeSQL($sql);
        return $result;	
	}
	function getAllOrdersByDateFromDb($date)
	{
		$sql = "SELECT * from orders where date LIKE '%$date'";
        $result = executeSQL($sql);
		$orders=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $orders[$i] = $row;
        }
        return $orders;
	}	

?>
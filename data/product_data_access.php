<?php require_once "data/product_db_access.php"; ?>
<?php
	function getProductFromDb($productId){
        $sql = "select * from products where id=$productId";
        $result = executeSQL($sql);
        $product = mysqli_fetch_assoc($result);
        return $product;
    }
	
    function getAllProductsFromDb(){
        $sql = "select * from products";
        $result = executeSQL($sql);
		$products=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $products[$i] = $row;
        }
		return $products;
    }
	function removeProductByIdFromDb($productId)
	{
		$sql = "DELETE from products where id=$productId";
        $result = executeSQL($sql);
        return $result;	
	}
	function modifyProductInDb($product,$productId)
	{
		$sql = "UPDATE products SET name='$product[name]',description='$product[description]',type='$product[type]',color='$product[color]',price=$product[price] where id=$productId";
        $result = executeSQL($sql);
        return $result;
	}
	function uploadProductInDb($product)
	{
		$sql = "INSERT into products (name, description, type, color, price)
				VALUES ('$product[name]','$product[description]','$product[type]','$product[color]',$product[price])";
        $result = executeSQL($sql);
		if($result)
		{
			$sql = "SELECT MAX(id) from products";
			$result = executeSQL($sql);
			$newProductId = mysqli_fetch_assoc($result);
			$id = $newProductId['MAX(id)'];
			$imageLocation= "images/Product/".$id."/";
			$sql = "UPDATE products SET imageLocation='$imageLocation' where id=$id";
			$result = executeSQL($sql);
		}
        return $result;
	}
	function getLatestProductId()
	{
		$sql= "SELECT MAX(id) from products";
		$result = executeSQL($sql);
        return mysqli_fetch_assoc($result);
	}
	function getSameTypeProductsFromDb($type)
	{
		if($pos = strpos($type,"'")) $type = substr($type,0,$pos).'\\'.substr($type,$pos);
        $sql = "select * from products where type='$type'";
        $result = executeSQL($sql);
		$products=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $products[$i] = $row;
        }
		shuffle($products);
		return $products;
	}
	function getSameCatagoryProductsFromDb($type)
	{
		$sql = "SELECT * from products where type LIKE '$type%'";
        $result = executeSQL($sql);
		$products=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $products[$i] = $row;
        }
		shuffle($products);
		return $products;
	}	
?>
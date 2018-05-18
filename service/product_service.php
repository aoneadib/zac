<?php require_once "data/product_data_access.php"; ?>
<?php
	function getProduct($productId)
	{
		return getProductFromDb($productId);
	}
	function getAllProducts()
	{
		return getAllProductsFromDb();
	}
	function getSameTypeProducts($type)
	{
		return getSameTypeProductsFromDb($type);
	}
	function getSameCatagoryProducts($type)
	{
		return getSameCatagoryProductsFromDb($type);
	}
?>
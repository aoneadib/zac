<?php require_once("data/product_data_access.php"); ?>
<?php
	function removeProductById($productId)
	{
		if(removeProductByIdFromDb($productId))
		{
			$productDir='images/Product/'.$productId;
			$folderFiles=scandir($productDir);
			for($i=2;$i<count($folderFiles);$i++)
			{
				unlink($productDir."/".$folderFiles[$i]);
			}
			if(rmdir('images/Product/'.$productId)) return true;
			else return false;
		}
		else return false;
	}
	function modifyProduct($product,$productId)
	{
		$productDir='images/Product/'.$productId;
		$folderFiles=scandir($productDir);
		//var_dump($folderFiles);
		//$extension=(pathinfo(basename($product['file']['pic']['name']),PATHINFO_EXTENSION));
		move_uploaded_file($product['file']['pic']['tmp_name'], "images/product/".$productId."/".basename($product['file']['pic']['name']));
		return modifyProductInDb($product,$productId);
	}
	function uploadProduct($product)
	{
		if(uploadProductInDb($product))
		{
			$newProductId = getLatestProductId();
			$newProductId = $newProductId['MAX(id)'];
			$product['imageLocation']='images/Product/'.($newProductId)."/".basename($product['file']['pic']['name']);
			mkdir("images/Product/".$newProductId, 0700);
			move_uploaded_file($product['file']['pic']['tmp_name'], $product['imageLocation']);
			return true;
		}
		else
		{
			return false;
		}
	}
	function uploadPromotionalImage($photo)
	{
		$productDir='images/promotion';
		move_uploaded_file($photo['pic']['tmp_name'], "images/promotion/".basename($photo['pic']['name']));
	}
	function removeImages($deleteImagesLoc)
	{
		$files = explode(",", $deleteImagesLoc);
        if($files[0]!='') $deleteImagesLoc=$files;
		foreach($deleteImagesLoc as $deleteImageDirectory)
		{
			unlink($deleteImageDirectory);
		}
	}
?>
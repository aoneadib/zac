<?php
		require_once("service/product_service.php");
		$productId=$path[2];
		if($productArr=getProduct($productId))
		{
		$productDir=$productArr['imageLocation'];
		$folderFiles=scandir($productDir);
		$j=0;
		for($i=2;$i<count($folderFiles);$i++)
		{
			$productArr['images'][$j]=$productDir.$folderFiles[$i];
			$j++;
		}
		$productJson=json_encode($productArr);
		$sameTypeProducts = getSameTypeProducts($productArr['type']);
		
		if(count($sameTypeProducts)>7) $noOfSimilarProducts=7;
		else $noOfSimilarProducts=count($sameTypeProducts);
		$similarProducts=array();
		for($i=0;$i<$noOfSimilarProducts;$i++)
		{
			$folderFiles=scandir($sameTypeProducts[$i]['imageLocation']);
			$sameTypeProducts[$i]['image'] = $sameTypeProducts[$i]['imageLocation'].$folderFiles[2];
			$similarProducts[$i] = $sameTypeProducts[$i];
		}
		$sameTypeProductsJSON=json_encode($similarProducts);
		?>
		<script type="text/javascript">
			var product = <?php echo $productJson ?>;
			var similarProducts = <?php echo $sameTypeProductsJSON ?>;
		</script>	
		<?php }
		else
		{
			header("location: ?customer_home");
		}
?>
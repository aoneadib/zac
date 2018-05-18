<?php
		require_once("service/product_service.php");
		if($productsArr=getAllProducts())
		{
		$i=0;
		$searchResultArr=array();
		if($searchText!=""){
		$searchText = str_replace("--"," ",$searchText);
		foreach($productsArr as $product)
		{
			if(stristr($product['name'], $searchText))
				{
					$searchResultArr[$i]=$product;
					$folderFiles=scandir($product['imageLocation']);
					$searchResultArr[$i]['image']= $product['imageLocation'].$folderFiles[2];
					$i++;
				}
		}
		}
		if(count($searchResultArr)!=0){
			$productsJson=json_encode($searchResultArr);
		}
		else {
			$productsJson='[{"name":" "}]';
		}
		?>
		<script type="text/javascript">
			var products = <?php echo $productsJson ?>;
		</script>	
<?php
		}
		else
		{
			echo "Something wrong";
		}
?>
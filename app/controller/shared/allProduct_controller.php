<?php
		require_once("service/product_service.php");
		if($productsArr=getAllProducts())
		{
			for($i=0;$i<count($productsArr);$i++)
			{
				$folderFiles=scandir($productsArr[$i]['imageLocation']);
				$productsArr[$i]['image']= $productsArr[$i]['imageLocation'].$folderFiles[2];
			}
			$productsJson=json_encode($productsArr);
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
<?php
		$promotionalImages = array();
		$promotionalImagesFiles=scandir('images/promotion');
		for($i=2;$i<count($promotionalImagesFiles);$i++)
		{
		$promotionalImages[$i] = 'images/promotion/'.$promotionalImagesFiles[$i];
		}
		$promotionalImagesJson=json_encode($promotionalImages);
		?>
		<script>
				var promotionImages = <?php echo $promotionalImagesJson ?>;
		</script>
		<?php
		if(isset($path[2]))
		{
			$searchText = $path[2];
			require_once("service/product_service.php");
			$sameCatagoryProducts = getSameCatagoryProducts($searchText);
			if($sameCatagoryProducts)
			{
				for($i=0;$i<count($sameCatagoryProducts);$i++)
				{
					$folderFiles=scandir($sameCatagoryProducts[$i]['imageLocation']);
					$sameCatagoryProducts[$i]['image']= $sameCatagoryProducts[$i]['imageLocation'].$folderFiles[2];
				}
				$productsJson=json_encode($sameCatagoryProducts);
				?>
				<script type="text/javascript">
					var products = <?php echo $productsJson ?>;
				</script>	
				<?php
			}
			else{
			?>
				<script type="text/javascript">
					var products=[{name: " "}];
			</script>	
				<?php
			}
			require "app/view/shared/$view"."_view.html";
		}
		else{
		require_once("app/controller/shared/allProduct_controller.php");
		require "app/view/shared/$view"."_view.html";
		}
?>
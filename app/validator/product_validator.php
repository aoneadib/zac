<?php require_once "app/lib/productInfoValidator.php"; ?>
<?php
	function validateProduct($product,$view)
	{
		$isValidInfo=true;
		if(!isValidProductName($product['name'])) 
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productNameErrorObj = document.getElementsByName("productNameErrorObj")[0];
				productNameErrorObj.innerHTML="*Please Insert a Valid Name";
			</script>
			<?php
			$isValidInfo=false;
			}
		else if(!isValidProductDescription($product['description']))
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productDescriptionErrorObj = document.getElementsByName("productDescriptionErrorObj")[0];
				productDescriptionErrorObj.innerHTML="*Please provide a proper description.";
			</script>
			<?php
			$isValidInfo=false;
			}
		else if(!isValidProductPrice($product['price']))
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productPriceErrorObj = document.getElementsByName("productPriceErrorObj")[0];
				productPriceErrorObj.innerHTML="*Please Insert a Valid Price";
			</script>
			<?php
			$isValidInfo=false;
			}
		else if(!isValidProductColor($product['color']))
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productColorErrorObj = document.getElementsByName("productColorErrorObj")[0];
				productColorErrorObj.innerHTML="*Please Insert a Valid Color";
			</script>
			<?php
			$isValidInfo=false;
			}
		else if(!isValidProductType($product['type']))
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productTypeErrorObj = document.getElementsByName("productTypeErrorObj")[0];
				productTypeErrorObj.innerHTML="*Please Select a Type";
			</script>
			<?php
			$isValidInfo=false;
			}
		else if(!isValidProductPhoto($product['file'],$view))
			{
			require_once "app/view/marketer/$view"."_view.html";
			?>
			<script>
				var productFileErrorObj = document.getElementsByName("productFileErrorObj")[0];
				productFileErrorObj.innerHTML="*Please Provide a Valid Photo of the Product";
			</script>
			<?php
			$isValidInfo=false;
			}
			?>
			<script>
				productNameObj.value= "<?=$product['name']?>";
				productDescriptionObj.value= "<?=$product['description']?>";
				productPriceObj.innerText= "<?=$product['price']?>";
				productColorObj.value= "<?=$product['color']?>";
			</script>
			<?php
			return $isValidInfo;
	}
?>
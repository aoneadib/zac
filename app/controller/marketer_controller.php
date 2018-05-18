<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_SESSION['user'])==false){
		header("location: ?guest_home");
	}
	else if($_SESSION['user']['status']=="INVALID")
	{
		session_destroy();
		header("location: ?guest_home");
	}
	else if($_SESSION['user']['Type']!="Marketer")
	{
		session_destroy();
		header("location: ?guest_home");
	}
?>
	<script>
		var head0Loc="?marketer_home";
		var head0Title="Home";
		var head1Loc="?marketer_account_info";
		var head1Title="Account";
		var head2Loc="?marketer_manageProducts";
		var head2Title="Manage Products";
		var head3Loc="?marketer_logout";
		var head3Title="Log Out";
		var userType = "marketer";
		var suggestionAvail=false;
	</script>
<?php
	require_once("app/view/shared/template.html");
	if($view=="logout")
	{
		session_destroy();
		header("location:?guest_home");
	}
	else if($view=="home")
	{		
		require_once("app/controller/shared/$view"."_controller.php");
	}
	else if($view=="getSuggestions")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/allProduct_controller.php");
		require_once("app/controller/shared/searchProduct_controller.php");
	}		
	else if($view=="searchResult")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
		require "app/view/shared/$view"."_view.html";
	}	
	else if($view=="search")
	{
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
		echo $productsJson;
	}
	else if($view=="product")
	{
		require_once("app/controller/shared/product_controller.php");
		require_once "app/view/shared/$view"."_view.html";
	}
	else if($view=="manageProducts")
	{
		require_once("app/controller/shared/allProduct_controller.php");
		require "app/view/marketer/$view"."_view.html";
	}
	else if($view=="managePromotionalImage")
	{
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			$product['file']=$_FILES;
			require_once("app/lib/productInfoValidator.php");
			if($_FILES['pic']['size']!=0)
			{
				if(isValidProductPhoto($_FILES,"modifyProduct"))
				{
					require_once "service/marketer_service.php";
					uploadPromotionalImage($_FILES);
				}
			}
			if(isset($_POST["deleteImagesLoc"]))
			{
				require_once "service/marketer_service.php";
				$deleteImagesLoc=$_POST["deleteImagesLoc"];
				if($deleteImagesLoc!='') removeImages($deleteImagesLoc);
			}		
		}
		else
		{
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
		require "app/view/marketer/$view"."_view.html";
		}
	}
	else if($view=="removeProduct")
	{
		$productId=$path[2];		
		require_once "service/marketer_service.php";
		if(removeProductById($productId))
		{
			include_once("app/view/shared/changesConfirmed_view.html");
			?>
			<script>
				var header = document.getElementsByClassName('modal-header')[0];
				header.style.backgroundColor='Green';
				header.innerHTML='<h2>Product removed.</h2>';
				var body = document.getElementsByClassName('modal-body')[0];
				body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
			</script>
			<?php
		}
		else
		{
			include_once("app/view/shared/changesConfirmed_view.html");
			?>
			<script>
				var header = document.getElementsByClassName('modal-header')[0];
				header.style.backgroundColor='Red';
				header.innerHTML='<h2>An unexpected error occured. Please try again later.</h2>';
				var body = document.getElementsByClassName('modal-body')[0];
				body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
			</script>
			<?php
		}
		
	}
	else if($view=="modifyProduct")
	{
		if($_SERVER['REQUEST_METHOD']!="POST")
		{
			require_once("app/controller/shared/product_controller.php");
			require "app/view/marketer/$view"."_view.html";
		}
		else
		{
			require_once("app/controller/shared/product_controller.php");
			$product['name']=$_POST["name"];
			$product['description']=$_POST["description"];
			$product['price']=$_POST["price"];
			$product['type']=$_POST["type"];
			$product['color']=$_POST["color"];
			$product['file']=$_FILES;
			require_once("app/validator/product_validator.php");
			if(validateProduct($product,$view)){
				require_once "service/marketer_service.php";
				if(modifyProduct($product,$productId))
				{
				include_once("app/view/shared/changesConfirmed_view.html");
				if(isset($_POST["deleteImagesLoc"]))
				{
					$deleteImagesLoc=$_POST["deleteImagesLoc"];
					if($deleteImagesLoc!='') removeImages($deleteImagesLoc);
				}
				?>
				<script>
					var header = document.getElementsByClassName('modal-header')[0];
					header.style.backgroundColor='Green';
					header.innerHTML='<h2>Product information has been updated</h2>';
					var body = document.getElementsByClassName('modal-body')[0];
					body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
				</script>
				<?php
				}
				else
				{
				include_once("app/view/shared/changesConfirmed_view.html");
				?>
				<script>
					var header = document.getElementsByClassName('modal-header')[0];
					header.style.backgroundColor='Red';
					header.innerHTML='<h2>An unexpected error occured. Please try again later.</h2>';
					var body = document.getElementsByClassName('modal-body')[0];
					body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
				</script>
				<?php
				}
			}
		}
	}
	else if($view=="uploadProduct")
	{
		if($_SERVER['REQUEST_METHOD']!="POST")
		{
			require "app/view/marketer/$view"."_view.html";
		}
		else
		{
			$product['name']=$_POST["name"];
			$product['description']=$_POST["description"];
			$product['price']=$_POST["price"];
			$product['type']=$_POST["type"];
			$product['color']=$_POST["color"];
			$product['file']=$_FILES;
			require_once("app/validator/product_validator.php");
			if(validateProduct($product,$view)){
				require_once "service/marketer_service.php";
				if(uploadProduct($product))
				{
				include_once("app/view/shared/changesConfirmed_view.html");
				?>
				 <script>
					var header = document.getElementsByClassName('modal-header')[0];
					header.style.backgroundColor='Green';
					header.innerHTML='<h2>Product uploaded</h2>';
					var body = document.getElementsByClassName('modal-body')[0];
					body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
				</script>
				<?php
				}
				else
				{
				include_once("app/view/shared/changesConfirmed_view.html");
				?>
				<script>
					var header = document.getElementsByClassName('modal-header')[0];
					header.style.backgroundColor='Red';
					header.innerHTML='<h2>An unexpected error occured. Please try again later.</h2>';
					var body = document.getElementsByClassName('modal-body')[0];
					body.innerHTML='<p><input type="button" onclick="window.location.href='+"'?marketer_manageProducts'"+';" value="OK"></p>';
				</script>
				<?php
				}
			}
		}
		
	}
	else if($view=="account")
	{
		require_once "app/controller/shared/$view"."_controller.php";
	}
?>
<?php
		if(isset($_SESSION['cart'])) 
		{			
			$productsArr=$_SESSION['cart'];
			for($i=0;$i<count($productsArr);$i++)
			{
				$folderFiles=scandir($productsArr[$i]['imageLocation']);
				$productsArr[$i]['image']= $productsArr[$i]['imageLocation'].$folderFiles[2];
			}
			$productsJson=json_encode($productsArr);
			?>
			<script type="text/javascript">
				var cartEmpty = false;
				var products = <?php echo $productsJson ?>;
			</script>	
			<?php
		}
		else
		{?>
			<script type="text/javascript">
				var cartEmpty = true;
				alert("Your Cart is Empty.");
			</script>
<?php	} ?>
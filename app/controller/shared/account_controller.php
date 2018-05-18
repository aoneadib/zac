<?php
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			 require_once "app/view/shared/$view"."_view.html";
			 require_once("app/validator/editInfo_validator.php");
			 $editPerson = $_POST;
			 $isValid = isValidEdit($editPerson);
			 if($isValid)
			 {
				require_once("service/user_service.php");
				unset($editPerson['confirmPassword']);
				if(isset($editPerson['password'])) $editPerson['password'] = hash("md5",$editPerson['password']);
				foreach($editPerson as $col=>$val){
				if(editUserInfo($col,$val,$_SESSION['user']['id']))
				{
					$_SESSION['user'] = getUserById($_SESSION['user']['id']);
?>
					<script>
						var modal = document.getElementById('myModal');
						var modalHeader = document.getElementsByClassName('modal-header')[0];
						var modalBody = document.getElementsByClassName('modal-body')[0];
						modalHeader.style.backgroundColor="Green";
						modalHeader.innerHTML = "<h2>Your information has been successfully updated.</h2>";
						modalBody.innerHTML = '<input type="button" onclick="closeModal()" value="OK">';
						modal.style.display = "block";
					</script>
<?php
					
				}
				else
				{
?>
					<script>
						var modal = document.getElementById('myModal');
						var modalHeader = document.getElementsByClassName('modal-header')[0];
						var modalBody = document.getElementsByClassName('modal-body')[0];
						modalHeader.innerHTML = "<h2>Unexpected Error Occured! Please try again later.</h2>";
						modalBody.innerHTML = '<input type="button" onclick="closeModal()" value="OK">';
						modal.style.display = "block";
					</script>
<?php
				}
				}
			 }
		}
		else
		{
		require_once "app/view/shared/$view"."_view.html";
		$accountView=$path[2];
		if($accountView=="info")
		{
			$user=json_encode($_SESSION['user']);
?>
			<script type="text/javascript">
				var user = <?php echo $user ?>;
				var view = "info";
				accountTable();
			</script>	
<?php
		}
		}
?>
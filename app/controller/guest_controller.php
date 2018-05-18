<?php
	if(isset($_SESSION['user'])==true){
		session_destroy();
		header("location:?".$_SESSION['user']['type']."_home");
	}
?>
<script>
	var head0Loc="?guest_home";
	var head0Title="Home";
	var head1Loc="?guest_login";
	var head1Title="Log In";
	var head2Loc="?guest_signup";
	var head2Title="Sign Up";
	var head3Loc="";
	var head3Title="";
	var userType="guest";
</script>
<?php    
?>
<?php
	if($view=="home")
	{	
		require_once("app/view/shared/template.html");		
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
		
		require_once("app/view/shared/template.html");	
		$searchText = $path[2];
		require_once("app/controller/shared/searchResult_controller.php");
		require "app/view/shared/$view"."_view.html";
	}
	else if($view=="product")
	{
		require_once("app/view/shared/template.html");	
		require_once("app/controller/shared/product_controller.php");
		require_once "app/view/shared/$view"."_view.html";
	}
	else if($view=='login'){
			require_once "app/view/$controller/$view"."_view.html";
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $person['email'] = trim($_POST['email']);
                $person['password'] = trim($_POST['pass']);
				require_once "app/validator/".$view."_validator.php";
				if(Validate($person))
				{
					header("location: ?".$_SESSION['user']['Type']."_home");
				}
               }
            }
			if(isset($_SESSION['user'])==true){
				if($_SESSION['user']['status']!="INVALID")
				{
						header("location: ?".$_SESSION['user']['Type']."_home");
				}
				else header("location: ?guest_home");
			}	
	else if($view=='signup'){
			require_once "app/view/$controller/$view"."_view.html";
			if($_SERVER['REQUEST_METHOD']=="POST"){
                $person['name'] = trim($_POST['name']);
                $person['email'] = trim($_POST['email']);
                $person['password'] = trim($_POST['password']);
                $person['confirmPassword'] = trim($_POST['confirmPassword']);
                $person['gender'] = trim($_POST['gender']);
                $person['dobDay'] = trim($_POST['dobDay']);
                $person['dobMonth'] = trim($_POST['dobMonth']);
                $person['dobYear'] = trim($_POST['dobYear']);
                $person['type'] = trim($_POST['type']);
                if($person['type']!="Customer") {$person['status']="INVALID";}
				else {$person['status']="VALID";};
				require_once "app/validator/".$view."_validator.php";
				if(ValidateSingup($person))
				{
					$person['password'] = hash("md5",$person['password']);
					if(addUser($person))
					{
					?>
			<script>					
				var modal = document.getElementById('myModal');
				modal.style.display = "block";
				var header = document.getElementsByClassName('modal-header')[0];
				header.style.backgroundColor='Green';
				var body = document.getElementsByClassName('modal-body')[0];
			</script>
					<?php
					}
				}
               }
			}
?>
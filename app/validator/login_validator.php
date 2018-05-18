<?php require_once "app/lib/validationhelper.php"; ?>
<script>
	var emailErrorObj = document.getElementsByClassName("emailError")[0];
	var passErrorObj = document.getElementsByClassName("passError")[0];
</script>
<?php
	function Validate($person)
	{
		if(!isValidEmail($person['email'])) 
			{?>
				<script>emailErrorObj.innerText="Invalid Email";</script><?php
				return false;
			}
		else if(!isValidPassword($person['password']))
			{?>
				<script>passErrorObj.innerText="Invalid Password";</script><?php
				return false;
			}
		else
		{
			require_once("service/guest_service.php");
			$user = getUser($person);
			if($user!=NULL){
			$person['password'] = hash("md5",$person['password']);
			if($user['password']===$person['password'])
			{
				$_SESSION['user']=$user;
				return true;
			}
			else 
				{?>
					<script>passErrorObj.innerText="Password mismatch.";</script><?php
					return false;
				}
			}
			else
			{?>
				<script>emailErrorObj.innerText="No such user found.";</script><?php
				return false;
			}
		}
	}
?>
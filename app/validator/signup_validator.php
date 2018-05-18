<?php require_once "app/lib/validationhelper.php"; ?>
<script>
	var nameErrorObj = document.getElementsByClassName("nameError")[0];
	var confirmPassErrorObj = document.getElementsByClassName("confirmPassError")[0];
	var emailErrorObj = document.getElementsByClassName("emailError")[0];
	var passErrorObj = document.getElementsByClassName("passError")[0];
	var genderErrorObj = document.getElementsByClassName("genderError")[0];
	var dateErrorObj = document.getElementsByClassName("dateError")[0];
	var typeErrorObj = document.getElementsByClassName("typeError")[0];
</script>
<?php
	function ValidateSingup($person)
	{
		if(!isValidEmail($person['email']))
			{?>
				<script>emailErrorObj.innerText="Invalid Email";
				</script><?php
				return false;
			}		
		else if(!isValidName($person['name']))
			{?>
				<script>nameErrorObj.innerText="Invalid Name";</script><?php
				return false;
			}
		else if(!isValidPassword($person['password']))
			{?>
				<script>passErrorObj.innerText="Invalid Password";</script><?php
				return false;
			}		
		else if(!isPasswordConfirm($person['password'],$person['confirmPassword']))
			{?>
				<script>confirmPassErrorObj.innerText="Password is not matching";</script><?php
				return false;
			}
		else if(!isValidGender($person['gender']))
			{?>
				<script>genderErrorObj.innerText="*Selecet a gender.";</script><?php
				return false;
			}
		else if(!isset($person['gender']))
		{
			?>
				<script>genderErrorObj.innerText="*Selecet a gender.";</script><?php
				return false;
		}
		else if(!isValidDate($person['dobDay'],$person['dobMonth'],$person['dobYear']))
			{?>
				<script>dateErrorObj.innerText="Invalid Date";</script><?php
				return false;
			}
		else if(!isValidType($person['type']))
			{?>
				<script>typeErrorObj.innerText="Please select a type of user.";</script><?php
				return false;
			}
		else
		{
			require_once("service/guest_service.php");
			if(isUniqueEmail($person['email'])){
				return true;
			}
			else 
				{?>
					<script>emailErrorObj.innerText="User Already Exists.";</script><?php
					return false;
				}
		}
	}
?>
<?php
	require_once("app/validator/signup_validator.php");
	require_once "app/lib/validationhelper.php"; 
	
	function isValidEdit($person)
	{
		$isValid=true;
		if(isset($person['name'])) $isValid = isValidName($person['name']);
		if(isset($person['email'])) $isValid = isValidEmail($person['email']);
		if(isset($person['password'])) $isValid = isValidPassword($person['password']);
		if(isset($person['gender'])) $isValid = isValidGender($person['gender']);
		if(isset($person['confirmPassword'])) $isValid = isPasswordConfirm($person['password'],$person['confirmPassword']);
		if(isset($person['dobDay'])) $isValid = isValidDate($person['dobDay'],$person['dobMonth'],$person['dobYear']);
		if(isset($person['phoneno'])) $isValid = isValidPhoneNo($person['phoneno']);
		
		if(isset($person['email']))
		{
		$isValid = isValidEmail($person['email']);
		if($isValid)
		{
			require_once("service/guest_service.php");
				if(isUniqueEmail($person['email'])){
						$isValid=true;
					}
					else 
						{?>
							<script>emailErrorObj.innerText="User Already Exists.";</script><?php
						$isValid=false;
						}
		}
		}
		return $isValid;
	}
?>
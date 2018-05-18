<?php
    function isValidEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    function isValidName($personName){
        $parts = explode(" ", $personName);
        $isValid = false;
        if(count($parts)>1){
            if(preg_match("/^[a-zA-Z ]*$/",$personName)){
                $isValid = true;
            }
        }
        return $isValid;
    }
	
	function isValidPassword($password)
	{
		if(strlen($password)<9) return false;
		else return true;
	}
	
	function isPasswordConfirm($password,$confirmPassword)
	{
		if($password===$confirmPassword) return true;
		else return false;
	}
	
	function isValidGender($gender)
	{
		if($gender==NULL) return false;
		else return true;
	}
	function isValidDate($dobDay,$dobMonth,$dobYear)
	{
		if($dobDay==null || $dobMonth==null || $dobYear==null)
		{
			return false;
		}
		else if($dobMonth==2)
		{
			if(($dobYear%4) == 0)
			{
				if($dobDay >29)
				{
					return false;
				}
				else return true;
			}
			else if ($dobDay >28)
				{
					return false;
				}
			else return true;
		}
		else
		{
			return true;
		}
	}
	function isValidType($type)
	{
		if($type==NULL) return false;
		else return true;
	}
	function isValidPhoneNo($phone)
	{
		if($phone!="")
		{
            if(preg_match("/^[0-9+-]*$/",$phone)){
                return true;
            }
			else return false;
		}
		else return false;
	}	
?>

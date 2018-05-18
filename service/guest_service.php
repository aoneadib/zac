<?php require_once "data/user_data_access.php"; ?>
<?php
	function getUser($person)
	{
		return getUserFromDb($person);
	}

	function isUniqueEmail($email)
	{
		return isUniqueUserEmail($email);
	}
	
    function addUser($user){
        return addUserToDb($user);
    }
?>
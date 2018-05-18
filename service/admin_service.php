<?php require_once "data/user_data_access.php"; 

	function getAllUsers()
	{
		return getAllUsersFromDb();
	}
	function changeAccountStatus($accId,$status)
	{
		return changeAccountStatusInDb($accId,$status);
	}
	function getAllUsersByStatus($status)
	{
		return getAllUsersByStatusFromDb($status);
	}		
?>
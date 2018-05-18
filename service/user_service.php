<?php require_once "data/user_data_access.php"; 
	function editUserInfo($col,$val,$id)
	{
		return editUserInfoInDb($col,$val,$id);
	}
	function getUserById($id)
	{
		return getUserFromDbById($id);
	}
?>
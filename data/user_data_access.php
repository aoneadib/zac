<?php require_once "data/user_db_access.php"; ?>
<?php
    function getAllUsersFromDb(){
        $sql = "select * from users";
        $result = executeSQL($sql);
		$person=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $person[$i] = $row;
        }
        return $person;
    }
    function getUserFromDb($user){
        $sql = "select * from users where email='$user[email]'";
        $result = executeSQL($sql);
        $person = mysqli_fetch_assoc($result);
        return $person;
    }
    function getUserFromDbById($id){
        $sql = "select * from users where id=$id";
        $result = executeSQL($sql);
        $person = mysqli_fetch_assoc($result);
        return $person;
    }
    function getAllUserEmailsFromDb(){
        $sql = "select email from users";
        $result = executeSQL($sql);
		$emails=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $emails[$i] = $row['email'];
        }
		return $emails;
    }
	
	function isUniqueUserEmail($userEmail){
        $emails  = getAllUserEmailsFromDb();
        $isUnique = true;
        foreach($emails as $email){
            if($email===$userEmail){
                $isUnique = false;
                break;
            }
        }
        return $isUnique;
    }
    function addUserToDb($user){
		$sql = "INSERT INTO users(name, password, email,gender,dobDay,dobMonth,dobYear,type,status) 
				VALUES('$user[name]','$user[password]','$user[email]','$user[gender]','$user[dobDay]','$user[dobMonth]','$user[dobYear]','$user[type]','$user[status]')";
        $result = executeSQL($sql);
        return $result;
    }
	function editUserInfoInDb($col,$val,$id)
	{
		$sql = "UPDATE users SET $col='$val' where id=$id";
        $result = executeSQL($sql);
        return $result;
	}
	function changeAccountStatusInDb($accId,$status)
	{
		$sql = "UPDATE users SET status='$status' where id=$accId";
        $result = executeSQL($sql);
        return $result;
	}
	function getAllUsersByStatusFromDb($status)
	{
		$sql = "SELECT * from users where status='$status'";
        $result = executeSQL($sql);
		$person=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $person[$i] = $row;
        }
        return $person;
	}
?>
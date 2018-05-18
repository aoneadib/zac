<?php
	define("APP_ROOT", "$_SERVER[HTTP_HOST]/store");
	if(isset(array_keys($_GET)[0])){
		if(session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_SESSION['user'])) 
		{
			$path = array_keys($_GET)[0]; //ex: guest_home
			$path = explode("_", $path);
			$controller=$_SESSION['user']['Type'];
			$view = $path[1];
		}
		else
		{
		$path = array_keys($_GET)[0]; //ex: guest_home
		$path = explode("_", $path);
		$controller = $path[0]; //ex: guest
		$view = $path[1]; //ex: home
		}
	}
	else
	{
		session_start();
		if(isset($_SESSION['user'])) 
		{
			$controller=$_SESSION['user']['Type'];
		}
		else $controller = "guest";
		$view = "home";
	}
	
    require_once "app/controller/$controller"."_controller.php";
?>
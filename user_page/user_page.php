<?php


	if($_SESSION["logged"]==TRUE)
	{
		$user=$_SESSION["username"];
		include "myteam.php";
	}
	else
		Header("Location: http://localhost/project/login/login.html");



?>
<?php
session_start();

	if($_SESSION["logged"]==TRUE)
	{	
		Header("Location: http://localhost/project/user_page/myteam.php");
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
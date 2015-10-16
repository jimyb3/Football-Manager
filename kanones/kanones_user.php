<?php

session_start();

	if($_SESSION["logged"]==TRUE)
	{
		
		include "../user_page/user_page.html";
		include "kanones.html";
	}
	else
		Header("Location: http://localhost/project/login/login.html");
?>
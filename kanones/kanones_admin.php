<?php

session_start();

	if($_SESSION["logged"]==TRUE)
	{
		
		include "../admin_page/admin_page.html";
		include "kanones.html";
	}
	else
		Header("Location: http://localhost/project/login/login.html");
?>
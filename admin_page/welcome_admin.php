<?php
session_start();

if($_SESSION["logged"]==TRUE)
	Header("Location: http://localhost/project/admin_page/admin_page.php");
else
	Header("Location: http://localhost/project/login/login.html");

?>
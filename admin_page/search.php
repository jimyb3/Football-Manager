<?php
session_start();
	if($_SESSION["logged"]==TRUE)
	{
		echo "<html>";
		include "admin_page.html";
		echo "<body>";
		echo "<div class=\"newuser\">"; 
		echo "<form action=\"http://localhost/project/admin_page/search_code.php\" method=\"GET\">";
			echo "���� �� username ��� ������ ��� �������:</br><INPUT type=\"TEXT\" name=\"user_search\"></br>";
			echo "<INPUT type=\"submit\" value=\"���������\">";
		echo "</form>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	}
	
	else
		Header("Location: http://localhost/project/login/login.html");
?>
<?php
session_start();
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		include "admin_page.html";
		echo "<body>";
		echo "<div class=\"newuser\">";
		//��� �� ������� �� username ��� ������ ��� ������� �� ��������� �� ban
		echo "<form action=\"http://localhost/project/admin_page/no_ban_user_code.php\" method=\"GET\">";
			echo "���� �� username ��� ������ ��� ������ �� ����� ���� ��� �����������:</br><INPUT type=\"text\" name=\"no_ban_user\"></br>";
			echo "<INPUT type=\"submit\" value=\"�������\">";
		echo "</form>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
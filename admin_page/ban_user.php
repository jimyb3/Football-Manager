<?php
session_start();
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		include "admin_page.html";
		echo "<body>";
		echo "<div class=\"newuser\">";
		echo "<form action=\"http://localhost/project/admin_page/ban_user_code.php\" method=\"GET\">";//��� ������� �� username ��� ������� �� ������� ban ��� ��� ���� ��� ����, ���� ��������� ���������� ����� ������� �������� �� ���� ����������
			echo "���� �� username ��� ������ ��� ����������:</br><INPUT type=\"text\" name=\"ban_user\">";
			echo "</br>";
			echo "����� �� ���� ��� �����������<br \>(�� ���������� ���������� ����):</br><textarea name=\"text_ban\" rows=5 cols=40></textarea>";
			echo "</br>";
			echo "<INPUT type=\"submit\" value=\"�������\">";
		echo "</form>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
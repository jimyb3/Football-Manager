<?php
if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		echo "<head>";
		include "admin_page.html";
		echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"../file1.css\" />";
		echo "</head>";
			
		echo "<body>";	
			echo "<div class=\"newuser\">";
			echo "<form action=\"http://localhost/project/admin_page/new_player_code.php\" method=\"GET\">";
				echo "�������� ��������� ���� ������<br>";
				echo "�����: <input type=\"TEXT\" size=\"20\" name=\"name\"><br>";
				echo "�������: <input type=\"TEXT\" size=\"20\" name=\"lastname\"><br>";
				echo "��/��� ��������: <input type=\"DATE\" name=\"player_bday\"><br>";
				echo "����: <select name=\"position\"><option value=\"offensive\">����������</option><option value=\"middle\">�����</option><option value=\"defensive\">���������</option><option value=\"goalkeeper\">��������������</option></select></br>";
				echo "��������� ����: <input type=\"NUMBER\" size=\"20\" name=\"money\"><br>";
				echo "����������: <input type=\"TEXT\" name=\"photo\"><br>";
				echo "</br>";
				echo "</br>";
				echo "<input type=\"RESET\" value=\"����������\"> <input type=\"SUBMIT\">";
			echo "</form>";
			echo "</div>";
		echo "</body>";
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
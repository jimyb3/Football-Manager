<?php
if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		
		include "admin_page.html";
		
		echo "<body>";
			echo "<div class=\"newuser\">"; 
			echo "���������� �� �������� ��� ���� ������.";
			echo "<form action=\"http://localhost/project/admin_page/new_user_admin_code.php\" method=\"post\" enctype=\"multipart/form-data\">";
				echo "Username: <input type=\"TEXT\" size=\"20\" name=\"username\"><br>";
				echo "Password: <input type=\"PASSWORD\" size=\"20\" name=\"password\"><br>";
				echo "����������� Password: <input type=\"PASSWORD\" size=\"20\" name=\"repassword\"><br>";
				echo "�����: <input type=\"TEXT\" size=\"20\" name=\"name\"><br>";
				echo "�������: <input type=\"TEXT\" size=\"20\" name=\"lastname\"><br>";
				echo "��/��� ��������: <input type=\"DATE\" name=\"birthday\"><br>";
				echo "E-mail: <input type=\"EMAIL\" name=\"email\"><br>";
				echo "����������� E-mail: <input type=\"EMAIL\" name=\"reemail\"><br>";
				echo "����� ������: <input type=\"TEXT\" name=\"teamname\"><br>";
				echo "������� ������: <input type=\"file\" name=\"teamlogo\" id=\"teamlogo\"><br>";
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

<?php
session_start();

	$no_ban_user=$_GET["no_ban_user"];//������� �� username ��� ������
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);
	$result=mysql_query("SELECT * FROM USERS WHERE USERNAME='$no_ban_user'");//�������� ��� �� �������� ��� ������ �� ���� �� username
	
	$row=mysql_fetch_array($result);
	
	if($row['BAN']=='YES')//�� ���� ban ���� �� ��������� ��� �������� �� ����
	{
		mysql_query("UPDATE USERS SET BAN='NO' WHERE USERNAME='$no_ban_user'");
		mysql_query("UPDATE USERS SET FOR_BAN='' WHERE USERNAME='$no_ban_user'");
		include "admin_page.html";
		echo "<div class=\"newuser\">";
		echo "<p class=\"mhnuma\">� ���� ��� ����������� �����!</p>";
		echo "</div>";
	}
	
	else//������ ������������ ��� ����������� ��� � ������� ��� ���� ban
	{
		include "admin_page.html";
		echo "<div class=\"newuser\">";
		echo "<p class=\"eidopoihsh\">� ���� ��� ����������� ��� ����� ������. � ������� �� username: ".$no_ban_user." ��� ���� �����������!</p>";
		echo "</div>";
	}
	
	mysql_close($con);
?>
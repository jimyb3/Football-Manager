<?php
session_start();

	$name_ban=$_GET["ban_user"];
	$text_ban=$_GET["text_ban"];
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);
	
	$result=mysql_query("SELECT * FROM USERS");
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	
	while($row)
	{
		if($_GET["ban_user"]==$row['USERNAME'])//�� ��� ������ ���� ��������� �� ban ���� ���� ��� ������������ �� ���� ��� ban
		{
			mysql_query("UPDATE USERS SET BAN='YES' WHERE USERNAME='$name_ban'");
			mysql_query("UPDATE USERS SET FOR_BAN='$text_ban' WHERE USERNAME='$name_ban'");
			$found=true;
		}
		
		$row=mysql_fetch_array($result);
	}
	
	if($found)//�� ����� ������������ ��� ��� ����� ����
		{
			include "admin_page.html";
			echo "<div class=\"newuser\">";
			echo "<p class=\"mhnuma\">� ������� �� username: </font>".$name_ban." ������������!</p>";
			echo "</div>";
		}
		
		else//������ ��� ������� � ������� ���� ����.
		{
			include "admin_page.html";
			echo "<div class=\"newuser\">";
			echo "<p class=\"eidopoihsh\">� ����������� ��� �����! ��� ������� ������� �� username: ".$name_ban." !</p>";
			echo "</div>";
		}




?>
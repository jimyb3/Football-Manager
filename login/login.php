<?php


	$con=mysql_connect("localhost","root","");//����������� ���� ���� ���
	
	if(!$con)//�� ��� ����� � ������� �� ���������� ������ ���� ������
	{
		die("Could not connect:".mysql_error());
	}
		
	mysql_select_db("foo_man",$con);	
	
	$result=mysql_query("SELECT * FROM USERS");//���������� ��� �� ��������� ��� �������
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	$ban=false;


	while($row)
	{
		if($_GET["username"]==$row['USERNAME'])	//������� ��� username
		{	
			if($_GET["password"]==$row['PASSWORD'])//������� ��� password
			{	
				if($row['BAN']=='NO')//��������� ��� ban ��� ���������� ������ �������� �� session ��� �� ��� ���������� ��������
				{
					session_start();
					$found=true;
					$_SESSION["logged"]=true;
					$_SESSION["username"]=$_GET["username"];
					$_SESSION["usermoney"]=$row['MONEY'];
					Header("Location: http://localhost/project/user_page/welcome_user.php");
				}
				
				else if($row['BAN']=='YES')//���� ���� ban �� ���������� ���� ������ �� ��� ���� ��� ban
				{
					$found=true;
					
					echo "<p class=\"eidopoihsh\">��� ���� ����� BAN, ��� ��� ���� ����:  </p><br />";
					echo "<p class=\"eidopoihsh\">".$row['FOR_BAN']."</p>";
					include "login.html";
					
				}	
			}
		}
		$row=mysql_fetch_array($result);
	}


	//������� �������� ��� ADMIN
	$result=mysql_query("SELECT * FROM ADMIN");
	
	$row=mysql_fetch_array($result);
	
	while($row)
	{
		if($_GET["username"]==$row['USERNAME'])	
		{	
			if($_GET["password"]==$row['PASSWORD'])
			{
				session_start();
				$found=true;
				$_SESSION["logged"]=true;
				Header("Location: http://localhost/project/admin_page/welcome_admin.php");
			}
		}
		$row=mysql_fetch_array($result);
	}
	
	mysql_close($con);
	
	
	
	
	if(!$found)//�� ��������� ��� ������� ���� �� ������� ��� ������ ����� login
	{
		session_start();
		$_SESSION["logged"]=false;
		Header("Location: http://localhost/project/login/login.html");
	}
	
	


?>
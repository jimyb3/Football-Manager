<?php
if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}

	$username=$_POST["username"];
	$password=$_POST["password"];
	$name=$_POST["name"];
	$lastname=$_POST["lastname"];
	$birthday=$_POST["birthday"];
	$email=$_POST["email"];
	$teamname=$_POST["teamname"];
	$teamlogo=$_FILES["teamlogo"]["name"];
	
	$default=false;
	$found_logo=false;
	$found_username=true;
	$found_email=true;
	$found_reemail=true;
	$found_password=true;	
	$found_team=true;
	$found_kenousername=true;
	$found_kenopass=true;
	$found_kenoemail=true;
	$found_kenoteam=true;
	
	
	if($teamlogo=="")
	{
		$teamlogo="default_team_logo.png";
		$default=true;
		$found_logo=true;	
	}
	
	
	
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
	{
		die("Could not connect:".mysql_error());
	}
	
	mysql_select_db("foo_man",$con);	
	
	$result=mysql_query("SELECT * FROM USERS");
	
	$row=mysql_fetch_array($result);
	
	while($row)
	{
		if($username==$row['USERNAME'])
		{
			$found_username=false;
		}
			
		if($email==$row['EMAIL'])
		{
			$found_email=false;
		}
				
		$row=mysql_fetch_array($result);
	}
	
	
	if($username=="")
	{
		$found_kenousername=false;
	}
	
	if($password=="")
	{
		$found_kenopass=false;
	}
	
	if($email=="")
	{
		$found_kenoemail=false;
	}
	
	if($teamname=="")
	{
		$found_kenoteam=false;
	}
	
	if($email!=$_POST["reemail"])	
	{
		$found_reemail=false;	
	}	
		
	if($password!=$_POST["repassword"])	
	{
		$found_password=false;	
	}	
	
	$result=mysql_query("SELECT * FROM TEAMS");
	
	$row=mysql_fetch_array($result);
	
	while($row)
	{
		if($teamname==$row['NAME_TEAM'])
		{
			$found_team=false;
		}
		
		$row=mysql_fetch_array($result);
	}	
		
	if($default==false)	
	{
		$allowedExts=array("jpg","jpeg","gif","png");//�� ���������� ��� ������� �� ����� �� �������
		$extension=explode(".",$teamlogo);//������������ �� ����� ���� �� ������� ��� ��������
		$extension=end($extension);//���� ������ ������� ��� �������� ��� �������
		
		
		if((($_FILES["teamlogo"]["type"]=="image/jpg") || ($_FILES["teamlogo"]["type"]=="image/jpeg") || ($_FILES["teamlogo"]["type"]=="image/gif") || ($_FILES["teamlogo"]["type"]=="image/png")) && ($_FILES["teamlogo"]["size"]<22500) && in_array($extension,$allowedExts))//�� �� in_array ��������� �� � �������� ��� ������ ���� ��� extension ��������� ��� ������ �� ��� ������������� ���������� ��� ������ ������.
		{
			$found_logo=true;		
		}
	}
	
	
	
	
	
	if($found_logo && $found_username && $found_email && $found_kenoemail && $found_kenoteam && $found_reemail && $found_password && $found_team && $found_kenousername && $found_kenopass)
	{
		
		//���������� ���� ������ USERS �� �������� ��� ���� ������.
		mysql_query("INSERT INTO USERS(NAME,LASTNAME,BAN,USERNAME,PASSWORD,MONEY,EMAIL,HM_GEN) VALUES('$name','$lastname','NO','$username','$password','10000','$email','$birthday')");
		
		
		//���������� ���� ������ TEAMS �� �������� ��� ������ ��� ���� ������.
		if($default==false)
		{
			move_uploaded_file($_FILES["teamlogo"]["tmp_name"],"../images/".$teamname.".png");//�������� ��� ������� �� �� tmp ����� ��� ���� ��� �������.
			mysql_query("INSERT INTO TEAMS(NAME_TEAM,TEAM_LOGO,USERNAME) VALUES('$teamname','http://localhost/project/images/$teamname.png','$username')");
		}
		else
			mysql_query("INSERT INTO TEAMS(NAME_TEAM,TEAM_LOGO,USERNAME) VALUES('$teamname','http://localhost/project/images/$teamlogo','$username')");
		
			
			
			//�� ���� �� ������ �� ��������� �� ����� 11 ������� ���� ��� ������ ���� ����� ���. �� ���� �������� ���� ��� ���� �����������.	
			
			
			//��������� ���� ���� ������ PLAYERS, ��� �������������� ��� ��� ����� �� ����� ��� ���������� ���� ����� ��� ���� ������.(1 ����)
			$result=mysql_query("SELECT * FROM PLAYERS");
			$money=0;
			$row=mysql_fetch_array($result);
			$i=0;
			while($row && $i<1)
			{
				if($row['POSITION']=='goalkeeper' && $row['NAME_TEAM']=='')
				{
					$player=$row['PLAYER_ID'];
					mysql_query("UPDATE PLAYERS SET NAME_TEAM='$teamname' WHERE PLAYER_ID='$player'");
					$money=$money+$row['MONEY'];
					$i=$i+1;
				}
				
				$row=mysql_fetch_array($result);
				
			}
	
	
			//��������� ���� ���� ������ PLAYERS, ��� ���������� ��� ��� ����� �� ����� ��� ���������� ���� ����� ��� ���� ������.(4 �����)
			$result=mysql_query("SELECT * FROM PLAYERS");
	
			$row=mysql_fetch_array($result);
			$i=0;
			while($row && $i<=3)
			{
				if($row['POSITION']=='defensive' && $row['NAME_TEAM']=='')
				{
					$player=$row['PLAYER_ID'];
					mysql_query("UPDATE PLAYERS SET NAME_TEAM='$teamname' WHERE PLAYER_ID='$player'");
					$money=$money+$row['MONEY'];
					$i=$i+1;
				}
				
				$row=mysql_fetch_array($result);
				
			}
			
		
			//��������� ���� ���� ������ PLAYERS, ��� ������ ��� ��� ����� �� ����� ��� ���������� ���� ����� ��� ���� ������.(4 �����)
			$result=mysql_query("SELECT * FROM PLAYERS");
	
			$row=mysql_fetch_array($result);
			$i=0;
			while($row && $i<=3)
			{
				if($row['POSITION']=='middle' && $row['NAME_TEAM']=='')
				{
					$player=$row['PLAYER_ID'];
					mysql_query("UPDATE PLAYERS SET NAME_TEAM='$teamname' WHERE PLAYER_ID='$player'");
					$money=$money+$row['MONEY'];
					$i=$i+1;
				}
				
				$row=mysql_fetch_array($result);
				
			}
			
		
		
			//��������� ���� ���� ������ PLAYERS, ��� ����������� ��� ��� ����� �� ����� ��� ���������� ���� ����� ��� ���� ������.(2 �����)
			$result=mysql_query("SELECT * FROM PLAYERS");
	
			$row=mysql_fetch_array($result);
			$i=0;
			while($row && $i<2)
			{
				if($row['POSITION']=='offensive' && $row['NAME_TEAM']=='')
				{
					$player=$row['PLAYER_ID'];
					mysql_query("UPDATE PLAYERS SET NAME_TEAM='$teamname' WHERE PLAYER_ID='$player'");
					$money=$money+$row['MONEY'];
					$i=$i+1;
				}
				
				$row=mysql_fetch_array($result);
				
			}
			
			
		mysql_query("UPDATE TEAMS SET MONEY='$money' WHERE NAME_TEAM='$teamname'");
			
		mysql_close($con);
		include "admin_page.html";
		echo "<p class=\"mhnuma\">������������� ���� ������� �� username: ".$username."</p>";
		
	}
	
	else
	{
		include "new_user_admin.php";	
		echo "<html>";
			echo "<head>";
				echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"../file1.css\" />";
			echo "</head>";
			
			echo "<body>";
			echo "<div class=\"login\">";
		
			if($found_kenousername==false)
			{
				
				echo "<p class=\"eidopoihsh\">������ �� ������ USERNAME.</p><br />";
								
			}
			
			if($found_kenopass==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ PASSWORD.</p><br />";	
			}
			
			if($found_kenoemail==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ EMAIL.</p><br />";	
			}
			
			if($found_kenoteam==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ ����� ������.</p><br />";	
			}
			
			if($found_username==false && $found_kenousername==true)
			{
				echo "<p class=\"eidopoihsh\">� ������� �������, ���� ���� USERNAME.</p><br />";
			}
			
			if($found_email==false && $found_kenoemail==true)
			{
				echo "<p class=\"eidopoihsh\">�� email �������, ���� ���� email.</p><br />";
			}
			
			if($found_reemail==false)
			{
				echo "<p class=\"eidopoihsh\">�� email ��� ����� ���� ��� ��� �����.</p><br />";
			}
			
			if($found_password==false  && $found_kenopass==true)
			{
				echo "<p class=\"eidopoihsh\">� ������� ��� ����� ����� ��� ��� �����.</p><br />";
			}
			
			if($found_team==false && $found_kenoteam==true)
			{
				echo "<p class=\"eidopoihsh\">� ����� �������, ���� ���� ����� ������.</p><br />";
			}
			
			if($found_logo==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ ���� ������.</p><br />";
				echo "<p class=\"eidopoihsh\">- �� ������� ��� ������ �� ����� ���������� ��� 22Kb.</p><br />";
				echo "<p class=\"eidopoihsh\">- �� ����� ������� ��� ������������ ����� �� ����: jpg, jpeg, gif, png.</p><br />";
			}
			
			
				
			echo "</div>";
			echo "</body>";
		
		echo "</html>";	
	}

?>
<?php
session_start();

	$name=$_GET["name"];
	$lastname=$_GET["lastname"];
	$playerage=$_GET["player_bday"];
	$money=$_GET["money"];
	$position=$_GET["position"];
	
	if($_GET["photo"]=="")//�� ��������� ��� � ������������ ��� ���� ������ �� ������� ���� �� �������������� � default
	{
		$photo="http://localhost/project/images/default_player_photo.png";	
	}
	else
		$photo=$_GET["photo"];
	
	$found_keno_name=true;
	$found_keno_lastname=true;
	$found_keno_money=true;
	$found_neg_money=true;
	
	
	if($name=="")
	{
		$found_keno_name=false;
	}
	
	if($lastname=="")
	{
		$found_keno_lastname=false;
	}
	
	if($money=="")
	{
		$found_keno_money=false;	
	}
	
	else if($money<0)
	{
		$found_neg_money=false;	
	}
	
	
	
	
	if($found_keno_name && $found_keno_lastname && $found_keno_money && $found_neg_money)
	{
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die("Could not connect:".mysql_error());
		}
		
		mysql_select_db("foo_man",$con);	
		//������� �������� ��� ���������
		mysql_query("INSERT INTO PLAYERS(NAME,LASTNAME,P_BIRTHDATE,POSITION,MONEY,GOAL,SELF_GOAL,REPULSE,FAULT,INGAME,PHOTO) VALUES('$name','$lastname','$playerage','$position','$money','0','0','0','0','0','$photo')");
		
		include "new_player.php";
		echo "<center>� ���� ������� ����������!</center>";
		
		mysql_close($con);
	}
	
	else
		include "new_player.php";
		echo "<html>";
			echo "<head>";
				echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"../file1.css\" />";
			echo "</head>";
			
			echo "<body>";
			echo "<div class=\"login\">";
		
			if($found_keno_name==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ ����� ������.</p><br />";	
			}
			
			if($found_keno_lastname==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ ������� ������.</p><br />";	
			}
		
			if($found_keno_money==false)
			{
				echo "<p class=\"eidopoihsh\">������ �� ������ ������ ��������� ����.</p><br />";
			}
			
			if($found_neg_money==false)
			{
				echo "<p class=\"eidopoihsh\">� ��������� ���� ������ �� ����� ������!</p><br />";
			}
			
			echo "</div>";
			echo "</body>";
		
		echo "</html>";	

?>
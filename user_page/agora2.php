<?php
 
session_start(); 
  
	if($_SESSION["logged"]==TRUE)
	{
		$money=$_SESSION["usermoney"];
		$user=$_SESSION["username"];
		$sell_player_money=$_SESSION['sell_player_money'];
		$sell_player_id=$_SESSION['sell_player_id'];
		$omada=$_SESSION['omada'];
		$buy_player_money=$_SESSION['buy_player_money'];
		$buy_player_id=$_SESSION['buy_player_id'];
		
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die("<p class=\"eidopoihsh\" >Could not connect:</p>".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);
		
		mysql_query("UPDATE PLAYERS SET NAME_TEAM='' WHERE PLAYER_ID='$sell_player_id'");
		
		mysql_query("UPDATE PLAYERS SET NAME_TEAM='$omada' WHERE PLAYER_ID='$buy_player_id'");
		
		$money=$money+$sell_player_money-$buy_player_money;
		
		mysql_query("UPDATE USERS SET MONEY='$money' WHERE USERNAME='$user'");
		
		$_SESSION["usermoney"]=$money;
		
		
		$result=mysql_query("SELECT * FROM PLAYERS WHERE NAME_TEAM='$omada'");
		
		$row=mysql_fetch_array($result);
		
		
		$money_team=0;
		$record=0;
		while($row)
		{
			$money_player[$record]=$row['MONEY'];
			$money_team=$money_team+$money_player[$record];
			$record++;	
			
			$row=mysql_fetch_array($result);
			
		}
		
		mysql_query("UPDATE TEAMS SET MONEY='$money_team' WHERE NAME_TEAM='$omada'");
		
		
		mysql_close($con);
		
		include "agora.php";
		echo "<div class=\"newuser\">";
		echo "<p class=\"mhnuma\">Η διαδικασία της αγοραπωλησίας ολoκληρώθηκε!</p>";
		echo "</div>";
		
		
	}
	else
		Header("Location: http://localhost/project/login/login.html");



?>
<?php
session_start();

	if($_SESSION["logged"]==TRUE)
	{
		$money=$_SESSION["usermoney"];
		if($_GET["sell_player"] || $_GET["buy_player"])
		{
			$sell_player=explode(".",$_GET["sell_player"]);
			$buy_player=explode(".",$_GET["buy_player"]);
		
		
			$_SESSION['sell_player_money']=$sell_player[2];
			$_SESSION['sell_player_id']=$sell_player[4];
			
			$_SESSION['buy_player_money']=$buy_player[2];
			$_SESSION['buy_player_id']=$buy_player[4];
		
		
		
			if($sell_player[3]==$buy_player[3])
			{
				if($money+$sell_player[2]>=$buy_player[2])
				{
					include "comit.php";
				}
				
				else
				{	
					include "agora.php";
					echo "<div class=\"newuser\">";
					echo "<p class=\"eidopoihsh\">Δεν έχεις αρκετά χρήματα για αυτή την αγοραπωλησία!</p>";	
					echo "</div>";	
				}
			}
				
			else
			{
				include "agora.php";
				echo "<div class=\"newuser\">";
				echo "<p class=\"eidopoihsh\">Πρέπει οι παίκτες της αγοραπωλησίας να έχουν την ίδια θέση!</p>";
				echo "</div>";
						
			}
		}
		else
		{
			include "agora.php";
			echo "<div class=\"newuser\">";
			echo "<p class=\"eidopoihsh\">Πρέπει να επιλέξεις παίχτη προς πώληση ΚΑΙ παίχτη προς αγορά!</p>";
			echo "</div>";	
			
			
		}
				
	}

	else
		Header("Location: http://localhost/project/user_page/login.html");



?>
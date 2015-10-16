<?php

	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}  
	
	if($_SESSION["logged"]==TRUE)
	{
		echo "<html>";
		echo "<head>";
		echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"file1.css\" />";
		echo "</head>";
		include "user_page.html";
		echo "<div class=\"myteam\">";
		echo "ΔΙΑΘΕΣΙΜΟ ΠΟΣΟ:".$_SESSION["usermoney"]." &#8364<br />";
		echo "</div>";
		$money=$money+$sell_player[2]-$buy_player[2];
		
		
		echo "<div class=\"newuser\">"; 
		echo "<p class=\"mhnuma\">Θα πουλήσεις τον παίκτη \"".$sell_player[0]." ".$sell_player[1]."\" με αξία ".$sell_player[2]." &#8364 και θα αγοράσεις τον \"".$buy_player[0]." ".$buy_player[1]."\" με αξία ".$buy_player[2]." &#8364, θα σου μείνουν ".$money." &#8364. Θέλεις να γίνει αυτή η συναλλαγή;</p>";
		echo "<br />";
		
		echo "<form action=\"http://localhost/project/user_page/agora2.php\">";
			echo "<input type=\"submit\" value=\"Nαι\">";
			echo "</form>";
			
		
		echo "<form action=\"http://localhost/project/user_page/agora.php\">";
			echo "<input type=\"submit\" value=\"Όχι\">";
		echo "</form>";
		echo "</div>"; 
	}
	
	else
		Header("Location: http://localhost/project/login/login.html");



?>
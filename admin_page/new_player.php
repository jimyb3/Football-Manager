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
				echo "Εισαγωγή στοιχείων νέου παίκτη<br>";
				echo "Όνομα: <input type=\"TEXT\" size=\"20\" name=\"name\"><br>";
				echo "Επίθετο: <input type=\"TEXT\" size=\"20\" name=\"lastname\"><br>";
				echo "Ημ/νια γέννησης: <input type=\"DATE\" name=\"player_bday\"><br>";
				echo "Θέση: <select name=\"position\"><option value=\"offensive\">Επιθετικός</option><option value=\"middle\">Μέσος</option><option value=\"defensive\">Αμυντικός</option><option value=\"goalkeeper\">Τερματοφύλακας</option></select></br>";
				echo "Χρηματική αξία: <input type=\"NUMBER\" size=\"20\" name=\"money\"><br>";
				echo "Φωτογραφία: <input type=\"TEXT\" name=\"photo\"><br>";
				echo "</br>";
				echo "</br>";
				echo "<input type=\"RESET\" value=\"Καθαρισμός\"> <input type=\"SUBMIT\">";
			echo "</form>";
			echo "</div>";
		echo "</body>";
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
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
			echo "Συμπλήρωσε τα στοιχεία του νέου Διαχειριστή:";
			echo "<form action=\"new_admin_code.php\" method=\"GET\">";
				echo "Username: <input type=\"TEXT\" size=\"20\" name=\"username\"><br>";
				echo "Password: <input type=\"PASSWORD\" size=\"20\" name=\"password\"><br>";
				echo "Επιβεβαίωση Password: <input type=\"PASSWORD\" size=\"20\" name=\"repassword\"><br>";
				echo "<input type=\"RESET\" value=\"Καθαρισμός\"> <input type=\"SUBMIT\">";
			echo "</form>";
			
		/*$time=explode(' ',microtime());
		
		$time[0]=$time[0]*1000000;
		
		echo $time[0]."</br>";
		echo $time[1];	*/
		echo "</div>";	
		echo "</body>";
		echo "</html>";
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
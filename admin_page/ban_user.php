<?php
session_start();
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		include "admin_page.html";
		echo "<body>";
		echo "<div class=\"newuser\">";
		echo "<form action=\"http://localhost/project/admin_page/ban_user_code.php\" method=\"GET\">";//εδω δινουμε το username που θελουμε να δωσουμε ban και απο κατν τον λογο, μονο λατινικοι χαρακτηρες καθως υπαρχει προβλημα με τους ελληνικους
			echo "Δώσε το username του χρήστη για αποκλεισμό:</br><INPUT type=\"text\" name=\"ban_user\">";
			echo "</br>";
			echo "Γράψε το λόγο του αποκλεισμού<br \>(με λατινικούς χαρακτήρες μόνο):</br><textarea name=\"text_ban\" rows=5 cols=40></textarea>";
			echo "</br>";
			echo "<INPUT type=\"submit\" value=\"Εντάξει\">";
		echo "</form>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
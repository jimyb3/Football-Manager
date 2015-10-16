<?php
session_start();
	if($_SESSION["logged"]==TRUE)
	{
	
		echo "<html>";
		include "admin_page.html";
		echo "<body>";
		echo "<div class=\"newuser\">";
		//εδώ θα δωσουμε το username του χτηστη που θελουμε να αποσυρθει το ban
		echo "<form action=\"http://localhost/project/admin_page/no_ban_user_code.php\" method=\"GET\">";
			echo "Δώσε το username του χρήστη που θέλεις να γίνει άρση του αποκελισμού:</br><INPUT type=\"text\" name=\"no_ban_user\"></br>";
			echo "<INPUT type=\"submit\" value=\"Εντάξει\">";
		echo "</form>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
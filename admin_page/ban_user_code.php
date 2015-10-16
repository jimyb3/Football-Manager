<?php
session_start();

	$name_ban=$_GET["ban_user"];
	$text_ban=$_GET["text_ban"];
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);
	
	$result=mysql_query("SELECT * FROM USERS");
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	
	while($row)
	{
		if($_GET["ban_user"]==$row['USERNAME'])//αν τον βρουμε τοτε αλλαζουμε το ban στην βαση και ενημερωνουμε το λογο του ban
		{
			mysql_query("UPDATE USERS SET BAN='YES' WHERE USERNAME='$name_ban'");
			mysql_query("UPDATE USERS SET FOR_BAN='$text_ban' WHERE USERNAME='$name_ban'");
			$found=true;
		}
		
		$row=mysql_fetch_array($result);
	}
	
	if($found)//αν εγινε ενημερωνουμε οτι ολα πηγαν καλα
		{
			include "admin_page.html";
			echo "<div class=\"newuser\">";
			echo "<p class=\"mhnuma\">Ο χρήστης με username: </font>".$name_ban." αποκλείστηκε!</p>";
			echo "</div>";
		}
		
		else//αλλιως δεν υπαρχει ο χρηστης στην βαση.
		{
			include "admin_page.html";
			echo "<div class=\"newuser\">";
			echo "<p class=\"eidopoihsh\">Ο αποκλεισμός δεν έγινε! Δεν υπάρχει χρήστης με username: ".$name_ban." !</p>";
			echo "</div>";
		}




?>
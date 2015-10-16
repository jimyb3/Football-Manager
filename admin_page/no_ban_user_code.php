<?php
session_start();

	$no_ban_user=$_GET["no_ban_user"];//κραταμε το username του χρηστη
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);
	$result=mysql_query("SELECT * FROM USERS WHERE USERNAME='$no_ban_user'");//ψαχνουμε για τα στοιχεια του χρηστη με βαση το username
	
	$row=mysql_fetch_array($result);
	
	if($row['BAN']=='YES')//αν εχει ban τοτε το αλλαζουμε και σβηνουμε το λογο
	{
		mysql_query("UPDATE USERS SET BAN='NO' WHERE USERNAME='$no_ban_user'");
		mysql_query("UPDATE USERS SET FOR_BAN='' WHERE USERNAME='$no_ban_user'");
		include "admin_page.html";
		echo "<div class=\"newuser\">";
		echo "<p class=\"mhnuma\">Η άρση του αποκλεισμού έγινε!</p>";
		echo "</div>";
	}
	
	else//αλλιως ενημερωνουμε τον διαχειριστη οτι ο χρηστης δεν ειχε ban
	{
		include "admin_page.html";
		echo "<div class=\"newuser\">";
		echo "<p class=\"eidopoihsh\">Η άρση του αποκλεισμού δεν είναι εφικτή. Ο χρήστης με username: ".$no_ban_user." δεν έχει αποκλειστεί!</p>";
		echo "</div>";
	}
	
	mysql_close($con);
?>
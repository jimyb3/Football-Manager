<?php
	echo "<html>";
	$to=$_GET['email'];
	$subject="Υπενθύμιση κωδικού πρόσβασης";
	
	$con=mysql_connect("localhost","root","");
		
	if(!$con)
	{
		die("Could not connect:".mysql_error());		
	}
	
	mysql_select_db("foo_man",$con);
	
	$result=mysql_query("SELECT PASSWORD FROM USERS WHERE EMAIL='$to'");
	$row=mysql_fetch_array($result);
	if($row['PASSWORD'])
	{
	$message="Ο κωδικός πρόσβασης είναι: ".$row['PASSWORD'];
	$from="football_manager@hotmail.com";
	$headers="From: $from";
	mail($to,$subject,$message,$headers);
	include "forget.html";
	
	echo "<head>";
		echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"file1.css\" />";
	echo "</head>";
	
	
	echo "<body>";
	echo "<div class=\"login\">";
	echo "<p class=\"mhnuma\">To email στάλθηκε με επιτυχία!<p/>";
	//echo "<br>";
	//echo "<br />";
	//echo "<br />";
	//echo "<br />";
	echo "<p class=\"mhnuma\">Αλλά επειδή δεν υπάρχει web server, ορίστε το μήνυμα του email:<br>".$message."</p>";
	//echo "<br />";
	//echo "<p class=\"munhma\">.$message.\"</p>";
	//echo "<p class=\"mhnuma\"></p>";

	}
	else
	{
		include "forget.html";
		//echo "<center>";
		echo "<div class=\"login\">";
		echo "<p class=\"eidopoihsh\">Δεν υπάρχει χρήστης με αυτό το email!</p></div>";
		//echo "</center>";	
	}
	echo "</div>";
	echo "</body>";
	echo "</html>";
?>
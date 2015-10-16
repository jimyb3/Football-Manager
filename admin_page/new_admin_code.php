<?php
session_start();
	
	$username=$_GET["username"];//κραταμε τα στοιχεια που εδωσε ο admin
	$password=$_GET["password"];
	$found_admin=true;
	$found_pass=true;	
	$found_keno_admin=true;
	$found_keno_pass=true;
	
	if($username=="")
	{
		$found_keno_admin=false;	
	}
	
	if($password=="")
	{
		$found_keno_pass=false;
	}
	
	
	$con=mysql_connect("localhost","root","");
	
	if(!$con)
	{
		die("Could not connect:".mysql_error());
	}
	
	mysql_select_db("foo_man",$con);	
	
	$result=mysql_query("SELECT * FROM ADMIN");
	$row=mysql_fetch_array($result);
	
	while($row)
	{
		if($username==$row['USERNAME'])//ελεγχουμε αν υπαρχει το username
		{
			$found_admin=false;
		}	
		
		$row=mysql_fetch_array($result);
	}
		
		
	if($password!=$_GET["repassword"])//ελεγχουμε αν είναι ιδια τα δυο password που εδωσε ο admin
	{
		$found_pass=false;	
	}	
	
	
	if($found_admin && $found_pass && $found_keno_admin && $found_keno_pass)
	{
		mysql_query("INSERT INTO ADMIN(USERNAME,PASSWORD) VALUES('$username','$password')");
		include "admin_page.html";
		echo "<p class=\"mhnuma\">Προστέθηκε νέος διαχειριστής!</p>";
	}
	
	else
	{
		include "new_admin.php";
		echo "<html>";
			echo "<head>";
				echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"../file1.css\" />";
			echo "</head>";
			
			echo "<body>";
			echo "<div class=\"login\">";
		
			if($found_keno_admin==false)
			{
				echo "<p class=\"eidopoihsh\">Πρέπει να δώσεις USERNAME.</p><br />";	
			}
			
			if($found_keno_pass==false)
			{
				echo "<p class=\"eidopoihsh\">Πρέπει να δώσεις PASSWORD.</p><br />";	
			}
		
			if($found_admin==false)
			{
				echo "<p class=\"eidopoihsh\">Υπάρχει διαχειριστής με αυτό το USERNAME, δώσε άλλο USERNAME.</p><br />";
			}
			
			if($found_pass==false)
			{
				echo "<p class=\"eidopoihsh\">Ο κωδικός δεν είναι ίδιος στα δύο πεδία.</p><br />";
			}
			
			echo "</div>";
			echo "</body>";
		
		echo "</html>";	
	}
	
	mysql_close($con);

?>
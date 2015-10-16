<?php


	$con=mysql_connect("localhost","root","");//Συνδεόμαστε στην βάση μας
	
	if(!$con)//Αν δεν γίνει η σύνδεση να εμφανιστεί σφάλμα στον χρήστη
	{
		die("Could not connect:".mysql_error());
	}
		
	mysql_select_db("foo_man",$con);	
	
	$result=mysql_query("SELECT * FROM USERS");//φορτώνουμε όλα τα στοιχείων των χρηστών
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	$ban=false;


	while($row)
	{
		if($_GET["username"]==$row['USERNAME'])	//ελεγχος του username
		{	
			if($_GET["password"]==$row['PASSWORD'])//ελεγχος του password
			{	
				if($row['BAN']=='NO')//ελεγχουμε για ban και φορτώνουμε κάποια στοιχεία σε session που θα μας χρειαστούν αργότερα
				{
					session_start();
					$found=true;
					$_SESSION["logged"]=true;
					$_SESSION["username"]=$_GET["username"];
					$_SESSION["usermoney"]=$row['MONEY'];
					Header("Location: http://localhost/project/user_page/welcome_user.php");
				}
				
				else if($row['BAN']=='YES')//αφου έχει ban θα επιστρέψει στην αρχική με τον λόγο του ban
				{
					$found=true;
					
					echo "<p class=\"eidopoihsh\">ΣΟΥ ΕΧΕΙ ΔΩΘΕΙ BAN, ΓΙΑ ΤΟΝ ΕΞΗΣ ΛΟΓΟ:  </p><br />";
					echo "<p class=\"eidopoihsh\">".$row['FOR_BAN']."</p>";
					include "login.html";
					
				}	
			}
		}
		$row=mysql_fetch_array($result);
	}


	//ελεγχοι συνδεσης για ADMIN
	$result=mysql_query("SELECT * FROM ADMIN");
	
	$row=mysql_fetch_array($result);
	
	while($row)
	{
		if($_GET["username"]==$row['USERNAME'])	
		{	
			if($_GET["password"]==$row['PASSWORD'])
			{
				session_start();
				$found=true;
				$_SESSION["logged"]=true;
				Header("Location: http://localhost/project/admin_page/welcome_admin.php");
			}
		}
		$row=mysql_fetch_array($result);
	}
	
	mysql_close($con);
	
	
	
	
	if(!$found)//Σε περιπτωση που καποιος παει να ανοιξει την σελιδα χωρις login
	{
		session_start();
		$_SESSION["logged"]=false;
		Header("Location: http://localhost/project/login/login.html");
	}
	
	


?>
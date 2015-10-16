<?php
session_start();

	$user_search=$_GET["user_search"];//κραταμε το ονομα που ψαχνουμε
	$con=mysql_connect("localhost","root","");//συνδεομαστε στον server
	
	if(!$con)//αλλιως λαθος
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);//συνδεομαστε στην βαση
	
	$result=mysql_query("SELECT * FROM USERS");//αφου ψαχνουμε χρηστη τοτε ανοιγουμε τους χρηστες
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	
	while($row)
	{
		if($user_search==$row['USERNAME'])//αν τον βρουμε θα εφμανισουμε ολα τα στοιχεια του
		{
			include "admin_page.html";
			echo "<div class=\"login\">";
			echo "O χρήστης με username ".$row['USERNAME']." υπάρχει!<br><br>";
			echo "<table class=\"center\">";
			echo "<tr>";
	
				echo "<td>"."USERNAME"."</td>";	
				echo "<td>"."BAN"."</td>";
				echo "<td>"."ΛΟΓΟΣ ΓΙΑ ΤΟ ΒΑΝ"."</td>";
				echo "<td>"."ΟΝΟΜΑ"."</td>";
				echo "<td>"."ΕΠΙΘΕΤΟ"."</td>";
				echo "<td>"."ΧΡΗΜΑΤΑ"."</td>";
				echo "<td>"."e-MAIL"."</td>";
		
			echo "</tr>";
			
			
			echo "<tr>";
			
				echo "<td>".$row['USERNAME']."</td>";
				echo "<td>".$row['BAN']."</td>";
				echo "<td>".$row['FOR_BAN']."</td>";
				echo "<td>".$row['NAME']."</td>";
				echo "<td>".$row['LASTNAME']."</td>";
				echo "<td>".$row['MONEY']." &#8364</td>";
				echo "<td>".$row['EMAIL']."</td>";
			
			echo "</tr>";
			
			echo "</div>";
			$found=true;
				
		}
		
		$row=mysql_fetch_array($result);	
			
	
	}
	
	mysql_close($con);
	
	if(!$found)//αλλιως θα πουμε οτι δεν υπαρχει
	{
		include "admin_page.html";
		echo "<div class=\"login\">";	
		echo "<center>O χρήστης με username ".$user_search." ΔΕΝ υπάρχει!</center>";
		echo "</div>";
	}



?>
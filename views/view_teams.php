<?php
session_start();
	if($_SESSION["logged"]==TRUE)//ελεγχος σωστου login
	{
	
		echo "<html>";
		include "../admin_page/admin_page.html";
		echo "<body>";
		
		$con=mysql_connect("localhost","root","");//συνδεση με το server
		
		if(!$con)//ελεγχος αν εγινε με επιτυχια αλλιως σφαλμα
		{
			die("Could not connect:".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);//επιλεγουμε βαση	
		
		$result=mysql_query("SELECT * FROM TEAMS");//επιλεγουμε ολα τα στοιχεια απο τις ομαδες
		
		$row=mysql_fetch_array($result);//σε καθε φορτωμα περνουμε ολες τις τιμες καθε γραμμης για αυτο πρεπει να τις σπασουμε τις πληροφοριες σε μια μια
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)
		{
			$pin_team_logo[$record]=$row['TEAM_LOGO'];//ετσι σπαμε τις πληροφοριες, χρησιμοποιοντας εναν δικο μας πινακα φορτωνουμε της καθε γραμμης τις πληροφοριες
			$pin_team_name[$record]=$row['NAME_TEAM'];
			$pin_money[$record]=$row['MONEY'];
			$pin_username[$record]=$row['USERNAME'];	
			
			$record++;//πρεπει να αυξησουμε την τιμη του πινακα μας για περασουμε τα νεα στοιχεια
			$row=mysql_fetch_array($result);//φορτωνουμε την επομενη γραμμη με τα επομενα στοιχεια
			
		}
		
		
		echo "<tr>";
		
			
			echo "<td>"."ΕΜΒΛΗΜΑ ΟΜΑΔΑΣ"."</td>";	//οριζουμε ποιος θα ειναι ο τιτλος καθε στηλης, με το <tr></tr> ορίζουμε γραμμη ενώ με το <td></td> ορίζουμε στηλη
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams.php\">ΟΝΟΜΑ ΟΜΑΔΑΣ</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams_money.php\">ΧΡΗΜΑΤΑ</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams_manager.php\">MANAGER</a>"."</td>";
			
		echo "</tr>";
		
		array_multisort($pin_team_name,$pin_team_logo,$pin_money,$pin_username);//ταξινομηση με βαση το username, πρέπει να βαλουμε και τα υπολοιπα στοιχεια του πίνακα ώστε να αλλάξει και η σειρά από τα υπολοιπα στοιχεια συμφωνα με την ταξινομιση που κάναμε
		
		
		
		for($i=0;$i<=$record-1;$i++)//γεμισμα του πινακα με τα στοιχεια του πινακα που ειχαμε φτιάξει όταν φορτώναμε τα στοιχεια απο τη βαση
		{
			echo "<tr>";
				
				echo "<td>"."<img src=\"$pin_team_logo[$i]\" width=\"150\" height=\"100\">"."</td>";
				echo "<td>".$pin_team_name[$i]."</td>";
				echo "<td>".$pin_money[$i]." &#8364</td>";
				echo "<td>".$pin_username[$i]."</td>";
				
			echo "</tr>";
				
		}
		
		echo "</table>";
		echo"</body>";
		
		mysql_close($con);
		
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");


?>
<?php

session_start();

	if($_SESSION["logged"]==TRUE)//ελεγχος για σωστο login
	{
		echo "<html>";
		include "../admin_page/admin_page.html";//ενσωματωση των κουμπιων του admin
		
		
		$con=mysql_connect("localhost","root","");//συνδεση με το server
		
		if(!$con)//ελεγχος για το αν εγινε με επιτυχια αλλιως σφαλμα
		{
			die("Could not connect:".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);//διαλεγουμε ποια ωαση θελουμε
		
		$result=mysql_query("SELECT * FROM USERS");//φορτωνουμε τα στοιχεια για τους χρηστες
		
		$row=mysql_fetch_array($result);//σε καθε φορτωμα περνουμε ολες τις τιμες καθε γραμμης για αυτο πρεπει να τις σπασουμε τις πληροφοριες σε μια μια
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)//τα φορτωνουμε σε πινακα
		{
			$pin_username[$record]=$row['USERNAME'];//ετσι σπαμε τις πληροφοριες, χρησιμοποιοντας εναν δικο μας πινακα φορτωνουμε της καθε γραμμης τις πληροφοριες
			$pin_ban[$record]=$row['BAN'];
			$pin_forban[$record]=$row['FOR_BAN'];
			$pin_name[$record]=$row['NAME'];	
			$pin_lastname[$record]=$row['LASTNAME'];
			$pin_money[$record]=$row['MONEY'];
			$pin_email[$record]=$row['EMAIL'];
			$record++;//πρεπει να αυξησουμε την τιμη του πινακα μας για περασουμε τα νεα στοιχεια
			$row=mysql_fetch_array($result);//φορτωνουμε την επομενη γραμμη με τα επομενα στοιχεια
			
		}
		
		
		echo "<tr>";//οριζουμε ποιος θα ειναι ο τιτλος καθε στηλης, με το <tr></tr> ορίζουμε γραμμη ενώ με το <td></td> ορίζουμε στηλη
		
			echo "<td>"."<a href=\"http://localhost/project/views/view_users.php\">USERNAME</a>"."</td>";	
			echo "<td>"."<a href=\"http://localhost/project/views/view_ban.php\">BAN</a>"."</td>";
			echo "<td>"."ΛΟΓΟΣ ΓΙΑ ΤΟ ΒΑΝ"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_name.php\">ΟΝΟΜΑ</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_lastname.php\">ΕΠΙΘΕΤΟ</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_money.php\">ΧΡΗΜΑΤΑ</a>"."</td>";
			echo "<td>"."e-MAIL"."</td>";
			
		echo "</tr>";
		
		array_multisort($pin_username,$pin_ban,$pin_forban,$pin_name,$pin_lastname,$pin_money,$pin_email);//ταξινομηση με βαση το username, πρέπει να βαλουμε και τα υπολοιπα στοιχεια του πίνακα ώστε να αλλάξει και η σειρά από τα υπολοιπα στοιχεια συμφωνα με την ταξινομιση που κάναμε
		
		
		
		for($i=0;$i<=$record-1;$i++)//γεμισμα του πινακα με τα στοιχεια του πινακα που ειχαμε φτιάξει όταν φορτώναμε τα στοιχεια απο τη βαση
		{
			echo "<tr>";
				
				echo "<td>".$pin_username[$i]."</td>";
				echo "<td>".$pin_ban[$i]."</td>";
				echo "<td>".$pin_forban[$i]."</td>";
				echo "<td>".$pin_name[$i]."</td>";
				echo "<td>".$pin_lastname[$i]."</td>";
				echo "<td>".$pin_money[$i]." &#8364</td>";
				echo "<td>".$pin_email[$i]."</td>";
				
			echo "</tr>";
				
		}
	
		echo "</table>";
		echo"</center>";
		
		mysql_close($con);
		
		echo "</html>";
	}
	
	else
		Header("Location: http://localhost/project/login/login.html");

	
	

?>
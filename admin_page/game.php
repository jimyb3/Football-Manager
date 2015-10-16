<?php
session_start();

	if($_SESSION["logged"]==TRUE)
	{
		
		include "admin_page.html";
		echo "<html>";
		echo "<div class=\"newuser\">"; 
		echo "<p class=\"mhnuma\">Η αγωνιστική ολοκληρώθηκε!</p><br />";
		echo "<p class=\"mhnuma\">Οι αλλαγές φαίνονται παρακάτω με κόκκινο!</p><br />";
		echo "</div>";
		$con=mysql_connect("localhost","root","");
	
		if(!$con)
		{
			die("Could not connect:".mysql_error());	
		
		}
	
		mysql_select_db("foo_man",$con);	
		
		$result=mysql_query("SELECT * FROM PLAYERS WHERE PLAYERS.NAME_TEAM<>''");//βρισκουμε τους παικτες που ειναι σε ομαδα γενικα
		
		$row=mysql_fetch_array($result);
		
		
		echo "<table class=\"center\">";
		$record=0;
		
		echo "<tr>";
		
			echo "<td>"."ID ΠΑΙΚΤΗ"."</td>";
			echo "<td>"."ΦΩΤΟΓΡΑΦΙΑ"."</td>";	
			echo "<td>"."ΟΝΟΜΑ"."</td>";
			echo "<td>"."ΕΠΙΘΕΤΟ"."</td>";
			echo "<td>"."ΘΕΣΗ"."</td>";
			echo "<td>"."ΧΡΗΜΑΤΙΚΗ ΑΞΙΑ"."</td>";
			echo "<td>"."GOAL"."</td>";	
			echo "<td>"."ΑΥΤΟΓΚΟΛ"."</td>";
			echo "<td>"."ΑΠΟΚΡΟΥΣΕΙΣ"."</td>";
			echo "<td>"."ΠΟΙΝΕΣ"."</td>";
			echo "<td>"."ΠΑΡΟΥΣΙΑ"."</td>";
			echo "<td>"."ΟΝΟΜΑ ΟΜΑΔΑΣ"."</td>";	
			
		echo "</tr>";
		
		while($row)
		{
			$time=explode(' ',microtime());//χρησιμοποιουμε τα microsecont για να δημιουργησουμε 10 διαφορετικες καταστασεις
			$time[0]=$time[0]*1000000;
			
			$player=$row['PLAYER_ID'];
			$pin_player_id[$record]=$row['PLAYER_ID'];
			$pin_player_name[$record]=$row['NAME'];
			$pin_player_lastname[$record]=$row['LASTNAME'];
			$pin_player_position[$record]=$row['POSITION'];
			$pin_player_money[$record]=$row['MONEY'];	
			$pin_player_goal[$record]=$row['GOAL'];
			$pin_player_selfgoal[$record]=$row['SELF_GOAL'];
			$pin_player_repulse[$record]=$row['REPULSE'];
			$pin_player_fault[$record]=$row['FAULT'];
			$pin_player_ingame[$record]=$row['INGAME'];
			$pin_player_photo[$record]=$row['PHOTO'];
			$pin_player_nameteam[$record]=$row['NAME_TEAM'];
			
			
			//Πρώτη κατάσταση, όπου Τερματοφύλακας αυξάνει κατα 1 τις αποκρούσεις έχει παρουσία 6
			if($time[0]>=0 && $time[0]<=99999 && $time[0]%2==0 && $pin_player_position[$record]=='goalkeeper')
			{
				$repulse=$row['REPULSE'];
				$repulse=$repulse+1;
				$ingame=6;
				$money=$row['MONEY'];
				$money=$money+(1*200)+6;
				mysql_query("UPDATE PLAYERS SET REPULSE='$repulse' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_repulse[$record]."</font>"."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
			}
			//Δεύτερη κατάσταση όπου αμυντικός μέσος επιθετικός βάζουν goal και παρουασία 5
			else if($time[0]>=100000 && $time[0]<=199999 && $time[0]%2==0 && ($pin_player_position[$record]=='defensive' || $pin_player_position[$record]=='middle' || $pin_player_position[$record]=='offensive'))
			{
				$goal=$row['GOAL'];
				$goal=$goal+1;
				$ingame=5;
				$money=$row['MONEY'];
				$money=$money+(1*100)+5;
				mysql_query("UPDATE PLAYERS SET GOAL='$goal' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_goal[$record]."</font>"."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
			}
			//Τρίτη κατάσταση αμυντικός μέσος επιθετικός βαζουν 2 goal και παρουσια 8
			else if($time[0]>=200000 && $time[0]<=299999  && $time[0]%2==0 && ($pin_player_position[$record]=='defensive' || $pin_player_position[$record]=='middle' || $pin_player_position[$record]=='offensive'))
			{
				$goal=$row['GOAL'];
				$goal=$goal+2;
				$ingame=8;
				$money=$row['MONEY'];
				$money=$money+(2*100)+8;
				mysql_query("UPDATE PLAYERS SET GOAL='$goal' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_goal[$record]."</font>"."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
			}
			//Τεταρτη κατασταση αμυντικος τερματοφυλακας βαζουν selfgoal και παρουσία 3
			else if($time[0]>=300000 && $time[0]<=399999 && $time[0]%2==0 && ($pin_player_position[$record]=='goalkeeper' || $pin_player_position[$record]=='defensive'))
			{
				$selfgoal=$row['SELF_GOAL'];
				$selfgoal=$selfgoal+1;
				$ingame=3;
				$money=$row['MONEY'];
				$money=$money+(1*(-50))+3;
				mysql_query("UPDATE PLAYERS SET SELF_GOAL='$selfgoal' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_selfgoal[$record]."</font>"."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
			
			}
			//Πεμπτη κατασταση τερματοφυλακας αποκρουει 1 και παρουασια 9
			else if($time[0]>=400000 && $time[0]<=499999 && $time[0]%2==0 && $pin_player_position[$record]=='goalkeeper')
			{
				$repulse=$row['REPULSE'];
				$repulse=$repulse+1;
				$ingame=9;
				$money=$row['MONEY'];
				$money=$money+(1*200)+9;
				mysql_query("UPDATE PLAYERS SET REPULSE='$repulse' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_repulse[$record]."</font>"."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
				
			}
			//Εκτη κατασταση όλους το fault αυξάνεται κατα 1 και παρουσία 2
			else if($time[0]>=500000 && $time[0]<=599999 && $time[0]%2==0)
			{
				$fault=$row['FAULT'];
				$fault=$fault+1;
				$ingame=2;
				$money=$row['MONEY'];
				$money=$money+(1*(-50))+2;
				mysql_query("UPDATE PLAYERS SET FAULT='$fault' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_fault[$record]."</font>"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
				
			}
			//Έβδομη κατάσταση μέσος επιθετικός βάζουν 1 goal λκαι παρουσία 6
			else if($time[0]>=600000 && $time[0]<=699999 && $time[0]%2==0 && ($pin_player_position[$record]=='offensive' || $pin_player_position[$record]=='middle'))
			{
				$goal=$row['GOAL'];
				$goal=$goal+1;
				$ingame=6;
				$money=$row['MONEY'];
				$money=$money+(1*100)+6;
				mysql_query("UPDATE PLAYERS SET GOAL='$goal' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_goal[$record]."</font>"."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
				
			}
			//Ογδοη κατάσταση επιθετικος βαζει 3 goal και παρουσια 10
			else if($time[0]>=700000 && $time[0]<=799999  && $time[0]%2==0 && $pin_player_position[$record]=='offensive')
			{
				$goal=$row['GOAL'];
				$goal=$goal+3;
				$ingame=10;
				$money=$row['MONEY'];
				$money=$money+(3*100)+10;
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET GOAL='$goal' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_goal[$record]."</font>"."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
				
			}
			//Ένατη κατασταση τερματοφυλακας αμυντικος αποκρουση και παρουσια 8
			else if($time[0]>=800000 && $time[0]<=899999 && $time[0]%2==0 && $pin_player_position[$record]=='goalkeeper')
			{
				$repulse=$row['REPULSE'];
				$repulse=$repulse+1;
				$ingame=8;
				$money=$row['MONEY'];
				$money=$money+(1*200)+8;
				mysql_query("UPDATE PLAYERS SET REPULSE='$repulse' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_repulse[$record]."</font>"."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
				
			}
			//Δέκατη κατασταση σε όλους παρουσια 5
			else if($time[0]>=900000 && $time[0]<=999999 && $time[0]%2==0)
			{
				$ingame=5;
				$money=$row['MONEY'];
				$money=$money+5;
				mysql_query("UPDATE PLAYERS SET INGAME='$ingame' WHERE PLAYER_ID='$player'");
				mysql_query("UPDATE PLAYERS SET MONEY='$money' WHERE PLAYER_ID='$player'");	
				
				echo "<tr>";
				
					echo "<td>".$pin_player_id[$record]."</td>";
					echo "<td>"."<img src=\"$pin_player_photo[$record]\">"."</td>";
					echo "<td>".$pin_player_name[$record]."</td>";
					echo "<td>".$pin_player_lastname[$record]."</td>";
						if($pin_player_position[$record]=='offensive')
							echo "<td>"."Επιθετικός"."</td>";
						else if($pin_player_position[$record]=='defensive')
							echo "<td>"."Αμυντικός"."</td>";
						else if($pin_player_position[$record]=='middle')
							echo "<td>"."Μέσος"."</td>";
						else
							echo "<td>"."Τερματοφύλακας"."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_money[$record]."</font>"." &#8364</td>";
					echo "<td>".$pin_player_goal[$record]."</td>";
					echo "<td>".$pin_player_selfgoal[$record]."</td>";
					echo "<td>".$pin_player_repulse[$record]."</td>";
					echo "<td>".$pin_player_fault[$record]."</td>";
					echo "<td>"."<font style=\"color:red\">".$pin_player_ingame[$record]."</font>"."</td>";
					echo "<td>".$pin_player_nameteam[$record]."</td>";
				
				echo "</tr>";
			
				
			}
			$record++;
			$row=mysql_fetch_array($result);		
		}
		
		
		echo "</table>";
		echo"</center>";
		
		$result=mysql_query("SELECT * FROM TEAMS");
		
		$row=mysql_fetch_array($result);
		$record=0;
		
		while($row) //Αφού έγινε ο αγώνας και άλλαξαν τα στατιστικά κάθε παίκτη, τώρα θα ανανεώσουμε το ποσό που αντιστοιχεί σε κάθε ομάδα!
		{
			$money=0;
			
			$name_team[$record]=$row['NAME_TEAM'];
			
			$result1=mysql_query("SELECT * FROM PLAYERS WHERE PLAYERS.NAME_TEAM<>''");//Βρίσκουμε ποιοι παίκτες ανήκουν γενικά σε ομάδα
		
			$row1=mysql_fetch_array($result1);	
			$record2=0;
			
			while($row1)
			{
				$name_team_player[$record2]=$row1['NAME_TEAM'];
				$player_money[$record2]=$row1['MONEY'];
					if($name_team[$record]==$name_team_player[$record2])
						{
							$money=$money+$player_money[$record2];//Αθρίζουμε το ποσο του καθε παικτη που ανηκει στην ιδια ομαδα
						}
				
				$record2++;
				$row1=mysql_fetch_array($result1);	
			}
			mysql_query("UPDATE TEAMS SET MONEY='$money' WHERE NAME_TEAM='$name_team[$record]'");//Το περνάμε στην βάση στην χρηματική αξία της ομάδας.
		$record++;	
		$row=mysql_fetch_array($result);	
		}
		
		
		
		mysql_close($con);
		 
		
		
		echo "</html>";
	
	}
	
	else 
		Header("Location: http://localhost/project/login/login.html");

?>
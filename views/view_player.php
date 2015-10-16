<?php
session_start();
	if($_SESSION["logged"]==true)
	{
	
		echo "<html>";
		include "../admin_page/admin_page.html";
		echo "<body>";
		
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die("Could not connect:".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);	
		
		$result=mysql_query("SELECT * FROM PLAYERS");
		$row=mysql_fetch_array($result);
		
		echo "<table class=\"center\">";
		
		$record=0;
		while($row)
		{
			$pin_player_id[$record]=$row['PLAYER_ID'];
			$pin_player_name[$record]=$row['NAME'];
			
			$pin_player_lastname[$record]=$row['LASTNAME'];
			$date=explode("-", $row['P_BIRTHDATE']);
			$hmer=getdate(date("U"));	
			$pin_player_age[$record]=$hmer['year']-$date[0];
		
			$pin_player_position[$record]=$row['POSITION'];
			$pin_player_money[$record]=$row['MONEY'];	
			$pin_player_goal[$record]=$row['GOAL'];
			$pin_player_selfgoal[$record]=$row['SELF_GOAL'];
			$pin_player_repulse[$record]=$row['REPULSE'];
			$pin_player_fault[$record]=$row['FAULT'];
			$pin_player_ingame[$record]=$row['INGAME'];
			$pin_player_photo[$record]=$row['PHOTO'];
			$pin_player_nameteam[$record]=$row['NAME_TEAM'];
			
			$record++;
			$row=mysql_fetch_array($result);
			
		}
		
		
		echo "<tr>";
		
			echo "<td>"."ID ΠΑΙΚΤΗ"."</td>";
			echo "<td>"."ΦΩΤΟΓΡΑΦΙΑ"."</td>";	
			echo "<td>"."ΟΝΟΜΑ"."</td>";
			echo "<td>"."ΕΠΙΘΕΤΟ"."</td>";
			echo "<td>"."ΗΛΙΚΙΑ"."</td>";
			echo "<td>"."ΘΕΣΗ"."</td>";
			echo "<td>"."ΧΡΗΜΑΤΙΚΗ ΑΞΙΑ"."</td>";
			echo "<td>"."GOAL"."</td>";	
			echo "<td>"."ΑΥΤΟΓΚΟΛ"."</td>";
			echo "<td>"."ΑΠΟΚΡΟΥΣΕΙΣ"."</td>";
			echo "<td>"."ΠΟΙΝΕΣ"."</td>";
			echo "<td>"."ΠΑΡΟΥΣΙΑ"."</td>";
			echo "<td>"."ΟΝΟΜΑ ΟΜΑΔΑΣ"."</td>";	
			
		echo "</tr>";
		
		
		
		for($i=0;$i<=$record-1;$i++)
		{
			echo "<tr>";
				
				echo "<td>".$pin_player_id[$i]."</td>";
				echo "<td>"."<img src=\"$pin_player_photo[$i]\">"."</td>";
				echo "<td>".$pin_player_name[$i]."</td>";
				echo "<td>".$pin_player_lastname[$i]."</td>";
				echo "<td>".$pin_player_age[$i]."</td>";
					if($pin_player_position[$i]=='offensive')//εδω θα δουμε ποια θεση εχει ο παικτης και θα την εμφανιζουμε στα ελληνικα
						echo "<td>"."Επιθετικός"."</td>";
					else if($pin_player_position[$i]=='defensive')
						echo "<td>"."Αμυντικός"."</td>";
					else if($pin_player_position[$i]=='middle')
						echo "<td>"."Μέσος"."</td>";
					else
						echo "<td>"."Τερματοφύλακας"."</td>";
				echo "<td>".$pin_player_money[$i]." &#8364</td>";
				echo "<td>".$pin_player_goal[$i]."</td>";
				echo "<td>".$pin_player_selfgoal[$i]."</td>";
				echo "<td>".$pin_player_repulse[$i]."</td>";
				echo "<td>".$pin_player_fault[$i]."</td>";
				echo "<td>".$pin_player_ingame[$i]."</td>";
				echo "<td>".$pin_player_nameteam[$i]."</td>";
				
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
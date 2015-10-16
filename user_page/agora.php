<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	  
	if($_SESSION["logged"]==TRUE)
	{
		$user=$_SESSION["username"];
		include "user_page.html";
		echo "<html>";
		echo "<head>";
		echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"file1.css\" />";
		echo "</head>";
		echo "<body>";
		echo "<div class=\"myteam\">"; 
		echo "ΔΙΑΘΕΣΙΜΟ ΠΟΣΟ:".$_SESSION["usermoney"]." &#8364<br \>";
		echo "</div>";
		echo "<br>";
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die("<p class=\"eidopoihsh\" >Could not connect:</p>".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);
		
		
		echo "<form action=\"http://localhost/project/user_page/agora_code.php\" method=\"GET\">";
		
		echo "<table class=\"polisi1\">";///////////////3ekinaei o pinakas epipedou 1//////////////////
		echo "<tr>";	
		echo "<td>Οι παίχτες μου</td>";
		echo "<td></td>";
		echo "<td>Διαθέσιμοι παίχτες</td>";
		echo "</tr>";	
		echo "<tr>";
			echo "<td>";
		
				$result=mysql_query("SELECT * FROM TEAMS WHERE USERNAME='$user'");
				$row=mysql_fetch_array($result);
				
				$omada=$row['NAME_TEAM'];
				
				
				echo "<table class=\"polisi1\">";//////////////pinakas epipedou 2//////////////////////
				$result=mysql_query("SELECT * FROM PLAYERS WHERE PLAYERS.NAME_TEAM='$omada'");
				$row=mysql_fetch_array($result);
				$record=0;
				
				while($row)
				{
					$pin_player_id[$record]=$row['PLAYER_ID'];
					$pin_player_name[$record]=$row['NAME'];
					$pin_player_lastname[$record]=$row['LASTNAME'];
					$pin_player_position[$record]=$row['POSITION'];
					$pin_player_money[$record]=$row['MONEY'];
					//$pin_player_photo[$record]=$row['PHOTO'];
					
					$record++;
					$row=mysql_fetch_array($result);
					
				}
				
				echo "<tr>";/////grammh i
					
					echo "<td></td>";////adeio keli 1///////
					
					//echo "<td>"."ΦΩΤΟΓΡΑΦΙΑ"."</td>";	
					echo "<td>"."ΟΝΟΜΑ"."</td>";///////keli 2/////////////
					echo "<td>"."ΕΠΙΘΕΤΟ"."</td>";////keli 3 /////////////
					echo "<td>"."ΘΕΣΗ"."</td>";///////////keli 4///////
					echo "<td>"."ΧΡΗΜΑΤΙΚΗ ΑΞΙΑ"."</td>";	/////keli 5////////////
					
				echo "</tr>";/////telos grammis 1/////////////
				
				array_multisort($pin_player_position,$pin_player_id,$pin_player_name,$pin_player_lastname,$pin_player_money);
				
				for($i=0;$i<=$record-1;$i++)
				{
					echo "<tr>";//////grammi2//////////////
						
						echo "<td><input type=\"radio\" checked name=\"sell_player\" value=$pin_player_name[$i].$pin_player_lastname[$i].$pin_player_money[$i].$pin_player_position[$i].$pin_player_id[$i]></td>";
							//echo "<td>"."<img src=\"$pin_player_photo[$i]\">"."</td>";
							echo "<td>".$pin_player_name[$i]."</td>";
							echo "<td>".$pin_player_lastname[$i]."</td>";
								if($pin_player_position[$i]=='offensive')
									echo "<td>"."Επιθετικός"."</td>";
								else if($pin_player_position[$i]=='defensive')
									echo "<td>"."Αμυντικός"."</td>";
								else if($pin_player_position[$i]=='middle')
									echo "<td>"."Μέσος"."</td>";
								else
									echo "<td>"."Τερματοφύλακας"."</td>";
							echo "<td>".$pin_player_money[$i]." &#8364</td>";
						
					echo "</tr>";///telos grammis 2////epanalipseis///////
						
				}
				
				echo "</table>";//////////telos protou pinaka tou ekliou 1
			echo "</td>";///TELOS toy kelioy
			
			echo "<td></td>";///keno endiameso keli
			
			echo "<td>";///3o keli
			echo "<div>";
			//	echo "<pre style=\"margin:0; overflow:scroll; height:320\">";
				echo "<table class=\"polisi1\">";
					
					$result=mysql_query("SELECT * FROM PLAYERS WHERE PLAYERS.NAME_TEAM=''");
					$row=mysql_fetch_array($result);
					
					$record=0;
					while($row)
					{
						$pin_player_id[$record]=$row['PLAYER_ID'];
						$pin_player_name[$record]=$row['NAME'];
						$pin_player_lastname[$record]=$row['LASTNAME'];
						$pin_player_position[$record]=$row['POSITION'];
						$pin_player_money[$record]=$row['MONEY'];
						//$pin_player_photo[$record]=$row['PHOTO'];
						
						$record++;
						$row=mysql_fetch_array($result);
						
					}
					
					echo "<tr>";
						
						echo "<td></td>";
						
						//echo "<td>"."ΦΩΤΟΓΡΑΦΙΑ"."</td>";	
						echo "<td>"."ΟΝΟΜΑ"."</td>";
						echo "<td>"."ΕΠΙΘΕΤΟ"."</td>";
						echo "<td>"."ΘΕΣΗ"."</td>";
						echo "<td>"."ΧΡΗΜΑΤΙΚΗ ΑΞΙΑ"."</td>";	
						
					echo "</tr>";
					
					array_multisort($pin_player_position,$pin_player_id,$pin_player_name,$pin_player_lastname,$pin_player_money);
					
					for($i=0;$i<=$record-1;$i++)
					{
						echo "<tr>";
							
							echo "<td><input type=\"radio\" checked name=\"buy_player\" value=$pin_player_name[$i].$pin_player_lastname[$i].$pin_player_money[$i].$pin_player_position[$i].$pin_player_id[$i]></td>";
								//echo "<td>"."<img src=\"$pin_player_photo[$i]\">"."</td>";
								echo "<td>".$pin_player_name[$i]."</td>";
								echo "<td>".$pin_player_lastname[$i]."</td>";
									if($pin_player_position[$i]=='offensive')
										echo "<td>"."Επιθετικός"."</td>";
									else if($pin_player_position[$i]=='defensive')
										echo "<td>"."Αμυντικός"."</td>";
									else if($pin_player_position[$i]=='middle')
										echo "<td>"."Μέσος"."</td>";
									else
										echo "<td>"."Τερματοφύλακας"."</td>";
								echo "<td>".$pin_player_money[$i]." &#8364</td>";
							
						echo "</tr>";
							
					}
				echo "</table>";
				//echo "</pre>";
				echo "</div>";
			echo "</td>";
			echo "</tr>";
		echo "</table>";
		//echo "<br>";
		echo "<input class=\"oloklirosi\" type=\"submit\" value=\"Ολοκλήρωση\">";
		echo "</form>";
		echo"</body>";
		
		mysql_close($con);
		
		echo "</html>";
	
	}
	
	else
		Header("Location: http://localhost/project/login/login.html");



?>
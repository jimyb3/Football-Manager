<?php

	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	  

	if($_SESSION["logged"]==TRUE)
	{
		
		include "user_page.html";
		$user=$_SESSION["username"];
		echo "<html>";
			echo "<head>";
				echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"file1.css\" />";
			echo "</head>";
			
			echo "<body>";		
				echo "<div class=\"myteam\">";
					echo "диахесило посо:".$_SESSION["usermoney"]." &#8364";
				echo "</div>";
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die("<p class=\"eidopoihsh\" >Could not connect:</p>".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);
		
		
		
		$result=mysql_query("SELECT * FROM TEAMS WHERE USERNAME='$user'");
		
		$row=mysql_fetch_array($result);
		
		
		$omada=$row['NAME_TEAM'];
		$_SESSION['omada']=$omada;
		$result=mysql_query("SELECT * FROM PLAYERS WHERE PLAYERS.NAME_TEAM='$omada'");
		
		$row=mysql_fetch_array($result);
		//echo "<center>";
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)
		{
			$pin_player_id[$record]=$row['PLAYER_ID'];
			$pin_player_name[$record]=$row['NAME'];
			$pin_player_lastname[$record]=$row['LASTNAME'];
			$pin_player_position[$record]=$row['POSITION'];
			$date=explode("-", $row['P_BIRTHDATE']);
			$hmer=getdate(date("U"));	
			$pin_player_age[$record]=$hmer['year']-$date[0];
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
		
			echo "<td>"."ID"."</td>";
			echo "<td>"."жытоцяажиа"."</td>";	
			echo "<td>"."омола"."</td>";
			echo "<td>"."епихето"."</td>";
			echo "<td>"."гкийиа"."</td>";
			echo "<td>"."хесг"."</td>";
			echo "<td>"."вяглатийг аниа"."</td>";
			echo "<td>"."GOAL"."</td>";	
			echo "<td>"."аутоцйок"."</td>";
			echo "<td>"."апойяоусеис"."</td>";
			echo "<td>"."поимес"."</td>";
			echo "<td>"."паяоусиа"."</td>";
			echo "<td>"."омола оладас"."</td>";	
			
		echo "</tr>";
		
		array_multisort($pin_player_position,$pin_player_id,$pin_player_name,$pin_player_lastname,$pin_player_age,$pin_player_money,$pin_player_goal,$pin_player_selfgoal,$pin_player_repulse,$pin_player_fault,$pin_player_ingame,$pin_player_photo,$pin_player_nameteam);
		
		for($i=0;$i<=$record-1;$i++)
		{
			echo "<tr>";
				
				echo "<td>".$pin_player_id[$i]."</td>";
				echo "<td>"."<img src=\"$pin_player_photo[$i]\">"."</td>";
				echo "<td>".$pin_player_name[$i]."</td>";
				echo "<td>".$pin_player_lastname[$i]."</td>";
				echo "<td>".$pin_player_age[$i]."</td>";
					if($pin_player_position[$i]=='offensive')
						echo "<td>"."еПИХЕТИЙЭР"."</td>";
					else if($pin_player_position[$i]=='defensive')
						echo "<td>"."аЛУМТИЙЭР"."</td>";
					else if($pin_player_position[$i]=='middle')
						echo "<td>"."лщСОР"."</td>";
					else
						echo "<td>"."тЕЯЛАТОЖЩКАЙАР"."</td>";
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
		
		
		mysql_close($con);
		
		echo "</body>";
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
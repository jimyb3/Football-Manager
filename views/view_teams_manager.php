<?php
session_start();
	if($_SESSION["logged"]==TRUE)
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
		
		$result=mysql_query("SELECT * FROM TEAMS");
		
		$row=mysql_fetch_array($result);
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)
		{
			$pin_team_logo[$record]=$row['TEAM_LOGO'];
			$pin_team_name[$record]=$row['NAME_TEAM'];
			$pin_money[$record]=$row['MONEY'];
			$pin_username[$record]=$row['USERNAME'];	
			
			$record++;
			$row=mysql_fetch_array($result);
			
		}
		
		
		echo "<tr>";
		
			echo "<td>"."елбкгла оладас"."</td>";	
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams.php\">омола оладас</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams_money.php\">вяглата</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_teams_manager.php\">MANAGER</a>"."</td>";
			
		echo "</tr>";
		
		array_multisort($pin_username,$pin_money,$pin_team_name,$pin_team_logo);
		
		
		
		for($i=0;$i<=$record-1;$i++)
		{
			echo "<tr>";
				
				echo "<td>"."<img src=\"$pin_team_logo[$i]\">"."</td>";
				echo "<td>".$pin_team_name[$i]."</td>";
				echo "<td>".$pin_money[$i]."</td>";
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
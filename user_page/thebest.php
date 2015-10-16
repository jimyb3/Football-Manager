<?php

session_start();

	if($_SESSION["logged"]==TRUE)
	{
		
		include "user_page.html";
		echo "<html>";
		echo "<head>";
		echo "<link type=\"text/css\" rel=\"STYLESHEET\" href=\"file1.css\" />";
		echo "</head>";
		echo "<div class=\"myteam\">";
		echo "диахесило посо:".$_SESSION["usermoney"]." &#8364";
		echo "</div>";
		
	
		$con=mysql_connect("localhost","root","");
		
		if(!$con)
		{
			die(" <p class=\"eidopoihsh\" >Could not connect:</p>".mysql_error());	
			
		}
		
		mysql_select_db("foo_man",$con);	
		
		$result=mysql_query("SELECT * FROM USERS");
		
		$row=mysql_fetch_array($result);
		
		
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)
		{	
			$pin_username[$record]=$row['USERNAME'];
			$result1=mysql_query("SELECT MONEY FROM TEAMS WHERE USERNAME='$pin_username[$record]'");
			$row1=mysql_fetch_array($result1);
			
			$pin_money_team[$record]=$row1['MONEY'];
			$pin_money[$record]=$row['MONEY']+$pin_money_team[$record];
			$record++;
			$row=mysql_fetch_array($result);	
		}
		
		
		echo "<tr>";
			
			echo "<td></td>";
			echo "<td>"."USERNAME"."</td>";
			echo "<td>"."вяглата</a>"."</td>";
			
		echo "</tr>";
		
		array_multisort($pin_money,SORT_DESC,$pin_username);
		
		
		if($record<10)
		{
			$thesi=1;
			for($i=0;$i<=$record-1;$i++)
			{
				echo "<tr>";
					
					echo "<td>".$thesi."</td>";
					echo "<td>".$pin_username[$i]."</td>";
					echo "<td>".$pin_money[$i]." &#8364</td>";
					
					$thesi++;
					
				echo "</tr>";
					
			}
		}
		else
		{
			$thesi=1;
			for($i=0;$i<=10;$i++)
			{
				echo "<tr>";
					
					echo "<td>".$thesi."</td>";
					echo "<td>".$pin_username[$i]."</td>";
					echo "<td>".$pin_money[$i]." &#8364</td>";
					
					$thesi++;
					
				echo "</tr>";
					
			}	
			
		}	
		echo "</table>";
		
		
		mysql_close($con);
		
		echo "</html>";
	}
	else
		Header("Location: http://localhost/project/login/login.html");

?>
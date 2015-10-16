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
		
		$result=mysql_query("SELECT * FROM USERS");
		
		$row=mysql_fetch_array($result);
		
		echo "<table class=\"center\">";
		$record=0;
		
		while($row)
		{
			$pin_username[$record]=$row['USERNAME'];
			$pin_ban[$record]=$row['BAN'];
			$pin_forban[$record]=$row['FOR_BAN'];
			$pin_name[$record]=$row['NAME'];	
			$pin_lastname[$record]=$row['LASTNAME'];
			$pin_money[$record]=$row['MONEY'];
			$pin_email[$record]=$row['EMAIL'];
			$record++;
			$row=mysql_fetch_array($result);
			
		}
		
		
		echo "<tr>";
		
			echo "<td>"."<a href=\"http://localhost/project/views/view_users.php\">USERNAME</a>"."</td>";	
			echo "<td>"."<a href=\"http://localhost/project/views/view_ban.php\">BAN</a>"."</td>";
			echo "<td>"."коцос циа то бам"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_name.php\">омола</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_lastname.php\">епихето</a>"."</td>";
			echo "<td>"."<a href=\"http://localhost/project/views/view_money.php\">вяглата</a>"."</td>";
			echo "<td>"."e-MAIL"."</td>";
			
		echo "</tr>";
		
		array_multisort($pin_lastname,$pin_ban,$pin_username,$pin_forban,$pin_name,$pin_money,$pin_email);
		
		
		
		
		for($i=0;$i<=$record-1;$i++)
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
		echo"</body>";
		
		mysql_close($con);
		
		echo "</html>";
	
	}
	else
		Header("Location: http://localhost/project/login/login.html");


?>
<?php
session_start();

	$user_search=$_GET["user_search"];//������� �� ����� ��� ��������
	$con=mysql_connect("localhost","root","");//����������� ���� server
	
	if(!$con)//������ �����
		{
		die("Could not connect:".mysql_error());
		}
	
	mysql_select_db("foo_man",$con);//����������� ���� ����
	
	$result=mysql_query("SELECT * FROM USERS");//���� �������� ������ ���� ��������� ���� �������
	
	$row=mysql_fetch_array($result);
	
	$found=false;
	
	while($row)
	{
		if($user_search==$row['USERNAME'])//�� ��� ������ �� ����������� ��� �� �������� ���
		{
			include "admin_page.html";
			echo "<div class=\"login\">";
			echo "O ������� �� username ".$row['USERNAME']." �������!<br><br>";
			echo "<table class=\"center\">";
			echo "<tr>";
	
				echo "<td>"."USERNAME"."</td>";	
				echo "<td>"."BAN"."</td>";
				echo "<td>"."����� ��� �� ���"."</td>";
				echo "<td>"."�����"."</td>";
				echo "<td>"."�������"."</td>";
				echo "<td>"."�������"."</td>";
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
	
	if(!$found)//������ �� ����� ��� ��� �������
	{
		include "admin_page.html";
		echo "<div class=\"login\">";	
		echo "<center>O ������� �� username ".$user_search." ��� �������!</center>";
		echo "</div>";
	}



?>
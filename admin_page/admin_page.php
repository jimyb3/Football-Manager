<?php

session_start();

	if($_SESSION["logged"]==TRUE)//������ ���� ����� ����� �� login ���� ���� ������� ������ ������ ������
	{
		include "admin_page.html";//�� ��� ������ include ����� �������� ��� ���� ��� ������� ���� �� ������������� ��� ���� �� ������
	}
	else
		Header("Location: http://localhost/project/login/login.html");//�� ��� ������ header ����� ��� ������ �� ���� ��� ������ ���� �� ��� ������



?>
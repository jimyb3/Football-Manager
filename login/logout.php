<?php

session_start();
session_destroy();//��� �� ����� logout �� ������ �� ������������� �� session ��� ��� ���������� ������� ���� ������ �� ��� ������ destroy ���� �� ������ ���� �� �������� session_start

Header("Location: http://localhost/project/login/login.html");

?>
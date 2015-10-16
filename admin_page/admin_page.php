<?php

session_start();

	if($_SESSION["logged"]==TRUE)//εφοσον εχει γινει σωστα το login παει στην επομενη σελιδα αλλιως αρχικη
	{
		include "admin_page.html";//Με την εντολη include ειναι εννοουμε ότι εκει που ειμαστε τώρα να συμπεριλάβεις και αυτη τη σελιδα
	}
	else
		Header("Location: http://localhost/project/login/login.html");//με την εντολή header ειναι ότι ζητάμε να πάει τον χρήστη εκεί σε νέα σελιδα



?>
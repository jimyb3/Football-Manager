<?php

session_start();
session_destroy();//για να γινει logout θα πρέπει να καταστρεψουμε το session και ότι μεταβλητες υπηρχαν αυτο γίνετε με την εντολή destroy αλλά θα πρέπει πάλι να γράψουμε session_start

Header("Location: http://localhost/project/login/login.html");

?>
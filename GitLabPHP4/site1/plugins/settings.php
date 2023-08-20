<?php
date_default_timezone_set("Europe/Rome");
//SETUP MASTERPAGE
define("masterpage","global/masterpage.php");
//SETUP SERVER ADDRESS, USERNAME, PASSWORD
$conn = mysql_connect('mariadb', 'root', 'root_password');
//SETUP DATABASE    
function db_name() {return 'zpanel_misia';}
//SETUP DATABASE 

//SETUP DIRECTORY PATH
define("php_extension",".html");
define("url_rewriting",false);
define("number_of_directories",1);
define("domeniu","http://localhost/");
//1 if is on root, 2 if is on one subdirectory, 3 two subdirs...
//SETUP DEFAULT LANGUAGE
define("default_lang","en");
//Mail System
define("site_mail_system", 'smtp'); 
//define("site_mail_system", 'mail_1'); 
//define("site_mail_system", 'mail_2'); 
define("site_mail_name", 'Misiaspare'); 
define("site_mail_address", '');
define("default_recipient", '');
define("smtp_server","smtp.gmail.com");
define("smtp_port","465");
define("smtp_user","");
define("smtp_password","");
?>

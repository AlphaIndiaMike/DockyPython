<?php
date_default_timezone_set("Europe/Bucharest");
//SETUP MASTERPAGE
define("masterpage","global/masterpage.php");
//SETUP SERVER ADDRESS, USERNAME, PASSWORD
$conn = mysql_connect('mariadb', 'root', 'root_password');
//SETUP DATABASE    
function db_name() {return 'revox';}
//SETUP DATABASE 
//SETUP MAIL
define("site_mail_address", 'site@revox-systems.ro');
define("default_recipient", 'dash@revox-systems.ro');
//define("admin_recipient", '');
//SETUP MAIL
//SETUP DIRECTORY PATH
define("php_extension",".html");
define("url_rewriting",false);
define("number_of_directories",1);
define("domeniu","http://localhost/");
//1 if is on root, 2 if is on one subdirectory, 3 two subdirs...
//SETUP DEFAULT LANGUAGE
define("default_lang","ro")
?>

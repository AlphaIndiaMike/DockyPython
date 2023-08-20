<?php 


if (check_table("partners")==false){
    $query_db=mysql_query("CREATE TABLE partners (id INT auto_increment primary key, name TEXT, mail VARCHAR(255), company VARCHAR(255),
    country VARCHAR(255), city VARCHAR(255),address TEXT, zip VARCHAR(255), phone VARCHAR(25), pass VARCHAR(255), active INT(1),
    lastSession VARCHAR(255), lastBrowser VARCHAR(255), lastOffer VARCHAR(255), activity INT(11));");
	if (!$query_db) {
    die('Invalid query: ' . mysql_error());}
}
function insert_partner($name,$mail,$company,$country,$city,$address,$zip,$phone,$pass){
    $query_db=mysql_query("INSERT INTO partners (id,name,mail,company,country,city,address,zip,phone,pass,active,lastSession,lastBrowser,
    lastOffer,activity) VALUES (NULL,'".mysql_real_escape_string($name)."','".mysql_real_escape_string($mail).
    "','".mysql_real_escape_string($company)."','".mysql_real_escape_string($country)."','".mysql_real_escape_string($city).
    "','".mysql_real_escape_string($address)."','".mysql_real_escape_string($zip)."','".mysql_real_escape_string($phone).
    "','".sha1(mysql_real_escape_string($pass))."',0,NULL,NULL,NULL,0);");
    if (!$query_db) {
    die('Invalid query: ' . mysql_error());}
}

?>
<?php

if (check_table("partners")==false){
    $query_db=mysql_query("CREATE TABLE partners (id INT auto_increment primary key, name TEXT, mail VARCHAR(255), company VARCHAR(255),
    country VARCHAR(255), city VARCHAR(255),address TEXT, zip VARCHAR(255), phone VARCHAR(25), pass VARCHAR(255), active INT(1),
    lastSession VARCHAR(255), lastBrowser VARCHAR(255), lastOffer VARCHAR(255), activity INT(11));");
	if (!$query_db) {
    die('Invalid query: ' . mysql_error());}
}

function get_loginInfo($mail){
    $query=mysql_query("SELECT * FROM partners WHERE mail='".mysql_real_escape_string($mail)."';");
	$row = mysql_fetch_array($query);
	return $row['pass'];
}

function update_session($mail,$active=null,$lastSession=null,$lastBrowser=null,$lastOffer=null,$activity=null)
{
    if ($active==null) $active=get_column("partners","mail='".mysql_real_escape_string($mail)."'","active");
    if ($lastSession==null) $lastSession=get_column("partners","mail='".mysql_real_escape_string($mail)."'","lastSession");
    if ($lastBrowser==null) $lastBrowser=get_column("partners","mail='".mysql_real_escape_string($mail)."'","lastBrowser");
    if ($lastOffer==null) $lastOffer=get_column("partners","mail='".mysql_real_escape_string($mail)."'","lastOffer");
    if ($activity==null) $activity=get_column("partners","mail='".mysql_real_escape_string($mail)."'","activity");
    
    mysql_query("UPDATE partners SET active=".mysql_real_escape_string($active).",
    lastSession='".mysql_real_escape_string($lastSession)."',lastBrowser='".mysql_real_escape_string($lastBrowser)."',
    lastOffer='".mysql_real_escape_string($lastOffer)."',activity=".mysql_real_escape_string($activity)."
    WHERE mail='".mysql_real_escape_string($mail)."';");
}

function update_info($mail,$name=null,$company=null,$country=null,$city=null,$address=null,$zip=null,$phone=null,$pass=null){
    if ($name==null) $name=get_column("partners","mail='".mysql_real_escape_string($mail)."'","name");
    if ($company==null) $company=get_column("partners","mail='".mysql_real_escape_string($mail)."'","company");
    if ($country==null) $country=get_column("partners","mail='".mysql_real_escape_string($mail)."'","country");
    if ($city==null) $city=get_column("partners","mail='".mysql_real_escape_string($mail)."'","city");
    if ($address==null) $address=get_column("partners","mail='".mysql_real_escape_string($mail)."'","address");
    if ($zip==null) $zip=get_column("partners","mail='".mysql_real_escape_string($mail)."'","zip");
    if ($phone==null) $phone=get_column("partners","mail='".mysql_real_escape_string($mail)."'","phone");
    if ($pass==null) $pass=get_column("partners","mail='".mysql_real_escape_string($mail)."'","pass");
    
    mysql_query("UPDATE partners SET name='".mysql_real_escape_string($name)."',
    company='".mysql_real_escape_string($company)."',country='".mysql_real_escape_string($country)."',
    city='".mysql_real_escape_string($city)."',address='".mysql_real_escape_string($address)."',
    zip='".mysql_real_escape_string($zip)."',phone='".mysql_real_escape_string($phone)."',pass='".sha1($pass)."'
    WHERE mail='".mysql_real_escape_string($mail)."';") or die(mysql_error());
}
?>
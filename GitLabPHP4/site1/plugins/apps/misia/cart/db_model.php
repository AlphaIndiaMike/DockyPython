<?php 
if (check_table("inquiry")==false){
    $query_db=mysql_query("CREATE TABLE inquiry (id INT auto_increment primary key, mail VARCHAR(255), cmd TEXT, remark TEXT, date VARCHAR(100), is_read int(1));");
	if (!$query_db) {
    die('Invalid query: ' . mysql_error());}
}

function new_inquiry($mail,$cmd,$remark){
    $date=date(DATE_RFC822);
    mysql_query("INSERT INTO inquiry (id,mail,cmd,remark,date,is_read) VALUES(NULL,'".mysql_real_escape_string($mail)."','".mysql_real_escape_string($cmd)."',
    '".mysql_real_escape_string($remark)."','".mysql_real_escape_string($date)."',0);");
}
?>
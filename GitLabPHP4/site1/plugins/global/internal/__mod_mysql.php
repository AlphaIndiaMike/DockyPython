<?php
include('__global_db_model.php');

function run_query($query,$utf8=true)
{
    if ($utf8==true)$query_db=mysql_query(to_utf8($query));
    else $query_db=mysql_query($query);
	if (!$query_db) {
    die('Invalid query: ' . mysql_error());
	}
}

function num_rows($table, $condition="1=1"){
		//echo "SELECT * FROM ".$table." WHERE ".$condition.";";
		$query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
		if ($query==null) return 0;
		return mysql_num_rows($query);	
}

function num_rowsq($query){
    //echo "SELECT * FROM ".$table." WHERE ".$condition.";";
    $q=mysql_query($query);
    if ($q==null) return 0;
    return mysql_num_rows($q);	
}
	
function opentb($table, $condition){
    $query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
    if(mysql_num_rows($query)==0) return 0;
    else return $query;		
}

function get_row($table, $condition){
	//echo "SELECT * FROM ".$table." WHERE ".$condition.";";
	$query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
	$row = mysql_fetch_array($query);
	return $row;
    //It will be used like $row["col_name"];
}

function get_row_assoc($table, $condition){
	//echo "SELECT * FROM ".$table." WHERE ".$condition.";";
	$query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
	$row = mysql_fetch_assoc($query);
	return $row;
    //It will be used like $row["col_name"];
}
	


?>

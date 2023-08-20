<?php
$db_name=db_name();
if (mysql_select_db($db_name)==false) run_query("CREATE DATABASE ".$db_name);
mysql_select_db($db_name);
function check_table($table)
{
	$q = mysql_query("SHOW TABLES"); 
    while ($r = mysql_fetch_array($q)) { $tables[] = $r[0]; } 
    mysql_free_result($q);
    if (!isset($tables)) return FALSE; 
    if (in_array($table, $tables)) { return TRUE; } 
    else { return FALSE; }
}

function get_column($table, $condition, $col)
{
	//echo "SELECT * FROM ".$table." WHERE ".$condition.";";
    $query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
	if ($query!=null){
        $row = mysql_fetch_assoc($query);
    	if (isset($row[$col])) 
            {//FILTERS
                $res=str_replace ("%%img:",'<img src="'.absolute_path().'plugins/global/images/',$row[$col]);
                $res=str_replace (":img%%",'" alt="img" />',$row[$col]);
                $res=str_replace ("%%imgurl:",absolute_path().'plugins/global/images/',$row[$col]);
                return $res; 
            }
        return "";
    }
    else echo "Eroare query: SELECT * FROM ".$table." WHERE ".$condition.";";
}

function get_result($table, $condition, $col)
{
	//echo "SELECT * FROM ".$table." WHERE ".$condition.";";
    $query=mysql_query("SELECT ".$col." FROM ".$table." WHERE ".$condition.";");
	if ($query!=null){
        $row = mysql_fetch_array($query);
    	return $row[0];
    }
    else echo "Eroare query: SELECT ".$col." FROM ".$table." WHERE ".$condition.";";
    return null;
}

//User track and count
if (check_table("st_visitors")==false){
    mysql_query("CREATE TABLE st_visitors(ID BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL, day VARCHAR(5) NOT NULL, month VARCHAR(5) 
    NOT NULL, year VARCHAR(5) NOT NULL, Client VARCHAR(255), MSG VARCHAR(10) NOT NULL, ip VARCHAR(100), index_d INT);");
}
if (check_table("st_user_online")==false){				
    mysql_query("CREATE TABLE st_user_online(ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL, ipaddress VARCHAR(100), 
    lastactive VARCHAR(40), page VARCHAR(255), islogged VARCHAR(100));");
}	

function count_visit(){
if (!isset($_SESSION["visit"])||$_SESSION["visit"]=="")
	{
		$t = num_rows("st_visitors","1=1");
		$d = get_column("st_visitors","ID=".$t."","day");
		$i = get_column("st_visitors","ID=".$t."","index_d");
		//day count for window1 in stats cpanel
		if (date("d")!=$d){
			$_SESSION["visit"]='1';
			mysql_query("INSERT INTO st_visitors(day,month,year,client,msg,ip,index_d) VALUES (
			'".date("d")."','".date("m")."','".date("Y")."','".$_SERVER["HTTP_USER_AGENT"]."','0','".$_SERVER["REMOTE_ADDR"]."',".($i+1)."
			)");
		}else 
		{
			$_SESSION["visit"]='1';
			mysql_query("INSERT INTO visitors(day,month,year,client,msg,ip,index_d) VALUES (
			'".date("d")."','".date("m")."','".date("Y")."','".$_SERVER["HTTP_USER_AGENT"]."','0','".$_SERVER["REMOTE_ADDR"]."',".($i)."
			)");
			
		}			
	}
}	

function user_online(){
	// Have they visited before?
    $query=mysql_query("SELECT * FROM st_user_online WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "';");
	if(mysql_num_rows($query) != 0)
	{
      // Update last active time
    	 mysql_query("UPDATE st_user_online SET lastactive = " . time() . " WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");
    	 mysql_query("UPDATE st_user_online SET page = '".($_SERVER['SCRIPT_NAME'])."' WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");
    	 if (isset($_SESSION["S_ID"])&&$_SESSION["S_ID"]!="") mysql_query("UPDATE st_user_online SET islogged = '".$_SESSION["S_ID"]."' WHERE ipaddress = '" . $_SERVER['REMOTE_ADDR'] . "'");
	}
	else
	{
      // They have not visited before, Insert new row
      mysql_query("INSERT INTO st_user_online(ipaddress,lastactive,page,islogged) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', " .time(). ",'".($_SERVER['SCRIPT_NAME'])."','')");
	}
	// Delete any old records (where lastactive < NOW - 5 Mins)
	mysql_query("DELETE FROM st_user_online WHERE lastactive < " . (time() - 300));
}

function mark_as_read($id){
    mysql_query("UPDATE inquiry SET is_read=1 WHERE id=".$id.";");
}



?>
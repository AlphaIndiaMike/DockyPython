<?php
session_start();
if (!isset($_SESSION["S_ID"])) header('location: about:blank');
include('../../plugins/settings.php');
include('../../plugins/global/internal/__mod_mysql.php');


	
function sqlvalue($table, $condition, $col)
{
	$query=mysql_query("SELECT * FROM ".$table." WHERE ".$condition.";");
	$row = mysql_fetch_array($query);
	return $row[$col];
}


if ($_SESSION["S_ID"]!=null){

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head> ';
    if ($_GET["info"]=="1")
    {
    	
    	echo "<title>Log-ul vizitelor pe site</title>";
    }
    elseif ($_GET["info"]=="2")
    {
    	echo "<title>Log-ul mesajelor trimise de pe site</title>";
    	
    }
    elseif ($_GET["info"]=="3")
    {
    	echo "<title>Paginile vizitate in acest moment</title>";
    	
    }
    elseif ($_GET["info"]=="moder"){
    	echo "<title>Log moderare</title>";
    }
    else 
    {
    	echo "<title>Utilizatori logati pe site in acest moment</title>";
    }
?>

<?php 
echo '

	</head>
	
<body style="font-family:Arial;">

	    <center>
    <div style="width:100%;">';
         if ($_GET["info"]=="1")
    {
    	
    	echo "<h2>Visit log</h2>";
    }
    elseif ($_GET["info"]=="2")
    {
    	echo "<h2>Message Log</h2>";
    	
    }
    elseif ($_GET["info"]=="3")
    {
    	echo "<h2>Pages visited in this moment</h2>";
    	
    }elseif ($_GET["info"]=="moder"){
    	echo "<title>Log moderare</title>";
    }
    else 
    {
    	echo "<h2>Registered partners</h2>";
    }
 echo'</div></center>
    <center>
    <table style="width:100%; font-family:Verdana; font-size:10pt;" border="1">';
 	 if ($_GET["info"]=="1")
    {
    	echo '<tr>
            <th>
                Nr. Crt.
            </th>
            <th>
                Browser
            </th>
            <th>
                Ip address
            </th>
            <th>
                Visit date
            </th>
        </tr>
        ';
    		$c=0;
    	 $result = mysql_query("SELECT * FROM st_visitors;");
		 if (mysql_num_rows($result)==0)echo 'err';
				    else {
					    while ($row=mysql_fetch_array($result))
					    	{
    		$c=$c+1;
    		
    		echo '
    		<tr>
            <td>
            	'.$c.'
            </td>
            <td>
            	'.$row["Client"].'
            </td>
            <td>
            	'.$row["ip"].'
            </td>
            <td>
            	'.$row["day"].'/'.$row["month"].'/'.$row["year"].'
            </td>
       	    </tr>
    		';
    		
    	}}
    }
    elseif ($_GET["info"]=="2")
    {
    	echo '<tr>
            <th>
                Nr. Crt.
            </th>
            <th>
                Browser
            </th>
            <th>
                Mesaje Trimise
            </th>
            <th>
                Data vizita
            </th>
        </tr>
        ';
    	 $result = mysql_query("SELECT * FROM st_visitors WHERE MSG<>0;");
		 if (mysql_num_rows($result)==0)echo 'Nu sunt mesaje trimise de pe site!';
				    else {
					    while ($row=mysql_fetch_array($result))
					    	{
    		$c=$c+1;
    		$row=opentb("visitors","MSG <> '0'");
    		echo '
    		<tr>
            <td>
            	'.$c.'
            </td>
            <td>
            	'.$row["Client"].'
            </td>
            <td>
            	'.$row["MSG"].'
            </td>
            <td>
            	'.$row["day"].'/'.$row["month"].'/'.$row["year"].'
            </td>
       	    </tr>
    		';
    		
    	}}
    	
    }
    elseif ($_GET["info"]=="3")
    {
    	echo '<tr>
            <th>
                Nr. Crt.
            </th>
            <th>
                Adresa de ip
            </th>
            <th>
                Pagina
            </th>
        </tr>
        ';
    	$c=0;
    	$result = mysql_query("SELECT * FROM st_user_online;");
    	if (mysql_num_rows($result)==0)echo 'Nu sunt persoane!';
		else {
    	while ($row=mysql_fetch_array($result))
    	
    	{
    		$c=$c+1;
    		
    		echo '
    		<tr>
            <td>
            	'.$c.'
            </td>
            <td>
            	'.$row["ipaddress"].'
            </td>
            <td>
            	'.$row["page"].'
            </td>

       	    </tr>
    		';
    	
    	}}
    	
    }elseif ($_GET["info"]=="moder"){
    echo '<tr>
            <th>
                Nr.<br/> Crt.
            </th>
            <th>
                Legatura
            </th>
            <th>
                Statut
            </th>
            <th>
                Autorizatie
            </th>
            <th>
                Data publicare
            </th>
            <th>
                Restanta
            </th>
            <th>
                Categorie
            </th>
        </tr>
        ';
    	$c=0;
    	$result = mysql_query("SELECT page,accept,reject,auth,data,pay,categorie FROM moderation;");
    	if (mysql_num_rows($result)==0)echo 'Nu sunt intrari!';
		else {
    	while ($row=mysql_fetch_array($result))
    	
    	{
    		$c=$c+1;
    		
    		echo '
    		<tr>
            <td>
            	'.$c.'
            </td>
            <td>';
    			if ($row["categorie"]==1)
    				echo '<a style="cursor:pointer; color:blue;" onclick='.'"'."window.open('../../../".$row["page"]."','mywindow2','width=1020,height=550,top=50,left=70,scrollbars=yes,resizable=no,toolbar=no,directories=no,status=no,menubar=no,screenX=0,screenY=0')".'"'.'>'.$row["page"].'</a>';
    			if ($row["categorie"]==2)	
    				echo '<a style="cursor:pointer; color:blue;" onclick='.'"'."window.open('../../../produse.php?detail=".$row["page"]."','mywindow2','width=1020,height=550,top=50,left=70,scrollbars=yes,resizable=no,toolbar=no,directories=no,status=no,menubar=no,screenX=0,screenY=0')".'"'.'>Produse</a>';
    			else if ($row["categorie"]==3) echo '<a style="cursor:pointer; color:blue;" onclick='.'"'."window.open('../../../imagini/".$row["page"]."','mywindow2','width=1020,height=550,top=50,left=70,scrollbars=yes,resizable=no,toolbar=no,directories=no,status=no,menubar=no,screenX=0,screenY=0')".'"'.'>'.$row["page"].'</a>';
            echo '</td>
            <td>
            	'; if($row["accept"]!="") echo "Acceptat in data ".$row["accept"]; else if($row["reject"]!="") echo 'Respins pe motiv: '.$row["reject"]; else echo "In asteptare"; 
    		echo '
            </td>
			<td>';
    			if ($row["auth"]!="") echo $row["auth"]; else "Nu exista autorizatie de publicare";
    		echo '
            </td>
             <td>
            	'.$row["data"].'
            </td>
            <td>';
    			if ($row["pay"]!="") echo "Achitat"; else { if ($row["categorie"]==1) echo "14 EURO"; else if ($row["categorie"]==2) echo '1,8 EURO'; else if ($row["categorie"]==3) echo '7 EURO';}
    		echo '
       	    
       	    <td>';
    			if ($row["categorie"]==1) echo "Articol"; else if ($row["categorie"]==2) echo 'Produs'; else if ($row["categorie"]==3) echo 'Imagine	';
    		echo '
            </td></tr>
    		';
    	
    	}}
    }
    else 
    {
    	echo '<tr>
            <th>
                No.
            </th>
            <th>
                Contact Name
            </th>
            <th>
                Company/Country
            </th>
            <th>
                Phone
            </th>
            <th>
            	E-mail
            </th>
            <th>
                Activity
            </th>
        </tr>
        ';
    	$c=0;
    	$result = mysql_query("SELECT * FROM partners;");
    	if (mysql_num_rows($result)==0)echo 'Nu sunt persoane!';
		else {
    	while ($row=mysql_fetch_array($result))
    	{
    		$c=$c+1;
    		echo '
    		<tr>
            <td>
            	'.$c.'
            </td>
            <td>
            	'.$row["name"].'
            </td>
            <td>
            	'.$row["company"].' from '.$row["country"].'
            </td>
            <td>
            	'.$row["phone"].'
            </td>
            <td>
            	'.$row["mail"].'
            </td>
            <td>
            	'.$row["activity"].'
            </td>
       	    </tr>
    		';
    		
    	}}
    }
        
        
  echo '  </table>
    </center>
</body>
</html>

';
}
else 
{
	echo '<h1>Error 404 - PAGE NOT FOUND!</h1>';
}
?>

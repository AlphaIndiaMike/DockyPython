<?php 
session_start();
if (!isset($_SESSION["S_ID"])) header('location: about:blank');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>
	 <?php 
	 if (isset($_GET["close"]))
	 {
	 	$ik=1;
	 }
	 
     include('../../plugins/settings.php');
	 include('../../plugins/global/internal/__mod_mysql.php');	
	 $i=0; $content='';
	 	if (isset($_GET["purpose"])&&$_GET["purpose"]!="")
	 	{
	 		if ($_GET["purpose"]=="usr") $i=1;
	 		if ($_GET["purpose"]=="inbox") $i=2;
	 		if ($_GET["purpose"]=="offer") $i=3;
	 		if ($_GET["purpose"]=="partner") $i=4;
	 		if ($_GET["purpose"]=="newsletter") $i=5;
	 		
						switch($i)
						{
							case 1: {$title= 'User info'; echo $title;
							
								 $atr = get_column("s_db", "id=".$_GET[$_GET["purpose"]]."", "atribute");
				        		 switch ($atr)
				        		 {
				        		 	case 0: { $rights_txt_ro = " Nivel 0 (Drepturi depline)"; $rights_txt_en = "Level 0 (Full rights)";}; break;
				        		 	case 1: { $rights_txt_ro = " Nivel 1 (Editor si administrator)"; $rights_txt_en = "Level 1 (Editor and administrator)";}; break;
				        		 	case 2: { $rights_txt_ro = " Nivel 2 (Editor)"; $rights_txt_en = "Level 2 (Editor)";}; break;
				        		 	case 3: { $rights_txt_ro = " Nivel 3 (Editor, administrator si administrator relatii cu publicul)"; $rights_txt_en = "Level 3 (Editor, administrator and Public relations administrator)";}; break;
				        		 	case 4: { $rights_txt_ro = " Nivel 4 (Editor si administrator relatii cu publicul)"; $rights_txt_en = "Level 4 (Editor and Public relations administrator)";}; break;
				        		 	case 5: { $rights_txt_ro = " Nivel 5 (Public relations administrator)"; $rights_txt_en = "Level 5 (Public relations administrator)";}; break;
				        		 	case 6: { $rights_txt_ro = " Nivel 6 (Supervizor)"; $rights_txt_en = "Level 6 (Supervisor)";}; break;
				        		 }
								
								$content='<p>';
								$content.='<strong><a class="content2">'.get_column("s_db","id=".$_GET[$_GET["purpose"]],"NUME")." ".get_column("s_db","id=".$_GET[$_GET["purpose"]],"PRENUME").'</a></strong>'."<br/>";
								$content.='Position: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"FUNCTIE").'<br/>';
								$content.='Last access date: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"DATA_ACCESARII").'<br/>';
								$content.='Phone: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"TEL").'<br/>';
								$content.='Mail: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"MAIL").'<br/>';
								$content.='Username: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"u_name").'<br/>';
								$content.='Creation date: '.get_column("s_db","id=".$_GET[$_GET["purpose"]],"CREATION_DATE").'<br/><br/>';
								$content.='Rights: '.$rights_txt_en.'<br/>';
								$content.='</p>';
							
								};break;
							case 2: {$title= get_column("c_received","ID=".$_GET[$_GET["purpose"]],"dt"); echo $title;
								$content='<p>'.get_column("c_received","ID=".$_GET[$_GET["purpose"]],"content").'</p><br/>';
								mysql_query("UPDATE c_received SET is_read=1 WHERE ID=".$_GET[$_GET["purpose"]].";");
								
							};break;
							case 3: {
							     $row__=get_row("inquiry","id=".$_GET[$_GET["purpose"]]);
		    	                 $title= 'Price quotation request no. '.$_GET[$_GET["purpose"]]; echo $title;
							     $content.=$row__["cmd"];
                                 $content.='<p><h3>Remarks:</h3>'.$row__["remark"].'</p>';
                                 mark_as_read($_GET[$_GET["purpose"]]);
							};break;
							case 4: {
								$title= 'Partner info '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"mail"); echo $title;
								$content='<p>';
								$content.='<strong>'.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"NUME")." ".get_column("c_client","ID=".$_GET[$_GET["purpose"]],"PRENUME").'</strong>'."<br/>";
								$content.='Company: '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"COMPANIE")."<br/>";
								$content.='Position: '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"FUNCTIE").'<br/>';
								$content.='Phone(1): '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"tel1").'<br/>';
								$content.='Phone(2): '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"tel2").'<br/>';
								$content.='Mail: '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"mail").'<br/>';
								$content.='Company address: '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"adr_").'<br/>';
								$content.='Registration date: '.get_column("c_client","ID=".$_GET[$_GET["purpose"]],"creation").'<br/>';
								$content.='</p>';
							};break;
							case 5: {
								$title= ''.get_column("c_newsletter","ID=".$_GET[$_GET["purpose"]],"MAIL"); echo $title;
								$content='<p>';
								$content.='E-mail: '.get_column("c_newsletter","ID=".$_GET[$_GET["purpose"]],"MAIL").'<br/>';
								$content.='Registration date: '.get_column("c_newsletter","ID=".$_GET[$_GET["purpose"]],"date_subscribed").'<br/>';
								$content.='Status: (0-inactive,1-active) '.get_column("c_newsletter","ID=".$_GET[$_GET["purpose"]],"is_Valid").'<br/>';
								$content.='</p>';
							};break;
							
						}
						
					
				
						
		}
			
	 	
					
		
					
		
	
			    	?>
	</title>
	<style type="text/css">
	
	
	.header_title1
	{
		cursor:default;
		font-size:12pt;
		color:#2c649c;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
	}
	
	.header_title2
	{
		cursor:default;
		font-size:12pt;
		color:#2c649c;
		font-family:FBT, Tw Cen MT, Sans-Serif, Arial;
		font-weight:bold;
	}
	
	.header_title4
	{
		cursor:default;
		font-size:14pt;
		color:Black;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
		margin:0px 5px 5px 10px;
	}
	
	.content1
	{
		cursor:default;
		font-size:10pt;
		color:#424142;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;

	}
	
	.content2
	{
		cursor:default;
		font-size:10pt;
		color:#193657;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;

	}
	
	
	/*SPC2-3 WINDOW DESIGN */
    
    .line_one
    {
    	float:left; height:100%; width:24%; background-attachment:scroll; background-color:#004083;
    }
    
    .line_two
    {
    	float:left; height:100%; width:24%; background-attachment:scroll; background-color:#f9b61f;
    }
    
    .line_three
    {
    	float:left; height:100%; width:52%; background-attachment:scroll; background-color:Gray;
    }
    
    .button_submit
    {
    	cursor:default;
    	color:#de0d0d;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
		font-size:11pt; text-decoration:none;  cursor:pointer;
    }
    
    .form_submit
    {
    	border:none; background-color:Transparent; background-attachment:scroll; font-size:10pt; text-decoration:none; cursor:pointer;
        color:#de0d0d;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
    }
    
    .button_large
    {
    	font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
    	border:none; 
    	background-color:Transparent;
    	background-attachment:scroll; 
    	font-size:12pt; 
    	text-decoration:none; 
    	color:#de0d0d; 
    	cursor:pointer;
    }
    .high_light1
    {
    	font-size:11pt;
    	font-weight:bold;
    	color:Black;
    	font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
    	text-decoration:none; cursor:default;
    }
    /*END SPC2-3 WINDOW DESIGN */
    /* LIST DESIGN */
    
    .list_item
    {
    	width:100%;
    	height:22px;
    }
    
    .list_text
    {
    	cursor:default;
		font-size:12pt;
		color:#2c649c;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
    	margin:5px 5px 5px 5px; color:Black; text-decoration:none; cursor:pointer;
    }
       
    	.header_title3
	{
		cursor:default;
		font-size:14pt;
		color:#2c649c;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
        height: 82px;
    }
    .path
    {
    	border:none; background-color:Transparent; background-attachment:scroll; font-size:10pt; text-decoration:none; cursor:pointer;
        color:#2c649c;
		font-family:FLBT, Tw Cen MT, Sans-Serif, Arial;
    }
    /*LIST DESIGN */
 
</style>
</head>
<body>
<?php
if (isset($i)){ 
if ($i==2||$i==3)
{
	echo '<div style="width:880px; height:auto;">';
}
else
echo '<div style="width:480px; height:auto;">';
}
else
{
	echo '<div style="width:480px; height:auto;">';
}
?>

			<div>
			    <div class="header_title4">
			    
			       <?php 
			       echo $title;
				 	?>
			    </div>
			  
			   
			    <div style="width:100%; height:5px;">
					        <div class="line_one" style="float:left; height:100%; width:24%; background-attachment:scroll;">
                                &nbsp;</div>
					        <div class="line_two" style="float:left; height:100%; width:24%; background-attachment:scroll;">
                                &nbsp;</div>
					        <div class="line_three" style="float:left; height:100%; width:52%; background-attachment:scroll;">
                                &nbsp;</div>
			   </div>
			   
			   
			  
			   <div class="content1" style="width:98%; height:auto; float:left; margin-top:10px; margin-left:10px; margin-bottom:10px;">
                	<?php echo str_replace("\\n\\r","",$content);?>	
               </div>	 
			   
			  <div style="width:100%; height:5px;">
					            <div class="line_one" style="opacity:0.6;filter:alpha(opacity=60);float:left; height:100%; width:24%; background-attachment:scroll;">
                                    &nbsp;</div>
					            <div class="line_two" style="opacity:0.6;filter:alpha(opacity=60);float:left; height:100%; width:24%; background-attachment:scroll;">
                                    &nbsp;</div>
					            <div class="line_three" style="opacity:0.6;filter:alpha(opacity=60);float:left; height:100%; width:52%; background-attachment:scroll;">
                                    &nbsp;</div>
			  </div>
			  
			
			</div>   
</div>
		<?php 
					if (isset($ik)&&$ik==1)
					{
					if ((isset( $_GET ["lang"] ) == true) && ($_GET ["lang"] == "en"))
										{
												echo '<script type="text/javascript" language="javascript">
                  							
                  								window.close();
												if (window.opener && !window.opener.closed) {
												window.opener.location.reload();
												}
                  						</script>';
										}
										else
										{
												echo '<script type="text/javascript" language="javascript">
                  							
                  								window.close();
												if (window.opener && !window.opener.closed) {
												window.opener.location.reload();
												}
                  						</script>';
										}
					}
				?>
			
</body>
</html>

<?php 
include('db_model.php');
function show_cart(){
    $body='';
    $body.=' 
<div id="content_spc1">
<div class="header_title4">
Selected products for the price quotation
 </div>
			   <div id="list_main">'; 
	//number divisions
	if (isset($_SESSION["p_num"]))
	{
	   if ($_SESSION["p_num"]>15) $div=$_SESSION["p_num"]/15;
				else $div=0;
				$start=0; $end=15;
			if (!isset($_GET["display"])) { $start=0; $end=15;}		
				   		else {
				   			if ($_GET["display"]<=($div+1))
				   			{
				   				$start=($_GET["display"]-1)*15;
				   				$end=(($_GET["display"]-1)*15)+15;
				   			}
				   		
                        }
        if ($_SESSION["p_num"]=="0") {$body.='<p class="blue_text">&nbsp;No articles selected.</p>';}
        for ($i=$start; $i<$_SESSION["p_num"]&&$i<$end; $i++)
			{
							if (isset($_SESSION["cart"][$i])&&$_SESSION["cart"][$i]!=""){
									$body.='<div onmouseover="this.style.backgroundColor='."'".'#eee'."'".';" onmouseout="this.style.backgroundColor='."'".'transparent'."'".';" class="list_item_ck">
							            <div style="width:450px; float:left;">
							                <a href="#" class="list_text">'.($i+1).'. '; if (isset($_SESSION["cart_name"][$i])) $body.=$_SESSION["cart_name"][$i]; else $body.=$_SESSION["cart"][$i]; $body.='</a>
							            </div>
							            <div style="width:450px; float:left;">
							                <div style="width:180px; height:100%; float:left;">
							                    <form method="post" action="?q='.$i; if (isset($_GET["display"])) $body.= '&display='.$_GET["display"].''; $body.= '">
                                                <div class="display_inline">
							                             <a class="form_submit" style="cursor:default; color:Black">Quantity:&nbsp;</a>
                                                </div>
                                                <div class="display_inline">';
                                                     $body.= '<input type="text" maxlength="10" value="';if (isset($_SESSION["quantity"][$i])) $body.=$_SESSION["quantity"][$i]; else $body.='1'; $body.='" style="width:25px; border:solid 1px Gray;" id="q_num'.$i.'" name="q_num'.$i.'" class="form_submit" />';
                                                     $body.= '
                                                </div>
		                                        <div class="display_inline"> 
                                                    <input type="submit" class="form_submit"
    						                        onmouseover="this.style.textDecoration = '."'".'underline'."'".';" 
                                                    onmouseout="this.style.textDecoration = '."'".'none'."'".';" value="Save"/>
								  			    </div>
					                           </form>
					                       </div>
                                           <div style="width:220px; height:100%; float:left;">
							                    <form method="post" action="?set_id='.$i; if (isset($_GET["display"])) $body.= '&display='.$_GET["display"].''; $body.= '">
                                                <div class="display_inline">
							                             <a class="form_submit" style="cursor:default; color:Black">Crane ID:&nbsp;</a>
                                                </div>
                                                <div class="display_inline">';
                                                     $body.= '<input type="text" maxlength="10" value="';if (isset($_SESSION["set_id"][$i])&&check_string($_SESSION["set_id"][$i])==true) $body.=$_SESSION["set_id"][$i]; else $unknown_part='ok'; $body.='" style="width:50px; border:solid 1px Gray;" id="id_num'.$i.'" name="id_num'.$i.'" class="form_submit" />';
                                                     $body.= '
                                                </div>
		                                        <div class="display_inline"> 
                                                    <input type="submit" class="form_submit"
    						                        onmouseover="this.style.textDecoration = '."'".'underline'."'".';" 
                                                    onmouseout="this.style.textDecoration = '."'".'none'."'".';" value="Save"/>
								  			    </div>
					                           </form>
					                       </div>
                                            <div style="width:40px; height:100%; float:left; padding-top:4px;">
						                      <a href="?'; $body.= 'checkout=1&del_pr='.$i; if (isset($_GET["display"])) $body.= '&display='.$_GET["display"].''; $body.= '" class="form_submit"
						                      onmouseover="this.style.textDecoration = '."'".'underline'."'".';" onmouseout="this.style.textDecoration = '."'".'none'."'".';">
								                Delete</a>
                                              </div>
						              </div>
						        </div>';
								}
							}
			   		}
			   		else
			   		{
			   			$body.= '<p class="content1">&nbsp;No articles selected.</p>';
			   		}
                 
			    $body .='</div>';
			    	if (isset($div)&&$div>0){
			    	$body.= '<div style="text-align:center; width:730px; margin:5px 0px 10px 0px;">';
			    		for ($ik=1; $ik<=$div+1; $ik++)
			    		{
			    			if (isset($_GET["lang"]))
			    			$body.= ' <a href="?lang='.$_GET["lang"].'&checkout=1&display='.$ik.'" class="form_submit">'.$ik.'</a>&nbsp;';
			    			else
			    			$body.= ' <a href="?checkout=1&display='.$ik.'" class="form_submit">'.$ik.'</a>&nbsp;';
			    		}
			    	
			    	$body.= ' </div>';
			    	}
			     
   $body.='
        <script type="text/javascript" src="'.get_js('jquery-1.10.2.js').'"></script>
		<script type="text/javascript" src="'.get_js('jquery-impromptu.js').'"></script>
		<script type="text/javascript" src="'.get_js('common.js').'"></script>
        <link rel="stylesheet" media="all" type="text/css" href="'.get_css('examples.css').'" />'."\n";
        
			      $body.='
                    <div style="text-align:right; width:920px;">
			            <a href="'.home_page().'" class="button_large" style="color:#de0d0d;" onmouseover="this.style.color='."'".'#2c649c'."'".';" onmouseout="this.style.color='."'".'#de0d0d'."'".';">
					         Back Home
                        </a>';
			       if (isset($_SESSION["p_num"])&&$_SESSION["p_num"]!=0){$body.='<a class="button_large" style="color:#de0d0d; cursor:pointer;" onmouseover="this.style.color='."'".'#2c649c'."'".';" onmouseout="this.style.color='."'".'#de0d0d'."'".';"';
                        if (isset($_SESSION["S_ID"])) $body.='onclick="$.prompt('."'".'<br/>You cannot request an offer as Administrator!<br/>'."'".')"';
                        else if (isset($unknown_part)) $body.='onclick="$.prompt(write_form(),{ buttons: { Continue: true, Cancel: false },callback: callbackform })"';
                        else $body.='href="'.href("proceed.html",false).'" ';
                   $body.='>
			            	<b>Request price quotation</b>
                        </a>';}
			   $body.='</div></div>';
    return $body;
}

function send_cmd()
{
    $body='';
    if (!isset($_SESSION["C_ID"])){
        //Aici cere login-ul
        $body.=login_form3();
        $_SESSION["create_user"]=1;
    }
    else 
    if (isset($_GET["proceed"])&&isset($_POST["remark"])&&$_POST["remark"]!="")
        {
            $m=$_SESSION["C_ID"]; if (isset($_POST["remark"])) $rem=mysql_real_escape_string($_POST["remark"]); else $rem='No remark!'; 
            $cmd='';
            //....
            if ($m!="GuestEmail"){
                $row=get_row("partners","mail='".$m."'");
                $cmd.='<p>From: '.$m.'</p>';
            }else $cmd.='<p>From: '.$_SESSION["GuestInfo"][0].'</p>';
            //....
            $cmd.='<p>To: spare@misia.com</p>'.
            '<p>Date: '.date(DATE_RFC822).'</p>';//get_row($table, $condition, $col)
            //....
            if ($m!="GuestEmail"){
            $cmd.='<p>Subject: Web Spare Quotation request from '.$row["company"].'</p>';
            }
            else $cmd.='<p>Subject: Web Spare Quotation request from '.$_SESSION["GuestInfo"][3].'</p>';
            //....
            for ($i=0; $i<$_SESSION["p_num"]; $i++)
            {
                if (isset($_SESSION["quantity"][$i])&&$_SESSION["quantity"][$i]!="") $q=$_SESSION["quantity"][$i]; else $q=1;
                $cmd.='<p>Needed spare: Hoist id#: <b>'.$_SESSION["set_id"][$i].'</b> , Catalog identification: <b>'.$_SESSION["cart"][$i].'</b>, Name: <b> '.$_SESSION["cart_name"][$i].'</b><br/>
                Quantity of units needed: '.$q.'</p>';
                
                unset($_SESSION["cart"][$i]);
                unset($_SESSION["cart_name"][$i]);
                unset($_SESSION["set_id"][$i]);
                unset($_SESSION["quantity"][$i]);
                
            }
            if ($m!="GuestEmail"){
                $cmd.='<p><b>Client identification</b></p>'.
                '<p>Contact person: '.$row["name"].'</p>'.
                '<p>Email: '.$row["mail"].'</p>'.
                '<p>Company: '.$row["company"].'</p>'.
                '<p>Country: '.$row["country"].'</p>'.
                '<p>City: '.$row["city"].'</p>'.
                '<p>Address: '.$row["address"].'</p>'.
                '<p>ZIP: '.$row["zip"].'</p>'.
                '<p>Phone: '.$row["phone"].'</p>';
            }
            else{
                $cmd.='<p><b>Client identification</b></p>'.
                '<p>Contact person: '. $_SESSION["GuestInfo"][0].'</p>'.
                '<p>Email: '. $_SESSION["GuestInfo"][1].'</p>'.
                '<p>Company: '. $_SESSION["GuestInfo"][3].'</p>'.
                '<p>Country: '. $_SESSION["GuestInfo"][2].'</p>';
            }
        unset($_SESSION["p_num"]);  unset($_SESSION["create_user"]);
        if ($m=="GuestEmail") $m=$_SESSION["GuestInfo"][0];
        new_inquiry($m,$cmd,$rem);
        mail_it('<html><body>'.$cmd.'<p><b>Remark</b></p><p>'.$rem.'</p>'.'</body></html>',"Inquiry sent from misiaspare.ro");  
        $body.='<div class="featurebox_center">
            <img src="'.get_image('active.png').'" alt="ok" style="padding:2px;"/><a style="position:relative; cursor:default; top:-4px;">Thank you for the request. Our technical team is making all efforts to answer with a quote soonest possible. 
            </a>
        </div>';}
    else{
        $body.=import_mce().'
            <script type="text/javascript">
            //<![CDATA[ 
                   tinyMCE.init({
                        // General options
                        mode : "textareas",
                        theme : "simple"
                });   
            //]]>        
            </script>
        <form method="post" id="RemarksForm" style="position:relative; top:-80px; height:100px; padding:40px; font-family:sans-serif, Arial;" class="blue_text" action="?proceed=final">
        <div>
				<label for="message" class="formLabel">Remarks regarding requested parts:</label>
				<textarea style="border:solid 1px #555; width:900px; height:200px; color:black;" " id="remark" name="remark" cols="50" rows="2">
                '; if (isset($_POST["remark"])) $body.=$_POST["remark"]; $body.='
                </textarea>
                <span style="font-size:8pt; font-style:italic;">&nbsp;Remarks (free text) eg.: Hi MISIA, make sure that all pcs. are blue painted (mandatory)</span>
			<br/><br/>
            </div>';
            if (isset($_POST["remark"])&&$_POST["remark"]==""){
                $body.='<div class="std" style="color:red;">
                <i>Remarks field required!</i>
                </div>';}
            $body.='<div style="padding-left:20px;">
				<input id="send" name="send" class="send" type="submit" value="Proceed sending the request!" />
            </div>
        </form>
        
        ';
    }
    return $body;
}

			        

			    



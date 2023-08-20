<?php
include("db_model.php");
function validateName($name){
		//if it's NOT valid
		if(strlen($name) < 4)
			{return false;}
		//if it's valid
		else
			return true;
	}
function validateEmail($email){

		return (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)); 
         
	}
function validatePasswords($pass1, $pass2) {
		//if DOESN'T MATCH
		if(strpos($pass1, ' ') !== false)
			return false;
		//if are valid
		return $pass1 == $pass2 && strlen($pass1) > 5;
	}
function validateMessage($message){
		//if it's NOT valid
		if(strlen($message) < 10)
			return false;
		//if it's valid
		else
			return true;
	}
    
 function validateCaptcha($num)
 {
    if ($num!=11) return false;
    return true;
 }

function register_member()
{   
    if (return_random_tag("proceed")=="final") return '';
    $body='';
    function validGlobal(){
        if(validateName($_POST['name'])==false || validateName($_POST['tel'])==false || validateName($_POST['company'])==false
    || validateName($_POST['country'])==false|| validateName($_POST['city'])==false || validateEmail($_POST['email'])==true /*|| validateCaptcha($_POST['captcha'])==false*/
    || validatePasswords($_POST['pass1'], $_POST['pass2'])==false || validateMessage($_POST['address'])==false) return false;
    return true;
    }    
    
    if( isset($_POST['send']) && validGlobal()==false)
	{	$body.='<div id="error">
					<ul>';
                    
		    if(!validateName($_POST['name']))
				$body.='<li><strong>Invalid Name:</strong> Name may have more than 3 letters!</li>';
            /*if(!validateCaptcha($_POST['captcha']))
				$body.='<li><strong>Invalid Answer:</strong> Some fields are not completed corespondly!</li>';*/
            if(validateEmail($_POST['email']))
				$body.='<li><strong>Invalid E-mail:</strong> Type a valid e-mail please !</li>';
			if(!validatePasswords($_POST['pass1'], $_POST['pass2']))
				$body.='<li><strong>Passwords are invalid:</strong> Passwords doesn`t match or are invalid!</li>';
			if(!validateMessage($_POST['address']))
                $body.='<li><strong>Ivalid address:</strong> Type an address with at least with 10 letters</li>';
			$body.=	'</ul>
				</div>';
    }else if(isset($_POST['send'])){
		$body.=	'<div id="error" class="valid">
					<ul>
						<li><strong>Congratulations!</strong> All fields are OK </li>
					</ul>
				</div>
		';  
            insert_partner($_POST["name"],$_POST["email"],$_POST["company"],$_POST["country"],$_POST["city"],$_POST["address"],
            $_POST["zip"],$_POST["tel"],$_POST["pass2"]);
                $_SESSION["C_ID"]=$_POST["email"];
                $_SESSION["name"]=$_POST["name"];
                if (isset($_SESSION["create_user"])){
                    $body.='<script type="text/javascript">location.href="'.href("proceed.html").'";</script>';
                }else
                    $body.='<script type="text/javascript">location.href="'.href("default.html").'";</script>';
            
        
        }
    
    	$body.='<form method="post" id="customForm" style="height:650px;" action="?">
			<div>
				<label for="name">Name, Surname:</label>
				<input id="name" name="name" maxlength="150" type="text" '; if (isset($_POST["name"])) $body.='value="'.$_POST["name"].'"'; $body.=' />
				<span id="nameInfo">Please enter your name.</span>
			</div>
			<div>
				<label for="email">E-mail:</label>
				<input id="email" name="email" maxlength="150" type="text" '; if (isset($_POST["email"])) $body.='value="'.$_POST["email"].'"'; $body.='/>
				<span id="emailInfo">Type your e-mail address, you will need it to log in.</span>
			</div>
            <div>
				<label for="company">Company name:</label>
				<input id="company" name="company" maxlength="150" type="text" '; if (isset($_POST["company"])) $body.='value="'.$_POST["company"].'"'; $body.='/>
				<span id="companyinfo">Company`s name, it`s important for inquiries` validation.</span>
			</div>
            <div style="display:block; width:940px; height:50px;">
                <div style="display:inline; float:left; width:480px; height:50px;">
                 	<label for="country">Country:</label>
    				<input id="country" name="country" maxlength="150" type="text" '; if (isset($_POST["country"])) $body.='value="'.$_POST["country"].'"'; $body.='/>
    				<span id="countryinfo">Please insert your Country name.</span>
                </div>
                <div style="display:inline; float:left; width:450px; height:50px;">
               	    <label for="city">City:</label>
    				<input id="city" name="city" maxlength="150" type="text" '; if (isset($_POST["city"])) $body.='value="'.$_POST["city"].'"'; $body.=' />
    				<span id="cityinfo">Please insert your City name.</span>
                </div>
			</div>
            <div>
				<label for="address">Company`s address:</label>
				<textarea style="border:solid 1px #555; color:black;" id="address" name="address" cols="50" rows="2">
                '; if (isset($_POST["address"])) $body.=$_POST["address"]; $body.='
                </textarea>
			</div>
            <div>
				<label for="zip">ZIP Code:</label>
				<input id="zip" maxlength="150" name="zip" type="text" '; if (isset($_POST["zip"])) $body.='value="'.$_POST["zip"].'"'; $body.='/>
				<span id="zipinfo">Enter your ZIP Code (optional)</span>
			</div>
            <div>
				<label for="tel">Telephone:</label>
				<input id="tel" maxlength="21" name="tel" type="text" '; if (isset($_POST["tel"])) $body.='value="'.$_POST["tel"].'"'; $body.='/>
				<span id="telinfo">Please insert a valid phone number (international).</span>
			</div>
			<div>
				<label for="pass1">Password</label>
				<input id="pass1" name="pass1" maxlength="100" type="password" '; if (isset($_POST["pass1"])) $body.='value="'.$_POST["pass1"].'"'; $body.='/>
				<span id="pass1Info">At least 5 characters: letters, numbers and `_`</span>
			</div>
			<div>
				<label for="pass2">Confirm Password</label>
				<input id="pass2" name="pass2" maxlength="100" type="password" '; if (isset($_POST["pass2"])) $body.='value="'.$_POST["pass2"].'"'; $body.='/>
				<span id="pass2Info">Confirm password</span>
			</div>';
			 /*<div>
				<label for="captcha" style="font-weight:normal;">Captcha question 4+7=?</label>
				<input id="captcha" maxlength="10" name="captcha" type="text" />
				<span id="captchainfo">Please insert a valid answer for the question.</span>
			</div>*/
			$body.='<div style="">
				<input id="send" name="send" type="submit" value="Accept terms and conditions, Register!" />
			</div>
		</form>';
        $body.='
        <script type="text/javascript" src="'.get_js('jquery.js').'"></script>
    	<script type="text/javascript" src="'.get_js('validation.js').'"></script>
        ';
        return $body;
}

function register_quick()
{
    /*************************
    Change request -> proceed inquiry shortcut -> If redirect is from catalog then create user verification approval
    **************************/
    if (isset($_GET["add"])&&($_GET["add"]!="")&&isset($_GET["name"])&&($_GET["name"]!="")&&
        isset($_GET["uid"])&&($_GET["uid"]!="")&&isset($_GET["page_catalog"])&&($_GET["page_catalog"]!="")) {
        $_SESSION["create_user"]=1;
    }
    /*************************
    Shortcut change request by Marco Bettelli
    **************************/
    $body='';
    function validQuick(){
        if(validateName($_POST['name'])==false || validateName($_POST['company'])==false
        || validateName($_POST['country'])==false || validateEmail($_POST['email'])==true || 
        validateCaptcha($_POST['captcha'])==false) return false;
         return true;
    }    
    if( isset($_POST['send']) && validQuick()==false)
	{	$body.='<div id="error">
					<ul>'; 
		    if(!validateName($_POST['name']))
				$body.='<li><strong>Invalid Name:</strong> Name may have more than 3 letters!</li>';
            if(!validateCaptcha($_POST['captcha']))
				$body.='<li><strong>Invalid Answer:</strong> Some fields are not completed corespondly!</li>';
            if(validateEmail($_POST['email']))
				$body.='<li><strong>Invalid E-mail:</strong> Type a valid e-mail please !</li>';
			$body.=	'</ul>
				</div>';
    }else if(isset($_POST['send'])){
		$body.=	'<div id="error" class="valid">
					<ul>
						<li><strong>Congratulations!</strong> All fields are OK </li>
					</ul>
				</div>
		';  
                $_SESSION["C_ID"]="GuestEmail";
                $_SESSION["name"]="Guest";
                $_SESSION["GuestInfo"][0]=$_POST["name"];
                $_SESSION["GuestInfo"][1]=$_POST["email"];
                $_SESSION["GuestInfo"][2]=$_POST["country"];
                $_SESSION["GuestInfo"][3]=$_POST["company"];
                if (isset($_SESSION["create_user"])){
                    $body.='<script type="text/javascript">location.href="'.href("proceed.html").'";</script>';
                }else
                    $body.='<script type="text/javascript">location.href="'.href("default.html").'";</script>';
        }
    
    	$body.='<form method="post" id="customForm" style="height:200px;" action="?quick_register=1">
			<div>
				<label for="name">Name, Surname:</label>
				<input id="name" name="name" maxlength="150" type="text" '; if (isset($_POST["name"])) $body.='value="'.$_POST["name"].'"'; $body.=' />
				<span id="nameInfo">Please enter your name.</span>
			</div>
			<div>
				<label for="email">E-mail:</label>
				<input id="email" name="email" maxlength="150" type="text" '; if (isset($_POST["email"])) $body.='value="'.$_POST["email"].'"'; $body.='/>
				<span id="emailInfo">Type your e-mail address, you will need it to log in.</span>
			</div>
            <div>
				<label for="company">Company name:</label>
				<input id="company" name="company" maxlength="150" type="text" '; if (isset($_POST["company"])) $body.='value="'.$_POST["company"].'"'; $body.='/>
				<span id="companyinfo">Company`s name, it`s important for inquiries` validation.</span>
			</div>
            <div style="dsplay:block; width:940px; height:50px;">
                <div style="display:inline; float:left; width:480px; height:50px;">
                 	<label for="country">Country:</label>
    				<input id="country" name="country" maxlength="150" type="text" '; if (isset($_POST["country"])) $body.='value="'.$_POST["country"].'"'; $body.='/>
    				<span id="countryinfo">Please insert your Country name.</span>  
                 </div> 
            </div>';
			/* <div>
				<label for="captcha" style="font-weight:normal;">Captcha question 4+7=?</label>
				<input id="captcha" maxlength="10" name="captcha" type="text" />
				<span id="captchainfo">Please insert a valid answer for the question.</span>
			</div>*/
            $body.='<input type="hidden" value="11" name="captcha" id="captcha" />
			<div style="">
				<input id="send" name="send" type="submit" value="Continue sending inquiry!" />
			</div>
		</form>';
        $body.='
       <script type="text/javascript" src="'.get_js('jquery.js').'"></script>
    	<script type="text/javascript" src="'.get_js('validation.js').'"></script>
        ';
        return $body;
}

function admin_account(&$header)
{
    $header.=' 
    <script type="text/javascript" language="javascript" src="'.get_js('jquery-1.10.2.js').'"></script>
    <script type="text/javascript" src="'.get_js('jquery.mousewheel-3.0.4.pack.js').'"></script>
    <script type="text/javascript" src="'.get_js('jquery.fancybox-1.3.4.js').'"></script>
    <script type="text/javascript" src="'.get_js('jquery.easing-1.3.pack.js').'"></script>
    <link rel="stylesheet" type="text/css" href="'.get_css('fancybox/jquery.fancybox-1.3.4.css').'" media="screen" />';
    $body='    
    <script type="text/javascript" language="javascript">
        //<![CDATA[ 
     $(document).ready(function() {
        $("a[class=open_mail_]").fancybox({'."
            'width'                : 920,
            'height'            : 480,
            'autoScale'            : false,
            'transitionIn'        : 'none',
            'transitionOut'        : 'none',
            'type'                : 'iframe',
            'onClosed'    : function() {location.reload(true);}
       		 });
        ".'
         $("a[class=edit_comment]").fancybox({'."
            'width'                : 920,
            'height'            : 480,
            'autoScale'            : false,
            'transitionIn'        : 'none',
            'transitionOut'        : 'none',
            'type'                : 'iframe',
            //'onClosed'    : function() {location.reload(true);}
       		 });
        ".'
	    });
    //]]>  
    </script>';
     $body.='<div style="position:absolute; top:-100px; left:20px; width:350px; font-style:italic; font-size:9pt;" class="blue_text std">
            <b>Tips: </b>&nbsp;Access available statistics using buttons from top-right of the page.
            You can read offer requests (if available) from the list bellow.
        </div>'; 
        $body.='<div style="position:absolute; top:-115px; left:370px; width:560px; text-align:right; color:white;">';
        $body.= '
                <a href="'.'pop_up/1.php'.'?info=6" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image('users.png').'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.'pop_up/1.php'.'?info=6" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Registered partners</a>&nbsp;&nbsp;&nbsp;
                
                <a href="'.'pop_up/1.php'.'?info=3" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image('stats.png').'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.'pop_up/1.php'.'?info=3" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Users online</a>&nbsp;&nbsp;&nbsp;
                
                <a href="'.'pop_up/1.php'.'?info=1" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.get_image('log.png').'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.'pop_up/1.php'.'?info=1" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Visit log</a>
                
                ';
        $body.= '</div>';    
    $body.='<div id="content_spc1"><div class="header_title4">';
    if (isset($_GET["kontrole"])&&$_GET["kontrole"]!=""){
						$i=addslashes($_GET["kontrole"]);
                        mark_as_read($i);
    }
    $header.='
    <script type="text/javascript" src="'.get_js('jquery-impromptu.3.2.min.js').'"></script>
    <script type="text/javascript" src="'.get_js('common.js').'"></script>
    <link rel="stylesheet" media="all" type="text/css" href="'.get_css('examples.css').'" />'."\n";
	$body.='Price quotation requests	
    </div>
    <div id="list_main" style="margin:5px; width:930px; height:400px;">';      
    $increment=0;
    $sql_query = "SELECT id,mail,date,is_read FROM inquiry WHERE 1=1;";
	   $result = mysql_query($sql_query);
	   if ($result!=null){
	       $increment=0;
	       if(mysql_num_rows($result)){
				while($row = mysql_fetch_row($result))
				{
					$n[$increment]='Request from '.$row[1].' , sent: '.$row[2];
					$id[$increment]=$row[0];
					$ans[$increment]=$row[3];
					$increment+=1;
				}}}
	   // DISPLAY
	   if ($increment>20) $div=$increment/20;
	   else $div=0;
	   $start=0; $end=20;
  		if (!isset($_GET["display"])) { $start=0; $end=20;}		
  		else {
 			if ($_GET["display"]<=($div+1))
 			{
				$start=($_GET["display"]-1)*20;
				$end=(($_GET["display"]-1)*20)+20;
 			}
  		}
   	    if ($increment==0)$body.= '<p class="content1">&nbsp;No requests.</p>';
    
	   //DRAW LIST
	   for ($i=$start; $i<$increment&&$i<$end; $i++){
	       $body.='
		      <div onmouseover="this.style.backgroundColor='."'".'#eee'."'".';" onmouseout="this.style.backgroundColor='."'".'transparent'."'".';" class="list_item_ck">
                <div style="width:750px; height:100%; float:left; padding-left:5px; padding-top:4px;">
                    <a class="open_mail_" href='.'"'.'pop_up/open_mail.php'."?purpose=offer&amp;offer=".$id[$i]; $body.= '"'.'>'.$n[$i].'</a>
                </div>
                <div style="width:150px; height:100%; float:left;">
                    <div style="width:60px; height:100%; float:left;">
                        <div style="width:50px; height:100%; float:left; padding-left:5px; padding-top:4px;">
                            <a href="?kontrole='.$id[$i].''; if (isset($_GET["indicative"])) $body.= '&amp;indicative='.$_GET["indicative"]; if (isset($_GET["page"])) $body.= '&amp;page='.$_GET["page"]; $body.= '" class="form_submit"
                            onmouseover="this.style.textDecoration = '."'".'underline'."'".';" onmouseout="this.style.textDecoration = '."'".'none'."'".';">';
								if ($ans[$i]==0)$body.= 'Unread'; else $body.='Read';
				            $body.='</a>
                        </div>
                    </div>
                    <div style="width:40px; height:100%; float:left; padding-top:4px;">
                        <a class="delete_ct_" href="#" onclick="$.prompt(delete_form('."'".$id[$i]."'".'),{ buttons: { Continue: true, Cancel: false },callback: deleteCallback })" class="form_submit"
                        onmouseover="this.style.textDecoration = '."'".'underline'."'".';" onmouseout="this.style.textDecoration = '."'".'none'."'".';">'.
							'Delete</a></div></div></div>';
		}
        $body.='</div>';
        if ($div>0){
                
              if (isset($_GET["display"])) for ($x=0; $x<=(($i-(20*($_GET["display"]-1))))/4; $x++) $body.='<br/>';  
             
 	          $body.= '<div style="text-align:center; width:940px; margin:5px 0px 10px 0px;">';
		      for ($ik=1; $ik<=$div+1; $ik++){
			    		   $body.=' <a href="?';if(isset($_GET["indicative"])) $body.='indicative='.$_GET["indicative"].'&'; $body.= 'display='.$ik.'" class="form_submit">'.$ik.'</a>&nbsp;';
		      }
 	          $body.='</div>';}$body.='</div>';
    return $body;
}

function client_account(){
    $body='';
    $row=get_row("partners","mail='".$_SESSION["C_ID"]."'");
    if (isset($_GET["change_pass"])){
        if (isset($_POST["pass0"])&&$_POST["pass0"]!=""&&
            isset($_POST["pass1"])&&$_POST["pass1"]!=""&&
            isset($_POST["pass2"])&&$_POST["pass2"]!="") {
                if($row["pass"]!=SHA1($_POST["pass0"])) $er_msg='Invalid current password!';
                if($_POST["pass1"]!=$_POST["pass2"]) $er_msg='Passwords don`t match!';
                if (!isset($er_msg)) {update_info($_SESSION["C_ID"],null,null,null,null,null,null,null,$_POST["pass2"]); 
                    $body.='<script type="text/javascript" language="javascript">alert("Password changed succesfully!");</script>';
                    unset($_POST["pass0"]);unset($_POST["pass1"]);unset($_POST["pass2"]);
                } 
            }
            else $er_msg='Incomplete form!';
    }
    
    $body.='<div id="content_spc1" style="height:100px;">
    <div style="padding:10px; width:300px; height:200px; float:left; padding:20px;">
    <div class="header_title4" style="padding:0px;">Account information	
    </div>';
    $body.='<p>'.'Name: '.$row["name"].'</p>';
    $body.='<p>'.'Email: '.$row["mail"].'</p>';
    $body.='<p>'.'Phone: '.$row["phone"].'</p>';
    $body.='<p>'.'Company: '.$row["company"].'</p>';
    $body.='<p>'.'Country: '.$row["country"].'</p>';
    $body.='<p>'.'City: '.$row["city"].'</p>';
    $body.='<p>'.'Address: '.$row["address"].'</p>';
    $body.='<p>'.'ZIP: '.$row["zip"].'</p>';
    $body.='</div><div class="featurebox_center" style="width:450px; height:250px; position: relative; top:20px; float:left;">';
    $body.='<form method="post" id="customForm" style="top:0px;" action="?change_pass=1">';
    $body.='
            <div>
				<label for="pass0">Current Password</label>
				<input id="pass0" name="pass0" maxlength="100" type="password" '; if (isset($_POST["pass0"])) $body.='value="'.$_POST["pass0"].'"'; $body.='/>
				
			</div>
            <div>
				<label for="pass1">New Password</label>
				<input id="pass1" name="pass1" maxlength="100" type="password" '; if (isset($_POST["pass1"])) $body.='value="'.$_POST["pass1"].'"'; $body.='/>
				
			</div>
			<div>
				<label for="pass2">Confirm Password</label>
				<input id="pass2" name="pass2" maxlength="100" type="password" '; if (isset($_POST["pass2"])) $body.='value="'.$_POST["pass2"].'"'; $body.='/>
				
			</div>
            ';
            if (isset($er_msg))  $body.='<div style="color:red;">
			     '.$er_msg.'
			</div>';
            $body.='
            <div style="">
				<input id="send" name="send" type="submit" value="Change password" />
			</div>
		</form>';
    $body.='</div>';
    $body.='</div>';
    return $body;
}
?>
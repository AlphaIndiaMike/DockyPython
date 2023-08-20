<?php


function show_security()
{ 
    $rank_name="null";
    if (isset($_SESSION["C_ID"])) $rank_name="C_ID";
    if (isset($_SESSION["S_ID"])) {$rank_name="S_ID"; $_SESSION["name"]="Administrator";}
    if (isset($_SESSION[$rank_name])){
        
        echo '<a class="logininfo">Welcome '.$_SESSION["name"].'!</a>&nbsp;&nbsp;&nbsp;';
        //echo '<a class="loginbtn" href="account.php">My account</a>&nbsp;&nbsp;&nbsp;';
        echo '<a class="loginbtn" href="?logout=1">Log_out</a>';
    }
    else{
        echo '
            <a class="loginbtn" href="'.href('login.html',false).'">Log In</a>
        ';
    }
}

function recover_form(){
    $body='';
    if (isset($_POST["email"])&&$_POST["email"]!=""){
        $aproval=get_row("partners","mail='".mysql_real_escape_string($_POST["email"])."'");
        if (isset($aproval["mail"])&&$aproval["mail"]!=null) {
            $cmd='';
            $cmd.='<html><body>
            <p><b>Password recovery link from MisiaSpare.ro</b></p>
            <a href==\"http://www.misiaspare.ro/recover.php?recover_password=='.md5($aproval["mail"]).'" >Send me to password recovery</a>'.
            '<p>This information is classified, if you didn`t request password recovery please ignore this message and delete it 
            soonest possible.</p>
            </body></html>';
            mail_it($cmd,"Password change at misiaspare.ro, this is an automated message please do not reply","no-reply@misiaspare.ro",$_POST["email"]);  
            $body.='<div class="featurebox_center">
                <img src="plugins/images/active.png" alt="ok" style="padding:2px;"/><a style="position:relative; text-decoration:none; color:black; cursor:default; top:-4px;">
                Your request was sent successfully! <br/>Please check your email for the password recovery link, you may check
                also "Bulk", "Junk" or "Spam" folders if you don`t find the email into "Inbox" folder.
                </a>
            </div>';
        }
        else
        $body.='<script type="text/javascript">location.href="index.php"</script>';
    }
    else
    {
        $body.='<form method="post" id="customForm" style="height:150px; top:25px; position:relative;" action="?send=1">';
        $body.='<div>
    				<label for="email">E-mail:</label>
    				<input id="email" name="email" maxlength="150" type="text" '; if (isset($_POST["email"])) $body.='value="'.$_POST["email"].'"'; $body.='/>
    				<span id="emailInfo">Type the e-mail address, you registered with. </span>
    			</div>
                <div style="">
    				<input id="send" name="send" type="submit" value="Send me the password recovery link!" />
    			</div>'
                ;
        $body.='</form>';
    }
    return $body;
}

function change_password_form($id){
    $id=trim($id,'"');
    $ok=0; $usr='';
    $result = mysql_query("SELECT md5(mail),mail FROM partners;");
    if (mysql_num_rows($result)==0)echo 'err';
    else {
		while ($row=mysql_fetch_array($result)){
            if (substr($row[0],1)==$id) {$usr=$row[1]; $ok=1; break;}
        }
    }
    $body='';
    if($ok==1) {
    if (isset($_GET["change_pass"])){
        if (isset($_POST["pass1"])&&$_POST["pass1"]!=""&&
            isset($_POST["pass2"])&&$_POST["pass2"]!=""&&strlen($_POST["pass1"])>5) { 
                if($_POST["pass1"]!=$_POST["pass2"]) $er_msg='Passwords don`t match!';
                else {update_info($usr,null,null,null,null,null,null,null,$_POST["pass2"]);
                    unset($_POST["pass1"]);unset($_POST["pass2"]);
                    $body.='<script type="text/javascript" language="javascript">alert("Password changed succesfully!"); location.href="index.php";</script>'; 
                }
            }
            else $er_msg='Incomplete form or password to short!';
    }}else {return '<script type="text/javascript">location.href="index.php"</script>';}
        
    
    $body.='<div class="featurebox_center" style="width:450px; height:220px; position: relative; top:20px; float:left;">';
    $body.='<form method="post" id="customForm" style="top:0px;" action="?'; if (isset($_GET["recover_password"]))
    $body.='recover_password='.$_GET["recover_password"].'&'; $body.='change_pass=1">';
    $body.='<div>
                Change your password by completing the form below:
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
    return $body;
}

function login_form()
{
    $ret = insert_js('jquery-1.6.4.min.js').insert_js('jquery.corner.js').insert_js('SHA.js').'
    <script type="text/javascript">
    //<![CDATA[
        $(".textbox").corner("5px");
    //]]>
    </script>
    <div style="padding:15px; padding-left:30px; position:relative; font-family:sans-serif, Arial; width:340px; display:inline-block;">
    
    <form class="blue_text loginForm" action="?login=1" method="post" onsubmit="javascript:document.getElementById('."'".'pw'."'".').value = SHA1(SHA1(document.getElementById('."'".'password'."'".').value)+ document.getElementById('."'".'dt'."'".').value); document.getElementById('."'".'password'."'".').value ='."'".''."'".';">
                User: <br/><input type="text" maxlength="100" id="user" name="user" class="textbox"/>&nbsp;&nbsp;<br/><br/>
                Password: <br/><input type="password" maxlength="100" id="password" name="password" class="textbox"/><br/><br/>
                <a href="#" class="login_recover" style="color:red;">Va rugam folositi acest formular doar daca aveti datele de autentificare</a>
                <br/><br/>
                <input type="submit" value="Log In" class="send" style="width:250px;"/>';
             $TS = time(); //the current timestamp
             $ret .= "<input type='hidden' value='".$TS."' name='dt' id='dt'/><br/>";
             $ret .= '<input type="hidden" name="pw" id="pw" value=""/>     
            </form>';
    if (isset($_GET["loginfail"])) $ret .= '<a style="color:red; text-decoration:none; position:relative; top:10px;">Wrong username or password, <br/>please use this form only if you have <br/>proper credentials to use it.</a>';
    /*$ret .=' 
    </div>
        <div class="std blue_text" style="display:inline-block; width:120px; position:relative; top:-120px; padding-left:50px; ">
            - OR -
        </div>
     <div class="std" style="display:inline-block; width:300px; position:relative; top:-70px; padding:10px; ">
            <p>If you are a partner of MISIA and you don`t have an account, you can create one now and use it to obtain more
            easy spare parts <b>inquiries</b>.</p><br/>
            <a href="register.php" style="color:White; margin:0 auto;" class="wiz_fin_btn">Register Now</a>
        </div>
    ';*/
    return $ret;
}

function has_access($rank_name="S_ID")
{
        if (isset($_SESSION[$rank_name])) return true;
        return false;
}

    /*VERIFICARE LOGIN*/
if (isset($_GET["login"])){

                if ((isset($_POST['user']))&&(isset($_POST['pw']))&&(isset($_POST['dt']))){         
                    if ($_REQUEST['pw']!=null){ 
                        $usr = $_REQUEST['user'];
                        $pw = $_REQUEST['pw'];
                        $dt = $_REQUEST['dt'];
                        
                        /*DATABASE*/
                        $user=''; $password=''; $rank="S_ID"; 
                        read_login(absolute_path().'plugins/global/internal/__security/db/login.php',$user,$password);
                        
                        /*if ($user!=$usr) {
                            $rank="C_ID"; 
                            $user=$usr;
                            $password=get_loginInfo($usr);
                        }*/
                        /*COMPILE PASS*/
                        $password_locked=sha1($password.$dt);
    
                        if(strlen($usr) > 0 && strlen($pw) > 0 && $pw == $password_locked && $user==$usr){
                            $_SESSION[$rank]=$usr;
                            
                            if (!isset($_SESSION["S_ID"])) $_SESSION["name"]=get_column("partners","mail='".mysql_real_escape_string($user)."'","name");
                            echo '<script type="text/javascript" language="javascript">';
                            if (isset($_SESSION["create_user"])) echo 'window.location = "proceed.php";'; else echo 'window.location = "index.html";';
                            echo '</script>';  
                        }
                        else{
                                    echo '<script type="text/javascript" language="javascript">
                                        window.location = "'.($_SERVER['SCRIPT_NAME']).'?loginfail=2";
                                    </script>';
                        }
                    }
                    else{
                                    echo '<script type="text/javascript" language="javascript">
                                        window.location = "'.($_SERVER['SCRIPT_NAME']).'?loginfail=1";
                                    </script>';
                        }
                }
        }
      
    /*LOGOUT*/
    if (isset($_GET["logout"])){
            session_unset();
    }
    
    /*CHANGE PASS*/
    if (isset($_GET["changep"])){
        if (isset($_SESSION["S_ID"]))
        {
            if (($_POST["new_p"]==$_POST["new_p2"])&&(sha1($_POST["old_p"])==get_cell("s_db", "u_name='".$_SESSION["S_ID"]."'", "pass"))){
            $result = mysql_query("UPDATE s_db SET pass=SHA1('".mysql_escape_string($_POST["new_p"])."') WHERE s_db.u_name='".mysql_escape_string($_SESSION["S_ID"])."';");
            if (!$result) { die('!Este jenant, dar: ' . mysql_error()); }
             echo '<script type="text/javascript" language="javascript">
             window.location = "index.php";
             </script>';    
        }}
    }
    
    
?>
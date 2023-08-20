<?php
include ('__rules.php');
include ('__db_model.php');
function allow_edit(){
   if (isset($_SESSION["C_ID"])) return true;
   if (isset($_SESSION["S_ID"])) return false;
   return false;
}

function is_secure(){
    if (isset($_SESSION["S_ID"])) return true;
    if (isset($_SESSION["C_ID"])) return true;
    return false;
}

function show_security()
{ 
    $rank_name="null";
    if (isset($_SESSION["C_ID"])) $rank_name="C_ID";
    if (isset($_SESSION["S_ID"])) {$rank_name="S_ID"; $_SESSION["name"]="Administrator";}
    if (isset($_SESSION[$rank_name])){
        
        echo '<a class="logininfo">Welcome '.$_SESSION["name"].'!</a>&nbsp;&nbsp;&nbsp;';
       if ($_SESSION["name"]!="Guest") echo '<a class="loginbtn" href="'.href('account.html').'">My account</a>&nbsp;&nbsp;&nbsp;';
        echo '<a class="loginbtn" href="?logout=1">Log_out</a>';
    }
    else{
        echo '
            <a class="loginbtn" href="'.href('login.html').'">Log In</a>
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
            <a href==\"http://www.misiaspare.ro/en/recover.html?recover_password=='.md5($aproval["mail"]).'" >Send me to password recovery</a>'.
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
        $body.='<form method="post" id="customForm" style="height:150px;" action="?send=1">';
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
                    $body.='<script type="text/javascript" language="javascript">alert("Password changed succesfully!"); location.href="'.href('default.html').'";</script>'; 
                }
            }
            else $er_msg='Incomplete form or password to short!';
    }}else {return '<script type="text/javascript">location.href="'.href('default.html').'"</script>';}
        
    
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

include('UI/login_default.php');
include('UI/login_3.php');

    /*VERIFICARE LOGIN*/
if (isset($_GET["login"])){
                if ((isset($_POST['user']))&&(isset($_POST['pw']))&&(isset($_POST['dt']))){ 
                    if ($_REQUEST['pw']!=null){ 
                        $usr = $_REQUEST['user'];
                        $pw = $_REQUEST['pw'];
                        $dt = $_REQUEST['dt'];
                        
                        /*DATABASE*/
                        $user=''; $password=''; $rank="S_ID"; 
                        
                        read_login(absolute_path().'plugins/global/internal/db/login.php',$user,$password);
                        
                        if ($user!=$usr) {
                            $rank="C_ID"; 
                            $user=$usr;
                            $password=get_loginInfo($usr);
                        }
                        /*COMPILE PASS*/
                        $password_locked=sha1($password.$dt);
                         
                        if(strlen($usr) > 0 && strlen($pw) > 0 && $pw == $password_locked && $user==$usr){
                            $_SESSION[$rank]=$usr;
                                                       
                            if (!isset($_SESSION["S_ID"])) $_SESSION["name"]=get_column("partners","mail='".mysql_real_escape_string($user)."'","name");
                            echo '<script type="text/javascript" language="javascript">';
                            if (isset($_SESSION["create_user"])) echo 'window.location = "'.href('proceed.html').'";'; else echo 'window.location = "'.href('default.html').'";';
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
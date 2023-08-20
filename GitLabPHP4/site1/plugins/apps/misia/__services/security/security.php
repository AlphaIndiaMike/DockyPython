<?php
include('security_model.php');

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

function login_form($File, &$header)
{
    $header.='
    <script type="text/javascript" src="'.absolute_path().'plugins/js/SHA.js"></script>
    ';
    $ret = '
    <div class="login_form_div">
    <h2>&nbsp;Aici vă autentificați</h2><br/>
    <form action="'.href("autentificare.html",false,"trylogin").'" method="post" onsubmit="javascript:document.getElementById('."'".'pw'."'".').value = SHA1(SHA1(document.getElementById('."'".'password'."'".').value)+ document.getElementById('."'".'dt'."'".').value); document.getElementById('."'".'password'."'".').value ='."'".''."'".';">
         <table cellpadding="1">
         <tr><td class="logininfo">
         '.read_content($File,"[<std_login_user>]","[</std_login_user>]").'</td><td>
        <select id="rank" name="rank">
          <option value="admin">Administrator</option>
          <option value="conta">Contabil</option>
          <option value="cons">Consultant</option>
        </select></td>
        </tr>
        <tr><td class="logininfo">
        '.read_content($File,"[<std_login_firma>]","[</std_login_firma>]").'</td><td><input type="text" maxlength="100" id="user" name="user" class="textbox"/>
        </td>
        </tr>
        <tr><td class="logininfo">
        '.read_content($File,"[<std_login_pass>]","[</std_login_pass>]").'</td><td><input type="password" maxlength="100" id="password" name="password" class="textbox"/>
        </td></tr></table><br/>
        <input type="submit" value="'.trim(read_content($File,"[<std_login_btn>]","[</std_login_btn>]")).'" class="loginbtn"/>';
        $TS = time(); //the current timestamp
        $ret .= "<input type='hidden' value='".$TS."' name='dt' id='dt'/><br/>";
        $ret .= '<input type="hidden" name="pw" id="pw" value=""/>     
        </form>';
        if (return_topic()=="loginfailed") 
        $ret .='<p style="color:red; text-decoration:none; position:relative; font-size:8pt; left:-40px; top:40px; width:250px;"><br/>
        '.trim(read_content($File,"[<std_login_error>]","[</std_login_error>]")).'
        </p>';
    $ret .=' 
    </div>';
    return $ret;
}

/*VERIFICARE LOGIN*/
if (return_topic()=="trylogin"){
 if ((isset($_POST['user']))&&(isset($_POST['pw']))&&(isset($_POST['dt']))&&(isset($_POST['rank']))){         
    if ($_REQUEST['pw']!=null){ 
        $usr = $_REQUEST['user'];
        $pw = $_REQUEST['pw'];
        $dt = $_REQUEST['dt'];
        
        $sa = new security_model();
        /*DATABASE*/
        $user='';
        //read_login('plugins/db/login.php',$user,$password);
        $rank=mysql_real_escape_string($_REQUEST['rank']); 
        if ($rank=="admin") $rank=1000;  
        if ($rank=="conta") $rank=1001; 
        if ($rank=="cons") $rank=1002; 
        $user=mysql_real_escape_string($usr);
        /*COMPILE PASS*/
        //*READ PASSWORD FROM FILE*/
        $u="";$p="";
        read_login(absolute_path()."plugins/global/db/login.php",$u,$p);
        if (($u==$user)&&(sha1($p.$dt)==$pw)){
            $_SESSION["S_ID"]="Administration";
            $_SESSION["C_ID"]="root";$_SESSION["rank"]=0;
            echo '<script type="text/javascript" language="javascript">';
            echo 'window.location = "insider.html";';
            echo '</script>';
        }
        //*READ PASSWORD FROM FILE*/
        $password_compare=sha1(get_column("view_utilizatori","grad=".$rank." AND numelogin='".$user."'","pass").$dt);
        $user_compare=get_column("view_utilizatori","numelogin='".$user."'","numelogin");
        
        if(strlen($user) > 0 && strlen($pw) > 0 &&  $password_compare == $pw && $user == $user_compare){
            $_SESSION["rank"]=$rank;
            $_SESSION["S_ID"]=$user_compare;
            if(get_column("view_utilizatori","numelogin='".$user."'","isreg")=="t"){
                $_SESSION["temp_user"]=true;
                echo '<script type="text/javascript" language="javascript">';
                echo 'window.location = "datefirma.html";';
                echo '</script>'; 
            }
            echo '<script type="text/javascript" language="javascript">';
            echo 'window.location = "insider.html";';
            echo '</script>';  
        }
        else{
           /*echo '<script type="text/javascript" language="javascript">
                window.location = "autentificare.html?topic=loginfailed";
            </script>';*/
        }
    }
    else{
   /*echo '<script type="text/javascript" language="javascript">
             window.location = "autentificare.html?topic=loginfailed";
        </script>';*/
    } 
 }
}
      
/*LOGOUT*/
if (return_topic()=="logout"){
    session_unset();
     echo '<script type="text/javascript" language="javascript">
             window.location = "../index.html";
        </script>';
}
    
/*CHANGE PASS*/
if (return_topic()=="changepassword"){
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
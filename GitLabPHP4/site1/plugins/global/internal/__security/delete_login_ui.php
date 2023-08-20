<?php
    /*VERIFICARE LOGIN*/
     if (isset($_GET["login"])){

                if ((isset($_POST['user']))&&(isset($_POST['pw']))&&(isset($_POST['dt']))){         
                    if ($_REQUEST['pw']!=null){ 
                        $usr = $_REQUEST['user'];
                        $pw = $_REQUEST['pw'];
                        $dt = $_REQUEST['dt'];
                        
                        /*DATABASE*/
                        include_once('simple_functions.php');
                        $user=''; $password='';
                       read_login('plugins/db/login.php',$user,$password);
                       
                        /*COMPILE PASS*/
                        $password_locked=sha1($password.$dt);
    
                        if(strlen($usr) > 0 && strlen($pw) > 0 && $pw == $password_locked && $user==$usr){
                            $_SESSION["S_ID"]=md5(strtolower($usr));
                            echo '<script type="text/javascript" language="javascript">
                                        window.location = "index.php";
                                 </script>';   
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
    if (isset($_GET["logout"])) if (isset($_SESSION["S_ID"])==true){
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
    
    /*AFISARI COLT CONTROL*/
    if (isset($_SESSION["S_ID"])){      
        echo '<div style="position: absolute; text-align:right; top:25px; width:100%; margin:0 auto;">';
        echo '<div style="margin:0 auto; width:960px;">';
        echo '<a style="font-size:12pt; text-decoration:none; color:White;">Bine ai venit!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';   
        //echo '<a id="schimba_parola" href="#setup_ui" style="font-size:12pt; text-decoration:none; color:#8600E3;">Schimba parola</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<a href="?logout=1" style="font-size:12pt; color:red;">Iesire</a>'; 
        echo '</div></div>';
    }
    else
    {
        echo '<div style="position: absolute; text-align:right; top:25px; width:80%; margin:0 auto;">';
        echo '<div style="margin:0 auto; width:960px;">';
        if (isset($_GET["loginfail"])) echo '<a style="font-size:12pt; text-decoration:none; color:RED;">Autentificare ESUATA!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; 
        echo '<a id="start_login" href="#login_ui" style="font-size:12pt; text-decoration:none; color:White;">Autentificare</a>';   
        echo '</div></div>';
    }
    
    
?>

<div style="display: none;">
        <div id="login_ui" style="width:300px;height:150px;overflow:auto;">
             <form action="?login=1" method="post" onsubmit="javascript:document.getElementById('pw').value = SHA1(SHA1(document.getElementById('password').value)+ document.getElementById('dt').value); document.getElementById('password').value ='';">
                    Nume Utilizator : <br/><input type="text" name="user" id="user" maxlength="100"/> <br/>
                    Parola: <br/><input type="password" name="password" id="password" maxlength="100"/><br/> 
                     <?php
                        $TS = time(); //the current timestamp
                        echo "<input type='hidden' value='".$TS."' name='dt' id='dt'/><br/>";
                        ?>
                    <input type='hidden' name='pw' id='pw' value=''/>  
                    <input type="submit" value="Autentificare" class="comment_submit" />
             </form>  
        </div>
</div>

<div style="display: none;">
        <div id="setup_ui" style="width:350px;height:150px;overflow:auto;">
             <form action="?changep=1" method="post">
                    Parola veche : <br/><input type="password" name="old_p" id="old_p" maxlength="100"/><br/>      
                    Parola noua: <br/><input type="password" name="new_p" id="new_p" maxlength="100"/><br/> 
                    Parola noua: <br/><input type="password" name="new_p2" id="new_p2" maxlength="100"/><br/>  
                    <input type="submit" value="Aplica" class="comment_submit" />
             </form>  
        </div>
</div>
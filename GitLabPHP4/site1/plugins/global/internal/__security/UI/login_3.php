<?php

function login_form3()
{
    $ret = '
    <script type="text/javascript" src="'.get_js('jquery-1.6.4.min.js').'"></script>
    <script type="text/javascript" src="'.get_js('jquery.corner.js').'"></script>
    <script type="text/javascript" src="'.get_js('SHA.js').'"></script>
    <script type="text/javascript">
    //<![CDATA[
        $(".textbox").corner("5px");
    //]]>
    </script>
    <div style="display:table; width:960px; height:300px;">
        <div style="font-family:sans-serif, Arial; padding:10px; float:left; display:inline; height:300px; width:300px;">
            <p>If you want to proceed an <b>inquiry</b> you will have to log in at Misia or register.</p>
            <form class="blue_text loginForm" action="?login=1" method="post" onsubmit="javascript:document.getElementById('."'".'pw'."'".').value = SHA1(SHA1(document.getElementById('."'".'password'."'".').value)+ document.getElementById('."'".'dt'."'".').value); document.getElementById('."'".'password'."'".').value ='."'".''."'".';">
                        E-mail: <br/><input type="text" maxlength="100" id="user" name="user" class="textbox" style="width:280px;"/>&nbsp;&nbsp;<br/>
                        Password: <br/><input type="password" maxlength="100" id="password" name="password" class="textbox" style="width:280px;"/><br/>
                        <a href="recover.php" class="login_recover">What if I lost my password?</a>
                        <br/><br/>
                        <input type="submit" value="Log In" class="send" style="width:250px;"/>';
                     $TS = time(); //the current timestamp
                     $ret .= "<input type='hidden' value='".$TS."' name='dt' id='dt'/><br/>";
                     $ret .= '<input type="hidden" name="pw" id="pw" value=""/>     
                    </form>';
            if (isset($_GET["loginfail"])) $ret .= '<a style="color:red; text-decoration:none; position:relative; top:10px;">Wrong username or password, <br/>please use this form only if you have <br/>proper credentials to use it.</a>';
            $ret .=' 
        </div>
        <div class="std blue_text" style="padding:2px; float:left; display:inline; height:300px; width:36px;">
         <br/><br/><br/><br/><br/><br/><br/>-OR-
        </div>
        <div style="padding:10px; float:left; display:inline; height:300px; width:250px;">
            <div class="std" style="display:block; position:relative; top:50px; padding:10px; ">
            <p>If you are a partner of MISIA and you don`t have an account, you can create one now and use it to obtain more
            easy spare parts <b>inquiries</b>.</p><br/>
            <a href="'.href("register.html").'" style="color:White; margin:0 auto;" class="wiz_fin_btn">Register Now</a>
        </div>
        </div>
        <div  class="std blue_text"  style="padding:2px; float:left; display:inline; height:300px; width:36px;">
        <br/><br/><br/><br/><br/><br/><br/>-OR-
        </div>
        <div style="padding:10px; float:left; display:inline; height:300px; width:250px;">
            <div class="std" style="display:block; position:relative; top:50px; padding:10px; ">
            <p>If you are a partner of MISIA and you don`t have an account or time to make one now you can use the quick register (Skip Log in or Register)
            option to identify in MISIA system, and proceed sending your <b>inquiry</b>.</p><br/>
            <a href="'.href("register.html?quick_register=1").'" style="text-decoration:none; color:White; margin:0 auto;" class="send_gry">Skip Log in or Register</a>
            </div>
        </div>
    </div>
    
    
    ';
    return $ret;
}

?>

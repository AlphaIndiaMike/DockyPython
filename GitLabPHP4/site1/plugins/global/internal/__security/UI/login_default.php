<?php

function login_form()
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
    <div style="padding:15px; padding-left:30px; position:relative; top:-25px; font-family:sans-serif, Arial; width:340px; display:inline-block;">
     <p>If you want to proceed an <b>inquiry</b> you will have to log in at Misia or register.</p>
    <form class="blue_text loginForm" action="?login=1" method="post" onsubmit="javascript:document.getElementById('."'".'pw'."'".').value = SHA1(SHA1(document.getElementById('."'".'password'."'".').value)+ document.getElementById('."'".'dt'."'".').value); document.getElementById('."'".'password'."'".').value ='."'".''."'".';">
                E-mail: <br/><input type="text" maxlength="100" id="user" name="user" class="textbox"/>&nbsp;&nbsp;<br/>
                Password: <br/><input type="password" maxlength="100" id="password" name="password" class="textbox"/><br/>
                <a href="'.href('recover.html').'" class="login_recover">What if I lost my password?</a>
                <br/><br/>
                <input type="submit" value="Log In" class="send" style="width:250px;"/>';
             $TS = time(); //the current timestamp
             $ret .= "<input type='hidden' value='".$TS."' name='dt' id='dt'/><br/>";
             $ret .= '<input type="hidden" name="pw" id="pw" value=""/>     
            </form>';
    if (isset($_GET["loginfail"])) $ret .= '<a style="color:red; text-decoration:none; position:relative; top:10px;">Wrong username or password, <br/>please use this form only if you have <br/>proper credentials to use it.</a>';
    $ret .=' 
    </div>
        <div class="std blue_text" style="display:inline-block; width:120px; position:relative; top:-120px; padding-left:50px; ">
            - OR -
        </div>
     <div class="std" style="display:inline-block; width:300px; position:relative; top:-70px; padding:10px; ">
            <p>If you are a partner of MISIA and you don`t have an account, you can create one now and use it to obtain more
            easy spare parts <b>inquiries</b>.</p><br/>
            <a href="'.href("register.html").'" style="color:White; margin:0 auto;" class="wiz_fin_btn">Register Now</a>
        </div>
    ';
    return $ret;
}

?>
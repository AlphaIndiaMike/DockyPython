<?php
session_start();
/***************
*Services
***************/
include('simple_functions.php');
include('settings.php');//Setarile aplicatiei
include('global/internal/__mod_mysql.php');//If required for extensions
include('global/internal/__security/security.php');//Required for extensions
//include('extensions.php');//extensions.php <- Includes and documentation
include('global/internal/__mod_language.php');//Language service
if (defined('site_mail_system')&&site_mail_system=='smtp') include('global/internal/__mod_smtp/__mod_smtp_misia.php');//Serviciul de email
else include('global/internal/__mod_email.php');//Serviciul de email
load_internal_service("misia","cart","header");//loads_local_service
service_start("Cart");//starts_global_service
/*Live Feed*/
$functional=''.
       '<img src="'.get_image("cart.png").'" alt="cart-icon" width="32" height="32" style="padding-right:2px; position:relative; top:6px;"/>'.
       '<b><a style="font-family:sans-serif, Arial; font-size:14pt; color:yellow; cursor:pointer;" href="'.absolute_path().return_language().'/cart.html">Cart ('.view_number_of_selected_products().' items)</a></b>&nbsp;&nbsp;&nbsp;'.
       '';
//CountVisits - etc.
count_visit();
user_online();
/***************
*Init
***************/
/*Recover password*/
if (isset($_GET["recover_password"])&&$_GET["recover_password"]!="") $razor="recover_password";
/******************/
$ctn='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000LNK
</div>';
$content=$ctn;
$header='';
$noap=0;$nopar=0;
$apparray=linking_info($noap);
$paramarray=linking_info($nopar,"<param>","</param>");

if ($noap!=0) {
    $content=''; 
    for ($ti=0;$ti<$noap;$ti++){include(absolute_path().'plugins/apps/'.trim($apparray[$ti]).'/__config.php'); }
}
/***************
*Insert default masterpage
***************/
include(masterpage);
?>
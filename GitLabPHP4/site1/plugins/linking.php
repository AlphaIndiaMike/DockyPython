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
include('global/internal/__mod_email.php');//Serviciul de email
//load_internal_service("misia","cart","header");//loads_local_service
service_start("Contact");//starts_global_service
/*Live Feed*/
$functional='';
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

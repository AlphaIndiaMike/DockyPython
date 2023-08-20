<?php
//Extra Variables
$ctn_aux='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000CFG
        </div>';
//Default:
//$header
//$ctn
//$footer
//Services includes
//include('services/security/security.php');
//End services includes


if ($nopar!=0) {$ctn_aux='';$ctn='';$header='';}
for ($i=0; $i<$nopar; $i++){
    $opt=$paramarray[$i]; $opt=trim($opt);
    $filename=absolute_path()."plugins/apps/default/".$opt."/".$opt.".php";
    if (file_exists($filename)) include($filename);
    //if (file_exists(trim($opt))==true) {include(trim($opt."/".$opt.".php"));echo trim($opt."/".$opt.".php"); }
    //Base Article begin 
    if ($opt=='produse') { $ctn.=base_Article_link(get_title(),$header,960,300);}
    if ($opt=='base_article') { $ctn.=base_Article_link(get_title(),$header,960,300);}
    
}

include('__masterpage/masterpage.php');
?>

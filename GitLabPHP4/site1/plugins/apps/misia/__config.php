<?php
//Extra Variables
$ctn='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000CFG
        </div>';
//Default:
//$header
//$ctn
//$footer
//Services includes
/*Catalog service setup */
    if (!isset($razor)) $razor="";
    if (isset($_GET["page_catalog"])&&$_GET["page_catalog"]!='') $razor='page_catalog_set';
    if (isset($_GET["map_catalog"])&&$_GET["map_catalog"]!='') $razor='map_catalog';
    if (isset($_GET["save_map"])&&isset($_POST["map"])&&$_POST["map"]!="")$razor='save_map';
/*Cart*/
//End services includes
$masterpage='__masterpage/masterpage.php';
if ($nopar!=0) {$ctn_aux='';$ctn='';$header='';}
for ($i=0; $i<$nopar; $i++){
    $opt=$paramarray[$i]; $opt=trim($opt);
    $option_path=absolute_path()."plugins/apps/misia/".$opt."/";
    $filename=absolute_path()."plugins/apps/misia/".$opt."/".$opt.".php";
    if (file_exists($filename)) include($filename);
    //if (file_exists(trim($opt))==true) {include(trim($opt."/".$opt.".php"));echo trim($opt."/".$opt.".php"); }
    if ($opt=='browse_catalog') {
        function misia_catalog_response()
        {
            $page_id=4;
            if (isset($_GET["page_catalog"])&&$_GET["page_catalog"]!=''&&$_GET["page_catalog"]!=0){
                $page_id=$_GET["page_catalog"];  
            }
            if (isset($_GET["map_catalog"])&&$_GET["map_catalog"]!=''&&$_GET["map_catalog"]!=0){
                $page_id=$_GET["map_catalog"];
            }
            return $page_id; 
        }
        
        $pag=1;
        if ($razor=='page_catalog_set') {$pag=misia_catalog_response();} 
        if ($razor=='map_catalog') {$pag=misia_catalog_response();
            $misiaCatalog = new Misia_Catalog($pag,$option_path."catalog.php");
            $ctn.='<div id="content" style="width:960px; height:740px; padding:0px;">'; 
            $ctn.=$misiaCatalog->map_page();
            $ctn.='</div>';
        }
        else{$pag=misia_catalog_response();
            $misiaCatalog = new Misia_Catalog($pag,$option_path."catalog.php");
            $ctn.='<div id="content" style="width:960px; height:679px;">'; 
            if ($razor=='save_map') $misiaCatalog->write_map($_POST["map"],misia_catalog_response());
            $ctn.=$misiaCatalog->return_page();
            $ctn.='</div>';
        }
        $ctn.='<div id="footer" style="background-image: none; background-color:#837066; height:40px;">
        <div style="position: relative; left: 520px; width:500px;">
            <a href="index.php">Home</a> | 
            <a href="#">Spare parts catalog</a> | 
            <a href="#">Request a part</a> | 
            <a href="http://www.misiahoist.it" target="_blank">MISIA Hoist</a>
            <br/>
            <a>Misia Paranchi S.r.l - All rights reserved.</a>
        </div>
        </div>';
    }
    if ($opt=='display_cart'){
        $ctn.='<div id="content">
            <div id="upper">
                &nbsp;
            </div>
            <div id="middle">
            '.show_cart().'  
            </div>
        </div>
        
        <div id="footer">
        <div style="position: relative; top:90px; left: 520px; width:500px;">
            <a href="'.return_language().'/index.html">Home</a> | 
            <a href="'.return_language().'/browse-catalog.html">Spare parts catalog</a> | 
            <a href="'.return_language().'/contact.html">Request a part</a> | 
            <a href="http://www.misiahoist.it" target="_blank">MISIA Hoist</a>
            <br/>
            <a>Misia Paranchi S.r.l - All rights reserved.</a>
        </div>
        </div>
        ';
    }
    if ($opt=='proceed_cart'){
        if(!isset($_SESSION["p_num"])||$_SESSION["p_num"]==0||$_SESSION["p_num"]=='') 
            $ctn.='<script type="text/javascript" language="javascript">location.href="index.html"</script>';
        else $ctn.=send_cmd();
        $masterpage='__masterpage/masterpage_2.php';
    }
    if ($opt=='comunity'&&$nopar==1){
        if (return_random_tag("quick_register")=='1') $ctn.=register_quick();
        else $ctn.=register_member();
        $masterpage='__masterpage/masterpage_2.php';
    }
    if ($opt=='login'){
        $ctn.=login_form();
        $masterpage='__masterpage/masterpage_2.php';
        
    }
    if ($opt=='user_recovery'){
        $ctn=recover_form();
        $masterpage='__masterpage/masterpage_2.php'; 
    }
    if ($opt=='account'){
        if (has_access("S_ID")) $ctn=admin_account($header);
        else
        if (has_access("C_ID")) $ctn=client_account();
        else{
            header('location: index.html');
        }
        $masterpage='__masterpage/masterpage_2.php'; 
    }
    if ($opt=='query_manager'){
        if (has_access("S_ID")!=0) 
        {
            $ctn=show_query_manager($header,$option_path);
        }
        else{
            include ('base_article/base_article.php');
            $ctn=base_Article_link(get_title(),$header,960,470);
        }
        $masterpage='__masterpage/masterpage_2.php'; 
    }
    
    if (isset($_GET["proceed_registration"])) echo '<script type="text/javascript">location.href="register.html?quick_register=1";</script>';
}
include($masterpage);

?>
